@extends('super.layouts.app')
@section('style')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link href="{{asset('theme/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
<!--Start State Create Content-->
<!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm">
		    <h4 class="page-title">Edit State</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Demo Admin</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Location Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit State</li>
         </ol>
	   </div>
     </div>
    <!-- End Breadcrumb-->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <div class="card-title">State Details</div>
                <hr>
                {!! Form::open(['route'=>['edit-states',$state_details->id]]) !!}
                <div class="form-group row">
                 <label for="input-26" class="col-sm-2 col-form-label">State Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('state_title') ? 'is-invalid' : '' }}" name="state_title" value="{{ old('state_title', $state_details->title) }}" required>
                    @if ($errors->has('state_title'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('state_title') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                    <label for="input-26" class="col-sm-2 col-form-label">Country</label>
                    <div class="col-sm-10">
                        <select class="form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                            <option></option>
                            @foreach($country_all as $country)
                                <option value="{{ $country->id }}" {{ old('country_id', $state_details->country_id) == $country->id ? 'selected' : ''}}>{{ $country->title }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('country_id'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('country_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
               <div class="form-group row">
                 <label for="input-27" class="col-sm-2 col-form-label">Status</label>
                 <div class="col-sm-10">
                    <input type="checkbox" id="toggle-two" name="state_status" @if(old('state_status',$state_details->state_status)) checked @endif data-onstyle="success" data-offstyle="danger">
                    
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
<script src="{{asset('theme/assets/plugins/select2/js/select2.min.js')}}"></script>
<script>
    $(function() {
      $('#toggle-two').bootstrapToggle({
        on: 'Enabled',
        off: 'Disabled'
      });
      $('#country_id').select2();
    })
  </script>
@endsection
