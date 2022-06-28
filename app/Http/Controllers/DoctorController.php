<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
            'email'=>'required|string|email|unique:doctors,email',
            'Bachelors_degree'=>'required|string',
            'specialty'=>'required|string',
            'clinic_id' => 'required|integer',
            'practice_certificate' => 'nullable|image|mimes:jpg,bmp,png|max:2048',
            'Certificate_of_good_conduct' => 'nullable|image|mimes:jpg,bmp,png|max:2048',
            'password'=>'required|string|min:8|max:45',
        ]);

        if(!$validator->fails()){
            $role= Role::findById($request->input('role_id'),'doctor');
            $doctor = new Doctor();
            $doctor->name = $request->input('name');
            $doctor->email = $request->input('email');
            $doctor->Bachelors_degree = $request->input('Bachelors_degree');
            $doctor->specialty = $request->input('specialty');
            $doctor->clinic_id = $request->input('clinic_id');
            if ($request->hasFile('practice_certificate')) {
                $image = $request->file('practice_certificate');
                $imageName = Carbon::now()->format('Y_m_d_h_i') . '_' . $doctor->name . '.' . $image->getClientOriginalExtension();
                $request->file('practice_certificate')->storeAs('/doctors', $imageName, ['disk' => 'public']);
                $doctor->practice_certificate = 'doctors/' . $imageName;
            }
            if ($request->hasFile('Certificate_of_good_conduct')) {
                $image2 = $request->file('Certificate_of_good_conduct');
                $imageName = Carbon::now()->format('Y_m_d_h_i') . '_' . $doctor->name . '.' . $image2->getClientOriginalExtension();
                $request->file('Certificate_of_good_conduct')->storeAs('/doctors', $imageName, ['disk' => 'public']);
                $doctor->Certificate_of_good_conduct = 'doctors/' . $imageName;
            }
            $doctor->password = Hash::make($request->input('password'));

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
        $roles = Role::where('guard_name','=','admin')->get();
        $doctorRole = $doctor->roles()->first() ;
        return response()->view('cms.doctors.update',['doctor'=>$doctor,'roles'=>$roles, 'doctorRole'=>$doctorRole]);
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
        $validator = validator($request->all(),[
            'role_id' => 'required|integer|exists:roles,id',
            'name'=>'required|string|min:3|max:45',
            'email'=>'required|string|email|unique:doctors,email,'.$doctor->id,
            'Bachelors_degree'=>'required|string',
            'specialty'=>'required|string',
            'clinic_id' => 'required|integer',
            'practice_certificate' => 'nullable|image|mimes:jpg,bmp,png|max:2048',
            'Certificate_of_good_conduct' => 'nullable|image|mimes:jpg,bmp,png|max:2048',
            'password'=>'required|string|min:8|max:45',
        ]);

        if(!$validator->fails()){
            $role= Role::findById($request->input('role_id'),'doctor');
            $doctor->name = $request->input('name');
            $doctor->email = $request->input('email');
            $doctor->Bachelors_degree = $request->input('Bachelors_degree');
            $doctor->specialty = $request->input('specialty');
            $doctor->clinic_id = $request->input('clinic_id');
            if ($request->hasFile('practice_certificate')) {
                $image = $request->file('practice_certificate');
                $imageName = Carbon::now()->format('Y_m_d_h_i') . '_' . $doctor->name . '.' . $image->getClientOriginalExtension();
                $request->file('practice_certificate')->storeAs('/doctors', $imageName, ['disk' => 'public']);
                $doctor->practice_certificate = 'doctors/' . $imageName;
            }
            if ($request->hasFile('Certificate_of_good_conduct')) {
                $image2 = $request->file('Certificate_of_good_conduct');
                $imageName = Carbon::now()->format('Y_m_d_h_i') . '_' . $doctor->name . '.' . $image2->getClientOriginalExtension();
                $request->file('Certificate_of_good_conduct')->storeAs('/doctors', $imageName, ['disk' => 'public']);
                $doctor->Certificate_of_good_conduct = 'doctors/' . $imageName;
            }

            $isUpdated = $doctor->save();
            if($isUpdated) $doctor->syncRoles($role);
            return response()->json([
                'message' => $isUpdated ? 'Updated successfully' : 'Updated failed'
            ], $isUpdated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
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
        $imageName = $doctor->practice_certificate; // الملف الاول 
        $imageName1 = $doctor->Certificate_of_good_conduct; //  الملف او الصورة الثانى 
        $deleted = $doctor->delete();
        if ($deleted) Storage::disk('public')->delete($imageName); // حذف الملف الاول 
        if ($deleted) Storage::disk('public')->delete($imageName1); // حذف الملف االثانى
        return response()->json([
            'title' => $deleted ? 'Deleted successfully' : "Delete failed",
            'icon' => $deleted ? 'success' : "error",
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
