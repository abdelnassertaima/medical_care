@extends('cms.parent')
@section('title','Create roles')
@section('page-name','Create clinic')
@section('main-page','Roles & clinics')
@section('sub-page','clinics')
@section('page-name-small','Create clinic')

@section('styles')

@endsection

@section('content')
<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Horizontal Form Layout</h3>
                {{-- <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                            <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                        </div>
                    </div> --}}
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">Clinic name:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="name" placeholder="Enter full name" />
                            <span class="form-text text-muted">Please enter your full Clinic name</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">description:<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <textarea class="form-control" type="text" id="description" rows="3"></textarea>
                            <span class="form-text text-muted">Please enter your full description</span>
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
        axios.post('/cms/admin/clinics',{
                name: document.getElementById('name').value,
                description: document.getElementById('description').value,
            }).then(function (response) {
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