@extends('cms.parent');

@section('title','Update Doctor')
@section('page-name','Update');
@section('main-page','Doctor');
@section('sub-page','Update');
@section('page-name-small','Doctor');

@section('styles')
    
@endsection

@section('content')

<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Update Doctor</h3>
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
                                    <option value="{{$role->id}}" @if ($doctorRole->id == $role->id) selected 
                                        @endif>{{$role->name}}>{{$role->name}}</option>
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
                            <input type="text" class="form-control" id="name" value="{{$doctor->name}}"/>
                            <span class="form-text text-muted">Please enter your full name</span>
                        </div>
                    </div>
                   
                    
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Email address:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="email" class="form-control" id="email" value="{{$doctor->email}}"/>
                            <span class="form-text text-muted">We'll never share your email with anyone else</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">Bachelors degree:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="Bachelors_degree"  value="{{$doctor->Bachelors_degree}}"
                                     tabindex="null" data-live-search="true">
                                    <option value="bakaluryus" @if($role->guard_name == 'bakaluryus') selected @endif>Bakaluryus</option>
                                    <option value="master's" @if($role->guard_name == 'master s') selected @endif>Master's</option>
                                    <option value="dukturah" @if($role->guard_name == 'dukturah') selected @endif>Dukturah</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">Please enter your Bachelors degree</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">specialty:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="specialty"  value="{{$doctor->specialty}}"
                                     tabindex="null" data-live-search="true">
                                    <option value="bones"  @if($role->guard_name == 'bones') selected @endif>bones</option>
                                    <option value="batina" @if($role->guard_name == 'batina') selected @endif>batina</option>
                                    <option value="surgery" @if($role->guard_name == 'surgery') selected @endif>surgery</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">Please enter your specialty</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">clinic name:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <select class="form-control selectpicker" data-size="7" id="clinic_id" 
                            title="Choose one of the following..." tabindex="null" data-live-search="true">
                           @foreach($clinics as $clinic)
                            <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                            @endforeach
                        
                        </select>
                            <span class="form-text text-muted">Please enter your clinic name</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">Practice Certificate:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="file" class="form-control-file" id="practice_certificate">
                            <span class="form-text text-muted">Please enter your practice certificate</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">Certificate of good conduct:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="file" class="form-control-file" id="Certificate_of_good_conduct">
                            <span class="form-text text-muted">Please enter your Certificate of good conduct</span>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="performStore({{$doctor->id}})" class="btn btn-primary mr-2">Submit</button>
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

function performStore(id) {
        let formData = new FormData();
        formData.append('_method','PUT');
        formData.append('role_id',document.getElementById('role_id').value);
        formData.append('name',document.getElementById('name').value);
        formData.append('email',document.getElementById('email').value);
        formData.append('Bachelors_degree',document.getElementById('Bachelors_degree').value);
        formData.append('specialty',document.getElementById('specialty').value);
        formData.append('clinic_id',document.getElementById('clinic_id').value);
        if(document.getElementById('practice_certificate').files[0] != undefined){
            formData.append('practice_certificate', document.getElementById('practice_certificate').files[0])
        }
        if(document.getElementById('Certificate_of_good_conduct').files[0] != undefined){
            formData.append('Certificate_of_good_conduct', document.getElementById('Certificate_of_good_conduct').files[0])
        }
        axios.post('/cms/admin/doctors'+id, formData).then(function (response) {
            // handle success
            console.log(response);
            toastr.success(response.data.message);
        }).catch(function (error) {
            // handle error
            console.log(error);
            toastr.error(error.response.data.message);
        });
    }
</script>
    
@endsection
