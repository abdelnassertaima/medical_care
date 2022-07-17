<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    private function getGuardName(): String
    {
        return auth('admin')->check() ? 'admin' : 'doctor';
    }

    public function index()
    {
        //
        // dd(Auth()->id());
        $patient = auth('patient')->check() ? 'patient' : 'doctor';
        $employee = auth('employee')->check() ? 'employee' : 'doctor';
        // dd($patient);
        $user = $this->getGuardName();

        $data = Booking::all();
        if ($user =='admin') {
            $data = Booking::all();
        }
        if ($user == 'doctor') {
            
            $data = Booking::where('doctor_id','=', Auth()->id())->get();
        }
        if ($employee =='employee') {
            $data = Booking::all();
        }
        
        if ($patient == 'patient'){
            $data = Booking::where('patient_id','=', Auth()->id())->get(); 
            // dd($user);
        }
        // dd($user);



        // dd($user);
        return response()->view('cms.bookings.index',['bookings'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $doctor = Doctor::get();
        $patient = Patient::get();
        return response()->view('cms.bookings.create', ['doctors'=>$doctor,'patients'=>$patient]);
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
            'doctor_id' => 'required|integer',
            'patient_id' => 'required|integer',
            'booking_date' => 'required|date',
            'booking' => 'required|boolean',
            
        ]);
        if (!$validator->fails()) {
            $booking = new Booking();
            $booking->doctor_id = $request->input('doctor_id');
            // $request->input('patient_id');
            $booking->patient_id = Auth()->id();
            $booking->booking_date = $request->input('booking_date');
            $booking->booking = $request->input('booking');
            $isSaved = $booking->save();
            return response()->json([
                'message' => $isSaved ? 'Created Successfully' : 'Create failed'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
        $doctor = Doctor::get();
        $patient = Patient::get();
        $bookingdoctor = $booking->doctor()->first();
        $bookingpatient = $booking->patient()->first();
        return response()->view('cms.bookings.update',['booking'=>$booking,'doctors'=>$doctor,'patients'=>$patient,
        'bookingdoctor'=>$bookingdoctor,'bookingpatient'=>$bookingpatient]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
        $validator = Validator($request->all(), [
            'doctor_id' => 'required|integer',
            'patient_id' => 'required|integer',
            'booking_date' => 'required|date',
            'booking' => 'required|boolean',
            
        ]);
        if (!$validator->fails()) {
            $booking->doctor_id = $request->input('doctor_id');
            $booking->patient_id = $request->input('patient_id');
            $booking->booking_date = $request->input('booking_date');
            $booking->booking = $request->input('booking');
            $isUpdateed = $booking->save();
            return response()->json([
                'message' => $isUpdateed ? 'Created Successfully' : 'Create failed'
            ], $isUpdateed ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
        $deleted = $booking->delete();
        return response()->json([
            'title' => $deleted ? 'Deleted successfully' : "Delete failed",
            'icon' => $deleted ? 'success' : "error",
        ], $deleted ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }
}
