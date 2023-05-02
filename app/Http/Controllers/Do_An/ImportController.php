<?php

namespace App\Http\Controllers\Do_An;

use App\Http\Controllers\Controller;
use App\Imports\Criteria;
use App\Imports\Job;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import()
    {
        return view('layouts.import');
    }

    public function postImport(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new Job, $file);
    }

    public function importCriteria()
    {
        return view('layouts.importCriteria');
    }

    public function postImportCriteria(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new Criteria(), $file);
    }
}
