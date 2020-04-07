@extends('super.layouts.app')
@section('style')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link href="{{asset('theme/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
<!--Start permission Create Content-->
<!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm">
		    <h4 class="page-title">Add Permission</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Demo Admin</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Privilege Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Permission</li>
         </ol>
	   </div>
     </div>
    <!-- End Breadcrumb-->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <div class="card-title">Permission Details</div>
                <hr>
                {!! Form::open(['route'=>['add-permission']]) !!}
                <div class="form-group row">
                 <label for="input-26" class="col-sm-2 col-form-label">Permission Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('permission_title') ? 'is-invalid' : '' }}" name="permission_title" value="{{ old('permission_title') }}" required>
                    @if ($errors->has('permission_title'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('permission_title') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                    <label for="input-26" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <input type="checkbox" id="checkbox" >Select All
                        <select class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" name="role_id[]" id="role_id" multiple onchange="checkfall();" required>
                            @foreach($role_all as $role)
                                <option value="{{ $role->id }}" {{ (collect(old('role_id'))->contains($role->id)) ? 'selected' : ''}}>{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('role_id'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
               <div class="form-group row">
                 <label for="input-27" class="col-sm-2 col-form-label">Status</label>
                 <div class="col-sm-10">
                    <input type="checkbox" id="toggle-two" name="permission_status" @if(old('permission_status')) checked @endif data-onstyle="success" data-offstyle="danger">
                    
                 </div>
               </div>
                <div class="form-group row">
                 <label class="col-sm-2 col-form-label"></label>
                 <div class="col-sm-10">
                 <button type="submit" class="btn btn-primary btn-round px-5"><i class="fa fa-database"> Add</i></button>
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
<script src="{{asset('theme/assets/plugins/select2/js/select2.min.js')}}"></script>
<script>
    $(function() {
      $('#toggle-two').bootstrapToggle({
        on: 'Enabled',
        off: 'Disabled'
      });
      $('#role_id').select2();
    });
    function checkfall(){
      if($("#role_id option").length == $("#role_id option:selected").length) {
        $("#checkbox").prop("checked", true);
      } else {
          $("#checkbox").removeAttr("checked");
      }
    }
    $("#checkbox").click(function(){
      if($("#checkbox").is(':checked') ){
          $("#role_id > option").prop("selected","selected");
          $("#role_id").trigger("change");
      }else{
          $("#role_id > option").removeAttr("selected");
           $("#role_id").trigger("change");
       }
    });
  </script>
@endsection