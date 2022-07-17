<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Employee::all();
        return response()->view('cms.employees.index',['employees'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::where('guard_name','=','employee')->get();
        return response()->view('cms.employees.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = validator($request->all(),[
            'role_id' => 'required|integer|exists:roles,id',
            'name'=>'required|string|min:3|max:45',
            'phone_num'=>'required|string|min:3|max:45',
            'email'=>'required|string|email|unique:employees,email',
            'address'=>'required|string|min:3|max:100',
            'identification_num'=>'required|string|min:3|max:45',
        ]);

        if(!$validator->fails()){
            $role= Role::findById($request->input('role_id'),'employee');
            $employee = new Employee();
            $employee->name = $request->input('name');
            $employee->phone_num = $request->input('phone_num');
            $employee->email = $request->input('email');
            $employee->address = $request->input('address');
            $employee->identification_num = $request->input('identification_num');
            $employee->password = Hash::make($request->input('identification_num'));

            $isCreated = $employee->save();
            if($isCreated) {
                $employee->assignRole($role);
                event(new Registered($employee));
                // Mail::to($employee->email)->send(new employeeWelcomEmail($employee->name));
            }
            return response()->json([
                'message' => $isCreated ? 'Created successfully' : 'Create failed'
            ], $isCreated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
        $roles = Role::where('guard_name','=','employee')->get();
        $employeeRole = $employee->roles()->first() ;
        return response()->view('cms.employees.update',['employee'=>$employee, 'roles'=>$roles, 'employeeRole'=>$employeeRole]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
        $validator = validator($request->all(),[
            'role_id' => 'required|integer|exists:roles,id',
            'name'=>'required|string|min:3|max:100',
            'phone_num'=>'required|string|min:3|max:45|unique:employees,phone_num',
            'email'=>'required|string|email|unique:employees,email, '. $employee->id,
            'address'=>'required|string|min:3|max:100',
            'identification_num'=>'required|string|min:3|max:45|unique:employees,identification_num',
        ]);

        if(!$validator->fails()){
            $role= Role::findById($request->input('role_id'),'employee');
            $employee->name = $request->input('name');
            $employee->phone_num = $request->input('phone_num');
            $employee->email = $request->input('email');
            $employee->address = $request->input('address');
            $employee->identification_num = $request->input('identification_num');

            $isUpdated = $employee->save();
            if($isUpdated) $employee->syncRoles($role);
            return response()->json([
                'message' => $isUpdated ? 'Updated successfully' : 'Updated failed'
            ], $isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
        {
            //
            $deleted = $employee->delete();
            return response()->json([
                // 'message' => $deleted ? 'Deleted successfully' : 'Deleted failed'
                'title' => $deleted ? 'Deleted successfully' : "Delete failed",
                'icon' => $deleted ? 'success' : "error",
            ], $deleted ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }
    }
}
