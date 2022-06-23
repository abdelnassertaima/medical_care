<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Doctor;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Doctor::all();
        return response()->view('cms.doctors.index',['doctors'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::where('guard_name','=','doctor')->get();
        $clinic = Clinic::all();
        return response()->view('cms.doctors.create', ['roles'=>$roles, 'clinics'=>$clinic]);
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
            'email'=>'required|string|email|unique:doctors,email',
            'address'=>'required|string|min:3|max:100',
            'identification_num'=>'required|string|min:3|max:45',
        ]);

        if(!$validator->fails()){
            $role= Role::findById($request->input('role_id'),'doctor');
            $doctor = new Doctor();
            $doctor->name = $request->input('name');
            $doctor->phone_num = $request->input('phone_num');
            $doctor->email = $request->input('email');
            $doctor->address = $request->input('address');
            $doctor->identification_num = $request->input('identification_num');
            $doctor->password = Hash::make(12345);

            $isCreated = $doctor->save();
            if($isCreated) {
                $doctor->assignRole($role);
                event(new Registered($doctor));
                // Mail::to($doctor->email)->send(new doctorWelcomEmail($doctor->name));
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
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
