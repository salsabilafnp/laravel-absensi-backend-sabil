<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // index
    public function index()
    {
        $companies = Company::where('name', 'like', '%'.request('name').'%')
        ->paginate(10);

        return view('pages.company.index', compact('companies'));
    }

    // create
    public function create()
    {
        return view('pages.company.create');
    }

    // store
    public function store(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius_km' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ]);

        $company::create($request->all());

        return redirect()->route('companies.index')->with('success', "Company created successfully");
    }

    // edit
    public function edit(Company $company)
    {
        return view('pages.company.edit', compact('company'));
    }

    // update
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius_km' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index')->with('success', "Company updated successfully");
    }

    // destroy
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')->with('success', "Company deleted successfully");
    }
}
