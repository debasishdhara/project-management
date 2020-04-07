@extends('super.layouts.app')
@section('style')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link href="{{asset('theme/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
<!--Start City Create Content-->
<!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm">
		    <h4 class="page-title">Add Sub-City</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Demo Admin</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Location Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Sub-City</li>
         </ol>
	   </div>
     </div>
    <!-- End Breadcrumb-->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <div class="card-title">Sub-City Details</div>
                <hr>
                {!! Form::open(['route'=>['edit-sub-cities',$subcity_details->id]]) !!}
                <div class="form-group row">
                 <label for="input-26" class="col-sm-2 col-form-label">SubCity Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('subcity_title') ? 'is-invalid' : '' }}" name="subcity_title" value="{{ old('subcity_title',$subcity_details->title) }}" required>
                    @if ($errors->has('subcity_title'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('subcity_title') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input-26" class="col-sm-2 col-form-label">SubCity ZipCode</label>
                   <div class="col-sm-10">
                     <input type="text" class="form-control" name="zip_code" value="{{ old('zip_code',$subcity_details->zip_code) }}" >
                   </div>
                 </div>
                <div class="form-group row">
                    <label for="input-26" class="col-sm-2 col-form-label">Country</label>
                    <div class="col-sm-10">
                        <select class="form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}" name="country_id" id="country_id" onchange="state_change();" required>
                          <option>Select Any</option>
                            @foreach($country_all as $country)
                                <option value="{{ $country->id }}" {{ old('country_id',$subcity_details->city->state->country_id) == $country->id ? 'selected' : ''}}>{{ $country->title }}</option>
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
                    <label for="input-26" class="col-sm-2 col-form-label">State</label>
                    <div class="col-sm-10">
                        <select class="form-control {{ $errors->has('state_id') ? 'is-invalid' : '' }}" name="state_id" id="state_id" onchange="city_change();" required>
                          <option>Select Any</option>
                          @foreach($state_all as $state)
                                <option value="{{ $state->id }}" {{ old('state_id',$subcity_details->city->state_id) == $state->id ? 'selected' : ''}}>{{ $state->title }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('state_id'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('state_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                  <label for="input-26" class="col-sm-2 col-form-label">City</label>
                  <div class="col-sm-10">
                      <select class="form-control {{ $errors->has('city_id') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                        <option>Select Any</option>
                        @foreach($city_all as $city)
                                <option value="{{ $city->id }}" {{ old('city_id',$subcity_details->city_id) == $city->id ? 'selected' : ''}}>{{ $city->title }}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('city_id'))
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('city_id') }}</strong>
                      </span>
                      @endif
                  </div>
              </div>
               <div class="form-group row">
                 <label for="input-27" class="col-sm-2 col-form-label">Status</label>
                 <div class="col-sm-10">
                    <input type="checkbox" id="toggle-two" name="subcity_status" @if(old('subcity_status',$subcity_details->subcity_status)) checked @endif data-onstyle="success" data-offstyle="danger">
                    
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
    function state_change(){
        var country_id=$('#country_id').val();
        $.ajax({
            url: "{{route('state-json')}}",
            type:'post',
            dataType: 'json',
            data: {'country_id' : country_id,_token: "{{csrf_token()}}"},
            success: function (data) {
                  $("#state_id").select2("destroy");
                  var ele ='<option>Select Any State</option>';
                  for (var i = 0; i < data.length; i++) {
                    // POPULATE SELECT ELEMENT WITH JSON.
                    ele+='<option value="' + data[i]['id'] + '">' + data[i]['text'] + '</option>';
                  } 
                  $("#state_id").html(ele);
                // Transforms the top-level key of the response object from 'items' to 'results'
                $('#state_id').select2();
                /*return {
                  results: data
                };*/
            }
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        });
    }
    function city_change(){
      var state_id=$('#state_id').val();
      $.ajax({
          url: "{{route('city-json')}}",
          type:'post',
          dataType: 'json',
          data: {'state_id' : state_id,_token: "{{csrf_token()}}"},
          success: function (data) {
                $("#city_id").select2("destroy");
                var ele ='<option>Select Any City</option>';
                for (var i = 0; i < data.length; i++) {
                  // POPULATE SELECT ELEMENT WITH JSON.
                  ele+='<option value="' + data[i]['id'] + '">' + data[i]['text'] + '</option>';
                } 
                $("#city_id").html(ele);
              // Transforms the top-level key of the response object from 'items' to 'results'
              $('#city_id').select2();
              /*return {
                results: data
              };*/
          }
          // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
      });
  }
    $(function() {
      $('#toggle-two').bootstrapToggle({
        on: 'Enabled',
        off: 'Disabled'
      });
      $('#country_id').select2(); 
      $('#state_id').select2();
      $('#city_id').select2();
    })
  </script>
@endsection
