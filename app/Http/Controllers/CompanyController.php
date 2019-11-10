<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Validator;
use File;
use Image;
use App\Models\User;
class CompanyController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $companies = Company::paginate(10);

        return view("company.show-companies", compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('company.add-company');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $company = new Company();
        $user = new User();
        $validator = Validator::make($request->all(),
                        [
                            'fullName' => 'required|max:255',
                            'email' => 'required|email|max:255',
                            'logo' => 'required'
                        ],
                        [
                            'fullName.unique' => trans('auth.userNameTaken'),
                            'email.required' => trans('auth.emailRequired'),
                            'email.email' => trans('auth.emailInvalid')
                        ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $file = $request->file('logo');

        $filename = $request->fullName . '-logo.' . $file->getClientOriginalExtension();
        //die();
        //Move Uploaded File
        $destinationPath = storage_path() . '/app/public/';
        Image::make($file)->resize(100, 100)->save($destinationPath . $filename);

        $public_path = '/storage/' . $filename;

        $user->name = explode('@', $request->email)[0];
        $user->email = $request->email;
        $user->password = bcrypt("Password@123");
        $user->activated = 1;
        $user->token = "randomtokencreatedfortesting";
        
        $user->save();
        $user->attachRole(4);
        
        $company->fullName = $request->fullName;
        $company->email = $request->email;
        $company->logo = $public_path;
        $company->user_id = $user->id;
        $company->save();

        return redirect('company')->with('success', "Company Successfully Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company) {
        //
    }

        
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company) {
        $company_data = [
            'fullName' => $company->fullName,
            'email' => $company->email,
            'logo' => $company->logo,
        ];

        return view('company.edit-company')->withCompany($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company) {

        if ($request->hasFile('logo')) {
            //dd($request);
            $file = $request->file('logo');

            $filename = $request->fullName . '-logo.' . $file->getClientOriginalExtension();
            //die();
            //Move Uploaded File
            $destinationPath = storage_path() . '/app/public/';
            Image::make($file)->resize(100, 100)->save($destinationPath . $filename);

            $public_path = '/storage/' . $filename;

            $company->logo = $public_path;
        }


        $company->fullName = $request->input('fullName');
        $company->email = $request->input('email');

        $company->save();

        return redirect('company')->with('success', "Company Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company) {
        //dd($company);
        $companyObj = Company::find($company->id);
        $companyObj->delete();
        
        $matchThese = ['company_id' => $company->id];
        Employee::where($matchThese)->delete();
        
        return redirect('company')->with('success', "Company and All its employee Deleted");
    }

}
