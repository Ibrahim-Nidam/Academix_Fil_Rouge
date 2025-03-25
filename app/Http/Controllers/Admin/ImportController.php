<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

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
}
