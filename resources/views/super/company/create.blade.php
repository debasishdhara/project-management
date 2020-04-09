@extends('super.layouts.app')
@section('style')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('theme/assets/plugins/jquery.steps/css/jquery.steps.css')}}"> --}}
<link href="{{asset('assets/css/mystyle.css')}}" rel="stylesheet"/>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link href="{{asset('theme/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
<!--Start Company Create Content-->
<!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm">
		    <h4 class="page-title">Add Company</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Demo Admin</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Company</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Company</li>
         </ol>
	   </div>
     </div>
    <!-- End Breadcrumb-->
    
    <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header text-uppercase">
              Company Details
            </div>
            <div class="card-body">
                {!! Form::open(['route'=>['add-company'],'id'=>'myvalidation','files' => 'true','enctype'=>'multipart/form-data']) !!}
                <div class="wizard">
                    <div class="wizard-inner">
                        <div class="connecting-line"></div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="nav-item">
                                <a href="#step1" data-toggle="tab" aria-controls="step1" data-href="#step1" role="tab" title="Company Details" class="nav-link active">
                            <span class="round-tab">
                                <i class="fa fa-industry"></i>
                            </span>
                        </a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a href="#step2" data-toggle="tab" aria-controls="step2" data-href="#step2" role="tab" title="User Details" class="nav-link disabled">
                                    <span class="round-tab">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a href="#step3" data-toggle="tab" aria-controls="step3" data-href="#step3" role="tab" title="Check Previous Details" class="nav-link last-step disabled">
                                    <span class="round-tab">
                                        <i class="fa fa-info"></i>
                                    </span>
                                </a>
                            </li>
                            {{-- <li role="presentation" class="nav-item">
                                <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4" class="nav-link disabled">
                            <span class="round-tab">
                                <i class="fa fa-phone"></i>
                            </span>
                        </a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="Step 5" class="nav-link disabled">
                            <span class="round-tab">
                                <i class="fa fa-check"></i>
                            </span>
                        </a>
                            </li> --}}
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="step1">
                            <div class="container">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_name">Company name <span class="text-danger">*</span> </label>
                                                <input type="text" class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" data-massage="Please Fill up Company Name" name="company_name" step="1" data-current="1" value="{{ old('company_name') }}" required>
                                                @if ($errors->has('company_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('company_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_email">E-Mail <span class="text-danger">*</span> </label>
                                                <input type="email" class="form-control {{ $errors->has('company_email') ? 'is-invalid' : '' }}" name="company_email" data-current="1" value="{{ old('company_email') }}" required>
                                                @if ($errors->has('company_email'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('company_email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>                               
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_phone">Phone <span class="text-danger">*</span> </label>
                                                <input type="text" class="form-control {{ $errors->has('company_phone') ? 'is-invalid' : '' }}" name="company_phone" data-current="1" value="{{ old('company_phone') }}" required>
                                                @if ($errors->has('company_phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('company_phone') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_fax">Fax </label>
                                                <input type="text" class="form-control" name="company_fax" value="{{ old('company_fax') }}">
                                            </div>
                                        </div>                               
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_alise">Company Alise Name</label>
                                                <input type="text" class="form-control" name="company_alise" value="{{ old('company_alise') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_address_line_1">Company Address Line 1 <span class="text-danger">*</span> </label>
                                                <input type="text" class="form-control {{ $errors->has('company_address_line_1') ? 'is-invalid' : '' }}" name="company_address_line_1" data-current="1" value="{{ old('company_address_line_1') }}" required>
                                                @if ($errors->has('company_address_line_1'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('company_address_line_1') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>                             
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_address_line_2">Company Address Line 2</label>
                                                <input type="text" class="form-control" name="company_address_line_2" value="{{ old('company_address_line_2') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_address_line_3">Company Address Line 3</label>
                                                <input type="text" class="form-control" name="company_address_line_3" value="{{ old('company_address_line_3') }}">
                                            </div>
                                        </div>                             
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_phone">Country  <span class="text-danger">*</span> </label>
                                                    <select class="form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}" name="country_id" id="country_id" data-current="1" onchange="state_change();" required>
                                                      <option disabled>Select Any</option>
                                                        @foreach($country_all as $country)
                                                            <option value="{{ $country->id }}" {{ old('country_id',101) == $country->id ? 'selected' : ''}}>{{ $country->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('country_id'))
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('country_id') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_fax">State</label>
                                                <select class="form-control" name="state_id" id="state_id" onchange="city_change();">
                                                    <option value="">Select Any</option>
                                                    @foreach($state_all as $state)
                                                            <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : ''}}>{{ $state->title }}</option>
                                                    @endforeach
                                                    </select>
                                            </div>
                                        </div>                               
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_phone">City </label>
                                                    <select class="form-control" name="city_id" id="city_id">
                                                    <option value="">Select Any</option>
                                                    @foreach($city_all as $city)
                                                            <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : ''}}>{{ $city->title }}</option>
                                                    @endforeach
                                                  </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_pin">Pincode</label>
                                                <input type="text" class="form-control" name="company_pin" value="{{ old('company_pin') }}">
                                            </div>
                                        </div>                               
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_gstin">Company Registration No. (GSTIN)  <span class="text-danger">*</span> </label>
                                                <input type="text" class="form-control" name="company_gstin" value="{{ old('company_gstin') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_vat">Company Registration No. (VAT)</label>
                                                <input type="text" class="form-control" name="company_vat" value="{{ old('company_vat') }}">
                                            </div>
                                        </div>                               
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label for="company_logo">Company Logo <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="company_logo_f">Upload</span>
                                                </div>
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input form-control" value="{{ old('company_logo') }}" name="company_logo" id="company_logo"
                                                    aria-describedby="company_logo_f" accept="image/*" data-current="1" required>
                                                <label class="custom-file-label" for="company_logo">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="ml-2 col-sm-6">
                                                <img src="{{asset('assets/img/250x100.png')}}" style="width: 250px;height: 100px;" id="preview" class="img-thumbnail"><span class="text-behance">* Image Size 250x100 </span>
                                              </div>
                                        </div>
                                    </div>
                                    
                            </div>
                            <ul class="list-inline text-md-center">
                                <li>
                                    <button type="button" class="btn btn-lg btn-dark next-step float-right next-button">Next Step</button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step2">
                            <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="frist_name">Frist name </label>
                                        <input type="text" class="form-control {{ $errors->has('frist_name') ? 'is-invalid' : '' }}" name="frist_name" step="1" data-current="1" value="{{ old('frist_name') }}" required>
                                        @if ($errors->has('frist_name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('frist_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="last_name">Last Name </label>
                                        <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" name="last_name" data-current="1" value="{{ old('last_name') }}" required>
                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>                               
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="user_phone">User Phone </label>
                                        <input type="text" class="form-control" name="user_phone" value="{{ old('user_phone') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="user_address_line_1">User Address Line 1</label>
                                        <input type="text" class="form-control" name="user_address_line_1" value="{{ old('user_address_line_1') }}" >
                                    </div>
                                </div>                             
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="user_address_line_2">User Address Line 2</label>
                                        <input type="text" class="form-control" name="user_address_line_2" value="{{ old('user_address_line_2') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="user_address_line_3">User Address Line 3</label>
                                        <input type="text" class="form-control" name="user_address_line_3" value="{{ old('user_address_line_3') }}">
                                    </div>
                                </div>                             
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="user_country">Country </label>
                                            <select class="form-control" name="user_country" id="user_country" onchange="state_change_user();">
                                              <option disabled>Select Any</option>
                                                @foreach($country_all as $country)
                                                    <option value="{{ $country->id }}" {{ old('user_country',101) == $country->id ? 'selected' : ''}}>{{ $country->title }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="user_state">State</label>
                                        <select class="form-control" name="user_state" id="user_state" onchange="city_change_user();">
                                            <option value="">Select Any</option>
                                            @foreach($user_state_all as $state)
                                                    <option value="{{ $state->id }}" {{ old('user_state') == $state->id ? 'selected' : ''}}>{{ $state->title }}</option>
                                            @endforeach
                                            </select>
                                    </div>
                                </div>                               
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="user_city">City </label>
                                            <select class="form-control" name="user_city" id="user_city">
                                            <option value="">Select Any</option>
                                            @foreach($user_city_all as $city)
                                                    <option value="{{ $city->id }}" {{ old('user_city') == $city->id ? 'selected' : ''}}>{{ $city->title }}</option>
                                            @endforeach
                                          </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="user_pincode">Pincode</label>
                                        <input type="text" class="form-control" name="user_pincode" value="{{ old('user_pincode') }}">
                                    </div>
                                </div>                               
                            </div>
                            </div>
                            <ul class="list-inline text-md-center">
                                <li>
                                    <button type="button" class="btn btn-lg btn-dark prev-step float-left prev-button">Previous Step</button>
                                    <button type="button" class="btn btn-lg btn-dark next-step float-right next-button last-step">Next Step</button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step3">
                            <div class="row">
                                <div class="col-md-12 form-group card">
                                    <fieldset style="background: #414548ad;padding: 5px;border-radius: 9px;padding-bottom: 2%;">
                                        <legend style="background: #3c3939fc;width: 23%;margin-left: 1%;padding-left: 1%;border-radius: 9px;">Company Details:</legend>
                                        <div class="container">
                                            <span>Company Name</span>: &nbsp;&nbsp;&nbsp; <span class="span_company_name"></span><br>
                                            <span>E-Mail</span>: &nbsp;&nbsp;&nbsp; <span class="span_company_email"></span><br>
                                            <span>Phone</span>: &nbsp;&nbsp;&nbsp; <span class="span_company_phone"></span><br>
                                            <span>Fax</span>: &nbsp;&nbsp;&nbsp; <span class="span_company_fax"></span><br>
                                            <span>Company Address Line 1</span>: &nbsp;&nbsp;&nbsp; <span class="span_company_address_line_1"></span><br>
                                            <span>Company Address Line 2</span>: &nbsp;&nbsp;&nbsp; <span class="span_company_address_line_2"></span><br>
                                            <span>Company Address Line 3</span>: &nbsp;&nbsp;&nbsp; <span class="span_company_address_line_3"></span><br>
                                            <span>Company Registration No. (GSTIN)</span>: &nbsp;&nbsp;&nbsp; <span class="span_company_gstin"></span><br>
                                            <span>Company Registration No. (VAT)</span>: &nbsp;&nbsp;&nbsp; <span class="span_company_vat"></span><br>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-12 form-group card">
                                    <fieldset style="background: #414548ad;padding: 5px;border-radius: 9px;padding-bottom: 2%;">
                                        <legend style="background: #3c3939fc;width: 23%;margin-left: 1%;padding-left: 1%;border-radius: 9px;">User Details:</legend>
                                        <div class="container">
                                            <span>Frist Name</span>: &nbsp;&nbsp;&nbsp; <span class="span_frist_name"></span><br>
                                            <span>Last Name</span>: &nbsp;&nbsp;&nbsp; <span class="span_last_name"></span><br>
                                            <span>Username</span>: &nbsp;&nbsp;&nbsp; <span class="span_company_email"></span><br>
                                            <span>Phone</span>: &nbsp;&nbsp;&nbsp; <span class="span_user_phone"></span><br>
                                            <span>User Address Line 1</span>: &nbsp;&nbsp;&nbsp; <span class="span_user_address_line_1"></span><br>
                                            <span>User Address Line 2</span>: &nbsp;&nbsp;&nbsp; <span class="span_user_address_line_2"></span><br>
                                            <span>User Address Line 3</span>: &nbsp;&nbsp;&nbsp; <span class="span_user_address_line_3"></span><br>
                                            
                                        </div>
                                    </fieldset>
                                </div>          
                            </div>
                            <ul class="list-inline text-md-center">
                                <li>
                                    <button type="button" class="btn btn-lg btn-dark prev-step float-left prev-button">Previous Step</button>
                                    <button type="button" class="btn btn-lg btn-dark next-step float-right next-button last-button">Submit</button>
                                </li>
                            </ul>
                        </div>
                        {{-- <div class="tab-pane" role="tabpanel" id="step4">
                            <h1 class="text-md-center">Step 4</h1>
                            <div class="row">
                               
                            </div>
                            <ul class="list-inline text-md-center">
                                <li><button type="button" class="btn btn-lg btn-common next-step next-button">Next Step</button></li>
                            </ul>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step5">
                            <h1 class="text-md-center">Complete</h1>
                            <div class="row">


                            </div>
                        </div> --}}
                        <div class="clearfix"></div>
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
<!--Form Wizard-->
  {{-- <script src="{{asset('theme/assets/plugins/jquery.steps/js/jquery.steps.min.js')}}"></script>
  <script src="{{asset('theme/assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
  <!--wizard initialization-->
  <script src="{{asset('theme/assets/plugins/jquery.steps/js/jquery.wizard-init.js')}}"></script>  --}}
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src="{{asset('theme/assets/plugins/select2/js/select2.min.js')}}"></script>
  <script src="{{asset('assets/js/myjs.js')}}"></script>
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

  function state_change_user(){
    var country_id=$('#user_country').val();
    $.ajax({
        url: "{{route('state-json')}}",
        type:'post',
        dataType: 'json',
        data: {'country_id' : country_id,_token: "{{csrf_token()}}"},
        success: function (data) {
              $("#user_state").select2("destroy");
              var ele ='<option>Select Any State</option>';
              for (var i = 0; i < data.length; i++) {
                // POPULATE SELECT ELEMENT WITH JSON.
                ele+='<option value="' + data[i]['id'] + '">' + data[i]['text'] + '</option>';
              } 
              $("#user_state").html(ele);
            // Transforms the top-level key of the response object from 'items' to 'results'
            $('#user_state').select2();
            /*return {
              results: data
            };*/
        }
        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
    });
}
function city_change_user(){
    
  var state_id=$('#user_state').val();
  $.ajax({
      url: "{{route('city-json')}}",
      type:'post',
      dataType: 'json',
      data: {'state_id' : state_id,_token: "{{csrf_token()}}"},
      success: function (data) {
            $("#user_city").select2("destroy");
            var ele ='<option>Select Any City</option>';
            for (var i = 0; i < data.length; i++) {
              // POPULATE SELECT ELEMENT WITH JSON.
              ele+='<option value="' + data[i]['id'] + '">' + data[i]['text'] + '</option>';
            } 
            $("#user_city").html(ele);
          // Transforms the top-level key of the response object from 'items' to 'results'
          $('#user_city').select2();
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
      $('#user_country').select2(); 
      $('#user_state').select2();
      $('#user_city').select2();
      


    })
  </script>
  <script>
     $('input[type="file"]').change(function(e) {
        if(e.target.files[0]){
        var resizedImage;

        // Read in file
        var file = e.target.files[0];
    
        // Ensure it's an image
        if(file.type.match(/image.*/)) { 
            var fileName = e.target.files[0].name;
            $('.custom-file-label').text(fileName);   
            // Load the image
            var reader = new FileReader();
            reader.onload = function (readerEvent) {
                var image = new Image();
                image.onload = function (imageEvent) {
    
                    // Resize the image
                    var canvas = document.createElement('canvas'),
                        max_size = 1200,
                        width = image.width,
                        height = image.height;
                    if (width > height) {
                        if (width > max_size) {
                            height *= max_size / width;
                            width = max_size;
                        }
                    } else {
                        if (height > max_size) {
                            width *= max_size / height;
                            height = max_size;
                        }
                    }
                    canvas.width = 250;//width;
                    canvas.height = 100;//height;
                    canvas.getContext('2d').drawImage(image, 0, 0, width, height);
                    resizedImage = canvas.toDataURL('image/jpeg');

                    $('input[type="file"]').src = canvas.toDataURL();
                    document.getElementById("preview").src =canvas.toDataURL();
                }
                image.src = readerEvent.target.result;
                
            }
            reader.readAsDataURL(file);
            
            /*var reader = new FileReader();
            reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);  */
        }
        
         
        }else{
            $('.custom-file-label').text('Choose file');
            document.getElementById("preview").src ="{{asset('assets/img/250x100.png')}}";
        }
      });
      /*$("input[type=file]").bind("change", function() {
        var selected_file_name = $(this).val();
        if ( selected_file_name.length > 0 ) {
            /* Some file selected 
        }
        else {
            $('.custom-file-label').text('Choose file');
            document.getElementById("preview").src ="{{asset('assets/img/250x100.png')}}";
            /* No file selected or cancel/close
               dialog button clicked 
            /* If user has select a file before,
               when they submit, it will treated as
               no file selected
        }
    });*/
  </script>
@endsection
