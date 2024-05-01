<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // show
    public function show()
    {
        $company = Company::find(1);
        return response(['company' => $company], 200);
    }

    // public function show(Request $request)
    // {

    //     // User tidak terkait dengan perusahaan
    //     $company = $request->user->company;

    //     // Format data perusahaan
    //     $formattedCompany = [
    //         'id' => $company->id,
    //         'name' => $company->name,
    //         'address' => $company->address,
    //         'latitude' => $company->latitude,
    //         'longitude' => $company->longitude,
    //         'radius_km' => $company->radius_km,
    //         'time_in' => $company->time_in,
    //         'time_out' => $company->time_out,
    //     ];

    //     return response()->json($formattedCompany);
    // }
}
