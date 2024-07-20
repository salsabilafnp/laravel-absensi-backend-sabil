<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/companies",
     *     summary="List all companies",
     *     tags={"company"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Filter companies by name",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *     )
     * )
     */
    // index
    public function index()
    {
        $companies = Company::where('name', 'like', '%' . request('name') . '%')
            ->paginate(10);

        return view('pages.company.index', compact('companies'));
    }
    
    // create
    public function create()
    {
        return view('pages.company.create');
    }

    /**
     * @OA\Post(
     *     path="/api/companies",
     *     summary="Create a new company",
     *     tags={"company"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Name of the company"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     format="email",
     *                     description="Email of the company"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string",
     *                     description="Address of the company"
     *                 ),
     *                 @OA\Property(
     *                     property="latitude",
     *                     type="number",
     *                     format="float",
     *                     description="Latitude of the company's location"
     *                 ),
     *                 @OA\Property(
     *                     property="longitude",
     *                     type="number",
     *                     format="float",
     *                     description="Longitude of the company's location"
     *                 ),
     *                 @OA\Property(
     *                     property="radius_km",
     *                     type="number",
     *                     format="float",
     *                     description="Radius in kilometers around the company's location"
     *                 ),
     *                 @OA\Property(
     *                     property="time_in",
     *                     type="string",
     *                     format="date-time",
     *                     description="Time when the company opens"
     *                 ),
     *                 @OA\Property(
     *                     property="time_out",
     *                     type="string",
     *                     format="date-time",
     *                     description="Time when the company closes"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Company created successfully",
     *     )
     * )
     */
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

        /**
     * @OA\Put(
     *     path="/api/companies/{id}",
     *     summary="Update a company",
     *     tags={"company"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Name of the company"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     format="email",
     *                     description="Email of the company"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string",
     *                     description="Address of the company"
     *                 ),
     *                 @OA\Property(
     *                     property="latitude",
     *                     type="number",
     *                     format="float",
     *                     description="Latitude of the company's location"
     *                 ),
     *                 @OA\Property(
     *                     property="longitude",
     *                     type="number",
     *                     format="float",
     *                     description="Longitude of the company's location"
     *                 ),
     *                 @OA\Property(
     *                     property="radius_km",
     *                     type="number",
     *                     format="float",
     *                     description="Radius in kilometers around the company's location"
     *                 ),
     *                 @OA\Property(
     *                     property="time_in",
     *                     type="string",
     *                     format="date-time",
     *                     description="Time when the company opens"
     *                 ),
     *                 @OA\Property(
     *                     property="time_out",
     *                     type="string",
     *                     format="date-time",
     *                     description="Time when the company closes"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Company updated successfully",
     *     )
     * )
     */
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

        /**
     * @OA\Delete(
     *     path="/api/companies/{id}",
     *     summary="Delete a company",
     *     tags={"company"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Company deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Company not found"
     *     )
     * )
     */
    // destroy
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')->with('success', "Company deleted successfully");
    }
}
