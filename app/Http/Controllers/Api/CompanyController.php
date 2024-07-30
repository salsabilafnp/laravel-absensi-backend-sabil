<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // index
    public function index()
    {
        $companies = Company::all();
        return response(['companies' => $companies], 200);
    }

    // show by id
    public function show($id)
    {
        $company = Company::find($id);
        if ($company) {
            return response(['message' => 'Company found', 'company' => $company], 200);
        } else {
            return response(['message' => 'Company not found'], 404);
        }
    }
}
