<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    //Index
    public function index(Request $request)
    {
        //get all patients paginated
        //search patients by nik
        $patients = DB::table('patients')
        ->when($request->input('nik'), function ($query, $name) {
            return $query->where('nik', 'like', '%' . $name . '%');
        })
        ->orderBy('id', 'desc')
        ->get();

        return response([
            'data' => $patients,
            'message' => 'Success',
            'status' => 'OK'
        ], 200);
    }
}
