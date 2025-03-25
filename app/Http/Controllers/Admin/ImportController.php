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
}
