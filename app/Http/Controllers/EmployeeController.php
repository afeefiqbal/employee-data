<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use DB;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::with('company')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('employees.edit', $row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <form action="'.route('employees.destroy', $row->id).'" method="POST" style="display:inline;">
                                 '.csrf_field().'
                                 '.method_field("DELETE").'
                                 <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('employees.create', [
            'action' => route('employees.store'),
            'submitText' => 'Create Employee'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
       DB::beginTransaction();
       $data = $request->validated();
       $data['name'] =        $data['first_name']. ' '.$data['last_name'] ;
       $data['password'] = Hash::make($data['password']);
       $user = User::create($data);
       $data['user_id']= $user->id;

       $employee  =   Employee::create($data);

        $employee->save();
        DB::commit();
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', [
            'action' => route('employees.store'),
            'submitText' => 'Update Employee',
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
        DB::beginTransaction();
        $employee = Employee::findOrFail($employee->id);
        $data = $request->validated();
        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        $data['password'] = Hash::make($data['password']);
        $data['user_id']= $employee->user_id;
        $user = User::findOrFail($data['user_id']);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $employee->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
        ]);
            DB::commit();

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
