@extends('super.layouts.app')
@section('style')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')
<!--Start Role Create Content-->
<!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm">
		    <h4 class="page-title">Add Role</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Demo Admin</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Privilege Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Role</li>
         </ol>
	   </div>
     </div>
    <!-- End Breadcrumb-->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <div class="card-title">Role Details</div>
                <hr>
                {!! Form::open(['route'=>['edit-role',$role_details->id]]) !!}
                <div class="form-group row">
                 <label for="input-26" class="col-sm-2 col-form-label">Role Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('role_name') ? 'is-invalid' : '' }}" name="role_name" value="{{ old('role_name', $role_details->role_name) }}" required>
                    @if ($errors->has('role_name'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('role_name') }}</strong>
                    </span>
                    @endif
                  </div>
               </div>
               <div class="form-group row">
                 <label for="input-27" class="col-sm-2 col-form-label">Status</label>
                 <div class="col-sm-10">
                    <input type="checkbox" id="toggle-two" name="role_status" @if(old('role_status',$role_details->role_status)) checked @endif data-onstyle="success" data-offstyle="danger">
                    
                 </div>
               </div>
                <div class="form-group row">
                 <label class="col-sm-2 col-form-label"></label>
                 <div class="col-sm-10">
                 <button type="submit" class="btn btn-primary btn-round px-5"><i class="fa fa-database"> Update</i></button>
                 </div>
               </div>
               {!! Form::close() !!}
              </div>
            </div>
        </div>
      </div><!-- End Row-->
      <!--start overlay-->
	  <div class="overlay toggle-menu"></div>
	<!--end overlay-->
<!--End Company Create Content-->

@endsection
@section('script')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(function() {
      $('#toggle-two').bootstrapToggle({
        on: 'Enabled',
        off: 'Disabled'
      });
    })
  </script>
@endsection
