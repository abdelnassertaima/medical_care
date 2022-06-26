<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Patient::all();
        return response()->view('cms.patients.index',['patients'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::where('guard_name','=','patient')->get();
        return response()->view('cms.patients.create', ['roles'=>$roles]);
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
        $validator = Validator($request->all(), [
            'role_id' => 'required|integer|exists:roles,id',
            'name' => 'required|string|min:3|max:45',
            'phone_num' => 'required|string|min:3|max:100|unique:patients,phone_num',
            'email' => 'required|string|unique:patients,email',
            'address' => 'required|string|min:3|max:100',
            'identification_num' => 'required|string|min:1|unique:patients,identification_num',
        ]);
        if (!$validator->fails()) {
            $role= Role::findById($request->input('role_id'),'patient');
            $patient = new Patient();
            $patient->name = $request->input('name');
            $patient->phone_num = $request->input('phone_num');
            $patient->email = $request->input('email');
            $patient->address = $request->input('address');
            $patient->identification_num = $request->input('identification_num');
            $patient->password = Hash::make(12345);
            $isCreated = $patient->save();
            if($isCreated) $patient->assignRole($role);
            return response()->json([
                'message' => $isCreated ? 'Created Successfully' : 'Create failed'
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
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
        $roles = Role::where('guard_name','=','patient')->get();
        // $adminRole = $admin->roles()->first();
        $patientRole = $patient->roles()->first();
        return response()->view('cms.patients.edit',['patient'=>$patient, 'roles'=>$roles, 'patientRole'=>$patientRole]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
        $validator = Validator($request->all(), [
            'role_id' => 'required|integer|exists:roles,id',
            'name'=>'required|string|min:3|max:100',
            'phone_num'=>'required|string|min:3|max:45',
            'email'=>'required|string|email|unique:patients,email, '. $patient->id,
            'address'=>'required|string|min:3|max:100',
            'identification_num'=>'required|string|min:3|max:45',
        ]);
        if (!$validator->fails()) {
            $role= Role::findById($request->input('role_id'),'patient');
            $patient->name = $request->input('name');
            $patient->phone_num = $request->input('phone_num');
            $patient->email = $request->input('email');
            $patient->address = $request->input('address');
            $patient->identification_num = $request->input('identification_num');
            $patient->password = Hash::make(12345);
            $Updated = $patient->save();
            if($Updated) $patient->syncRoles($role);
            return response()->json([
                'message' => $Updated ? 'Created Successfully' : 'Create failed'
            ], $Updated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
