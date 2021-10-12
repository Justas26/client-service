<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Validator;

class CompanyController extends Controller
{
    const RESULTS_IN_PAGE = 9;
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'min:3', 'max:32'],
                'address' => ['required', 'min:3', 'max:32'],

            ],
            [
                'name.required' => 'company name required',
                'address.required' => 'company address required',
                'name.min' => 'too short company name',
                'name.max' => 'too long company name',
                'address.min' => 'too short company address',
                'address.max' => 'too long company address',



            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $company = new Company();
        $company->name = $request->name;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('company.index')->with('success_message', 'succesfully recorded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'min:3', 'max:32'],
                'address' => ['required', 'min:3', 'max:32'],

            ],
            [
                'name.required' => 'company name required',
                'address.required' => 'company address required',
                'name.min' => 'too short company name',
                'name.max' => 'too long company name',
                'address.min' => 'too short company address',
                'address.max' => 'too long company address',



            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $company->name = $request->name;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('company.index')->with('success_message', 'succesfully changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if ($company->customerCompany()->count()) {
            return 'Cannot delete because it has a custom buyer';
        }
        $company->delete();
        return redirect()->route('company.index')->with('success_message', 'succesfully deleted.');
    }
}
