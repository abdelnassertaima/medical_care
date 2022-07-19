@extends('cms.parent')

@section('page-name','Edit patient')
@section('main-page','Human Resources')
@section('sub-page','patients')
@section('page-name-small','Edit patient')

@section('styles')

@endsection

@section('content')

<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Update New patient</h3>
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
                    <h3 class="text-dark font-weight-bold mb-10">Role</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Role:<span class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="role_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}" @if ($patientRole->id == $role->id) selected 
                                    @endif>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">Please select store role</span>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">Basic Info</h3>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">Full Name:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="name" value="{{$patient->name}}" placeholder="Enter full name" />
                            <span class="form-text text-muted">Please enter your full name</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">Mobile:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="tel" class="form-control" id="phone_num" value="{{$patient->phone_num}}" placeholder="Enter mobile" />
                            <span class="form-text text-muted">Please enter your mobile number</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Email address:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" class="form-control" id="email" value="{{$patient->email}}" placeholder="Enter email" />
                            <span class="form-text text-muted">We'll never share your email with anyone else</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">Full address:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="address" value="{{$patient->address}}" placeholder="Enter full name" />
                            <span class="form-text text-muted">Please enter your full address</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">Complaint:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="complaint" value="{{$patient->complaint}}"/>
                            <span class="form-text text-muted">Please enter your complaint</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">Chronic Diseases:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="chronic_diseaes" value="{{$patient->chronic_diseaes}}"/>
                            <span class="form-text text-muted">Please enter your chronic diseases</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">Previous Operations:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="previous_operations" value="{{$patient->previous_operations}}"/>
                            <span class="form-text text-muted">Please enter your previous operations</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">identification_num:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="identification_num" value="{{$patient->identification_num}}" placeholder="Enter full name" />
                            <span class="form-text text-muted">Please enter your identification_num</span>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-3 col-form-label">Active Account</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" id="status" @if($patient->status) checked @endif>
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div> --}}
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="Updat({{$patient->id}})" class="btn btn-primary mr-2">Submit</button>
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
    axios.put('/cms/admin/patients/'+id, {
        role_id: document.getElementById('role_id').value,
        name: document.getElementById('name').value,
        phone_num: document.getElementById('phone_num').value,
        email: document.getElementById('email').value,
        address: document.getElementById('address').value,
            complaint: document.getElementById('complaint').value,
            chronic_diseaes: document.getElementById('chronic_diseaes').value,
            previous_operations: document.getElementById('previous_operations').value,
            identification_num: document.getElementById('identification_num').value,
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