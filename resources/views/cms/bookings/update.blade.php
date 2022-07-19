@extends('cms.parent');


@section('page-name','Update booking');
@section('main-page','booking');
@section('sub-page','Update');
@section('page-name-small','booking');

@section('styles')
    
@endsection

@section('content')

<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Update booking</h3>
                {{-- <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                            <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                        </div>
                    </div> --}}
            </div>
            <!--begin::Form-->
            <form id="create-form">
                @csrf
                <div class="card-body">
                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">Basic Info</h3>
                    

                    <div class="row">
                         <div class="form-group col-4">
                            <label for="username ">doctors Name</label>
                            <div class="col-9">
                                <select class="form-control selectpicker" data-size="7" id="doctor_id"
                                title="Choose one of the following..." tabindex="null" data-live-search="true">
                               @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}" @if ($bookingdoctor->id == $doctor->id) selected 
                                    @endif>{{$doctor->name}}</option>
                                @endforeach
                            </select>
                                <span class="form-text text-muted">Please enter your doctor name</span>
                            </div>
                        </div>
                        
                    
                        <div class="form-group col-4">
                            <label for="membership_type ">patients name</label>
                            <div class="col-9">
                                <select class="form-control selectpicker" data-size="7" id="patient_id"
                                title="Choose one of the following..." tabindex="null" data-live-search="true">
                               @foreach($patients as $patient)
                                <option value="{{$patient->id}}"  @if ($bookingpatient->id == $patient->id) selected 
                                    @endif>{{$patient->name}}</option>
                                @endforeach
                            
                            </select>
                                <span class="form-text text-muted">Please enter your patient name</span>
                            </div>
                        </div>
                
                        <div class="form-group col-4">
                            <label for="booking_date ">Booking date</label>
                            <input type="date" class="form-control" id="booking_date" value="{{$booking->booking_date}}" placeholder="Enter booking date">
                        </div>
                        <div class="form-group col-4">
                            <label for="booking_date ">Treatment</label>
                            <input type="string" class="form-control" id="treatment" value="{{$booking->treatment}}" placeholder="Enter treatment">
                        </div>

                        <div class="form-group col-4">
                            <label for="days_remaining ">Booking : </label>
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" id="booking" @if($booking->booking) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </div>                                            
                    </div>
                </div>
           
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="Updat({{$booking->id}})" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
</div>
<!--end::Container-->
    
@endsection

@section('scripts')

<script>
function Updat(id){
    axios.put('/cms/admin/bookings/'+id, {
        doctor_id: document.getElementById('doctor_id').value,
        patient_id: document.getElementById('patient_id').value,
        booking_date: document.getElementById('booking_date').value,
        treatment: document.getElementById('treatment').value,
        booking: document.getElementById('booking').checked,
    })
    .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);
    })
    .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.message);
    });
}
</script>
    
@endsection
