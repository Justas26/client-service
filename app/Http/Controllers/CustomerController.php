<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Company;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Str;

class CustomerController extends Controller
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
    public function index(Request $request)
    {
        $customers = Customer::orderBy('surname')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        $companies = Company::all();
        if ($request->filter && 'company' == $request->filter) {
            $customers = Customer::where('company_id', $request->company_id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }
        return view('customer.index', ['customers' => $customers, 'companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('customer.create', ['companies' => $companies]);
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
                'surname' => ['required', 'min:3', 'max:32'],
                'phone' => ['required', 'min:3', 'max:24'],
                'email' => ['required', 'min:3', 'max:64'],
                'comment' => ['required'],

            ],
            [
                'name.required' => 'customer name required',
                'surname.required' => 'customer surname required',
                'phone.required' => 'customer phone required',
                'email.required' => 'customer email required',
                'comment.required' => 'comment about customer required',
                'name.min' => 'too short customer name',
                'name.max' => 'too long customer name',
                'surname.min' => 'too short customer surname',
                'surname.max' => 'too long customer surname',
                'phone.min' => 'too short customer phone',
                'phone.max' => 'too long customer phone',
                'email.min' => 'too short customer email',
                'email.max' => 'too long customer email ',


            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        if ($request->company_id == 0) {
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->surname = $request->surname;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->comment = $request->comment;
            $customer->company_id = $request->company_id;
            $customer->save();
        } else {
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->surname = $request->surname;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->comment = $request->comment;
            $customer->company_id = $request->company_id;
            $customer->save();
        }
        return redirect()->route('customer.index')->with('success_message', 'succesfully recorded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $customer = Customer::where('id', $customer->id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        return view('customer.show', ['customer' => $customer]);
    }
    public function uploadPhoto(Customer $customer, Request $request)
    {
        if ($request->has('photo')) {
            $img = Image::make($request->file('photo'));
            $fileName = Str::random(5) . ".jpg";
            $folder = public_path('/customerPhoto');
            $img->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($folder . '/' . $fileName, 80, 'jpg');
            $customer->photo_name = $fileName;
            $customer->save();
        }
        return redirect()->route('customer.index', ['customer' => $customer]);
    }
    public function deletePhoto(Customer $customer)
    {
        if ($customer->photo_name != null) {
            unlink(public_path('/customerPhoto/' . $customer->photo_name));
        }
        $customer->photo_name = null;
        $customer->save();
        return redirect()->route('customer.index', ['customer' => $customer]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $companies = Company::all();
        return view('customer.edit', ['customer' => $customer, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'min:3', 'max:32'],
                'surname' => ['required', 'min:3', 'max:32'],
                'phone' => ['required', 'min:3', 'max:24'],
                'email' => ['required', 'min:3', 'max:64'],
                'comment' => ['required'],

            ],
            [
                'name.required' => 'customer name required',
                'surname.required' => 'customer surname required',
                'phone.required' => 'customer phone required',
                'email.required' => 'customer email required',
                'comment.required' => 'comment about customer required',
                'name.min' => 'too short customer name',
                'name.max' => 'too long customer name',
                'surname.min' => 'too short customer surname',
                'surname.max' => 'too long customer surname',
                'phone.min' => 'too short customer phone',
                'phone.max' => 'too long customer phone',
                'email.min' => 'too short customer email',
                'email.max' => 'too long customer email ',


            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        if ($request->company_id == 0) {
            $customer->name = $request->name;
            $customer->surname = $request->surname;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->comment = $request->comment;
            $customer->company_id = $request->company_id;
            $customer->save();
        } else {
            $customer->name = $request->name;
            $customer->surname = $request->surname;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->comment = $request->comment;
            $customer->company_id = $request->company_id;
            $customer->save();
        }
        return redirect()->route('customer.index')->with('success_message', 'succesfully changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('success_message', 'succesfully deleted');
    }
}
