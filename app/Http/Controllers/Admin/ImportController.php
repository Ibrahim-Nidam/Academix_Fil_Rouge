<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    private function hasHeaderRow(array $row)
    {
        foreach ($row as $cell){
            if(!empty($cell) && preg_match('/(first|last|name|gender)/i', $cell)){
                return true;
            }
        }
        return false;
    }

    private function rowHasData(array $row){
        return !empty(array_filter($row, fn($value) => trim($value) !== ''));
    }

    private function mapDataColumns(array $row)
    {
        $nonEmptyValues = array_values(array_filter($row, fn($value) => trim($value) !== ''));
        if(count($nonEmptyValues) < 2){
            return null;
        }

        $mappedData = [
            'first_name' => trim($nonEmptyValues[0]),
            'last_name' => trim($nonEmptyValues[1])
        ];

        $genderValue = isset($nonEmptyValues[2]) ? strtolower(trim($nonEmptyValues[2])) : 'male';
        $mappedData['gender'] = in_array($genderValue, ['f', 'female', 'woman', 'girl']) ? 'Female' : 'Male';

        return $mappedData;
    }

    public function processImport(Request $request){
        $previewData = session('import_preview_data', []);
        $userType = session('import_user_type', 'teacher');

        if(empty($previewData)){
            return redirect()->route('admin.importData');
        }

        $selectedIndices = $request->input('selected_users', []);
        $allUsers = $request->input('users', []);

        $selectedUsers = [];
        foreach($selectedIndices as $index){
            if(isset($allUsers[$index])){
                $selectedUsers[] = $allUsers[$index];
            }
        }

        if(empty($selectedUsers)){
            return redirect()->route('admin.importData')->with('error', 'No users selected');
        }

        $roleType = ($userType === 'teacher') ? 'Teacher' : 'Student';
        $createdUsers = User::createBulkUsers($selectedUsers, $roleType);
        session()->forget(['import_preview_data', 'import_user_type']);

        if(count($createdUsers) > 0){
            return redirect()->route('admin.importData')->with('created_users', $createdUsers);
        }

        return redirect()->route('admin.importData')->with('error', 'No users were imported');
    }

}
