<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        $employee = Employee::all();
        return view('backend.employee.index',compact('employee'));
    }
    public function store(Request $request){
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->save();
            return response()->json([
                'success' => true,
                'data' => $employee,
                'message' => 'Employee successfully added'
            ]);
    }
    public function edit($id)
    {
        $order_edit = Employee::find($id);
        return response()->json([
            'status' => 'success',
            'employee' => $order_edit,
        ]);
    }

    public function update(Request $req)
    {
            $stud_id = $req->input('editStaus');
            $pcat_update = Employee::find($stud_id);
            $pcat_update->name = $req->name;
            $pcat_update->email = $req->email;
            $pcat_update->update();
            return redirect()->route('employees.index');
    }
}
