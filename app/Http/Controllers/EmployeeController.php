<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use Illuminate\Http\Request;
use Validator;
use Auth;

class EmployeeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        //dd($company->id);
        if($user->hasRole('admin')){
            $employees = Employee::paginate(10);
            return view("employee.show-employees", compact('employees'));
        }elseif($user->hasRole('company')){
            $employees = Employee::where('company_id', $company->id)->get();
            return view("employee.show-employees", compact('employees'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $companies = Company::pluck('fullName', 'id');

        return view('employee.create-employee', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $employee = new Employee();

        $validator = Validator::make($request->all(),
                        [
                            'fullName' => 'required|max:255',
                            'email' => 'required|email|max:255',
                            'phone' => 'required',
                            'company' => 'required'
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

        $employee->fullName = $request->fullName;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->company_id = $request->company;
        $employee->save();

        return redirect('employee')->with('success', "Employee Successfully Added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee) {        
        return view('employee.show-employee')->withEmployee($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee) {
        return view('employee.edit-employee')->withEmployee($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee) {
        $employee->fullName = $request->input('fullName');
        $employee->email = $request->input('email');
        $employee->email = $request->input('phone');

        $employee->save();

        return redirect('employee')->with('success', "Employee Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee) {
        $employeeObj = Employee::find($employee->id);
        $employeeObj->delete();
                
        return redirect('employee')->with('success', "Company and All its employee Deleted");
    }

}
