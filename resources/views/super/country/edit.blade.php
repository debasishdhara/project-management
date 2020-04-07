@extends('super.layouts.app')
@section('style')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')
<!--Start Country Create Content-->
<!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm">
		    <h4 class="page-title">Add Country</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Demo Admin</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Location Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Country</li>
         </ol>
	   </div>
     </div>
    <!-- End Breadcrumb-->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <div class="card-title">Country Details</div>
                <hr>
                {!! Form::open(['route'=>['edit-countries',$country_details->id]]) !!}
                <div class="form-group row">
                 <label for="input-26" class="col-sm-2 col-form-label">Country Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('country_title') ? 'is-invalid' : '' }}" name="country_title" value="{{ old('country_title', $country_details->title) }}" required>
                    @if ($errors->has('country_title'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('country_title') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                    <label for="input-26" class="col-sm-2 col-form-label">Country Alise</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('sort_name') ? 'is-invalid' : '' }}" name="sort_name" value="{{ old('sort_name', $country_details->sort_name) }}" required>
                    @if ($errors->has('sort_name'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('sort_name') }}</strong>
                    </span>
                    @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input-26" class="col-sm-2 col-form-label">Country Code</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('phone_code') ? 'is-invalid' : '' }}" name="phone_code" value="{{ old('phone_code', $country_details->phone_code) }}" required>
                    @if ($errors->has('phone_code'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone_code') }}</strong>
                    </span>
                    @endif
                    </div>
                </div>
               <div class="form-group row">
                 <label for="input-27" class="col-sm-2 col-form-label">Status</label>
                 <div class="col-sm-10">
                    <input type="checkbox" id="toggle-two" name="country_status" @if(old('country_status',$country_details->country_status)) checked @endif data-onstyle="success" data-offstyle="danger">
                    
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
