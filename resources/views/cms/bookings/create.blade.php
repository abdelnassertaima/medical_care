@extends('cms.parent');

@section('title','Create bookings')
@section('page-name','nas');
@section('main-page','bookings');
@section('sub-page','create');
@section('page-name-small','bookings');

@section('styles')
    
@endsection

@section('content')

<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Create New Booking</h3>
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
                            <label for="username ">doctors Name :</label>
                            <div class="col-9">
                                <select class="form-control selectpicker" data-size="7" id="doctor_id"
                                title="Choose one of the following..." tabindex="null" data-live-search="true">
                               @foreach($doctors as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                @endforeach
                            
                            </select>
                                {{-- <input type="integer" class="form-control" id="course_category_id" placeholder="Enter course category id" /> --}}
                                <span class="form-text text-muted">Please enter your client id</span>
                            </div>
                        </div>
                    
                        <div class="form-group col-4">
                            <label for="membership_type ">patients name :</label>
                            <div class="col-9">
                                <select class="form-control selectpicker" data-size="7" id="patient_id"
                                title="Choose one of the following..." tabindex="null" data-live-search="true">
                               @foreach($patients as $patient)
                                <option value="{{$patient->id}}">{{$patient->name}}</option>
                                @endforeach
                            
                            </select>
                                <span class="form-text text-muted">Please enter your Membership id</span>
                            </div>
                        </div>
                
                        <div class="form-group col-4">
                            <label for="membership_start_date ">booking date</label>
                            <input type="date" class="form-control" id="booking_date" placeholder="Enter Membership start date">
                        </div>

                        <div class="form-group col-4">
                            <label for="days_remaining ">booking paid</label>
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" checked="checked" id="booking">
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
                            <button type="button" onclick="performStore()" class="btn btn-primary mr-2">Submit</button>
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
function performStore(){
    axios.post('/cms/admin/bookings', {
        
        doctor_id: document.getElementById('doctor_id').value,
        patient_id: document.getElementById('patient_id').value,
        booking_date: document.getElementById('booking_date').value,
        booking: document.getElementById('booking').checked,
    })
    .then(function (response) {
        console.log(response);
        document.getElementById('create-form').reset();
        toastr.success(response.data.message);
    })
    .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.message);
    });
}
</script>
    
@endsection
