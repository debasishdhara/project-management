@extends('super.layouts.app')
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('theme/assets/plugins/jquery.steps/css/jquery.steps.css')}}">
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
              Validation Form Wizard
            </div>
            <div class="card-body">
             <form id="wizard-validation-form" action="#">
                    <div>
                        <h3>Step 1</h3>
                        <section>
                            <div class="form-group">
                                <label for="userName2">User name </label>
                                <input class="required form-control" id="userName2" name="userName" type="text">
                            </div>
                            <div class="form-group">
                                <label for="password2"> Password *</label>
                                <input id="password2" name="password" type="text" class="required form-control">
                            </div>

                            <div class="form-group">
                                <label for="confirm2">Confirm Password *</label>
                                <input id="confirm2" name="confirm" type="text" class="required form-control">
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 control-label">(*) Mandatory</label>
                            </div>
                        </section>
                        <h3>Step 2</h3>
                        <section>

                            <div class="form-group">
                                <label for="name2"> First name *</label>
                                    <input id="name2" name="name" type="text" class="required form-control">
                            </div>
                            <div class="form-group">
                                <label for="surname2"> Last name *</label>
                                    <input id="surname2" name="surname" type="text" class="required form-control">
                            </div>

                            <div class="form-group">
                                <label for="email2">Email *</label>
                                <input id="email2" name="email" type="text" class="required email form-control">
                            </div>

                            <div class="form-group">
                                <label for="address2">Address </label>
                                <input id="address2" name="address" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="col-lg-12 control-label">(*) Mandatory</label>
                            </div>
                        </section>
                        <h3>Step 3</h3>
                        <section>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <ul class="list-unstyled w-list">
                                        <li>First Name : Jonathan </li>
                                        <li>Last Name : Smith </li>
                                        <li>Emial: jonathan@example.com</li>
                                        <li>Address: 123 Your City, Cityname. </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                        <h3>Step Final</h3>
                        <section>
                            <div class="form-group">
                                <div class="col-lg-12">
                                  
                                <div class="icheck-material-white">
                                   <input id="acceptTerms-2" name="acceptTerms2" type="checkbox" class="required">
                                    <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                                </div>
                                    
                                </div>
                            </div>
                        </section>
                    </div>
                </form>
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
  <script src="{{asset('theme/assets/plugins/jquery.steps/js/jquery.steps.min.js')}}"></script>
  <script src="{{asset('theme/assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
  <!--wizard initialization-->
  <script src="{{asset('theme/assets/plugins/jquery.steps/js/jquery.wizard-init.js')}}"></script>
@endsection
