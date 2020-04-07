@extends('super.layouts.app')
@section('style')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link href="{{asset('theme/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="{{asset('theme/assets/plugins/summernote/dist/summernote-bs4.css')}}"/>
@endsection
@section('content')
<!--Start Licence Create Content-->
<!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm">
		    <h4 class="page-title">Add Licence</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Demo Admin</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Privilege Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Licence</li>
         </ol>
	   </div>
     </div>
    <!-- End Breadcrumb-->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <div class="card-title">Licence Details</div>
                <hr>
                {!! Form::open(['route'=>['add-licence']]) !!}
                <div class="form-group row">
                 <label for="licence_name" class="col-sm-2 col-form-label">Licence Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('licence_name') ? 'is-invalid' : '' }}" name="licence_name" value="{{ old('licence_name') }}" required>
                    @if ($errors->has('licence_name'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('licence_name') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label for="licence_description" class="col-sm-2 col-form-label">Licence Desciption</label>
                   <div class="col-sm-10">
                     <textarea class="form-control {{ $errors->has('licence_description') ? 'is-invalid' : '' }}" name="licence_description" id="licence_description" required>
                      {{ old('licence_description') }}
                     </textarea>
                     @if ($errors->has('licence_description'))
                         <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('licence_description') }}</strong>
                     </span>
                     @endif
                   </div>
                 </div>
                 <div class="form-group row">
                  <label for="licence_amount" class="col-sm-2 col-form-label">Amount</label>
                   <div class="col-sm-10">
                     <input type="number" min="0" class="form-control {{ $errors->has('licence_amount') ? 'is-invalid' : '' }}" name="licence_amount" value="{{ old('licence_amount',0) }}" onchange="amount_settings();" required>
                     @if ($errors->has('licence_amount'))
                         <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('licence_amount') }}</strong>
                     </span>
                     @endif
                   </div>
                 </div>
                 <div class="form-group row">
                  <label for="licence_discount" class="col-sm-2 col-form-label">Discount (%)</label>
                   <div class="col-sm-10">
                     <input type="number" min="0" max="100" class="form-control" name="licence_discount" value="{{ old('licence_discount',0) }}"  onchange="amount_settings();" >
                   </div>
                 </div>
                 <div class="form-group row">
                  <label for="licence_total" class="col-sm-2 col-form-label">Total Amount</label>
                   <div class="col-sm-10">
                     <input type="number" min="0" class="form-control" name="licence_total" value="{{ old('licence_total',0) }}"  onchange="amount_settings();" readonly>
                   </div>
                 </div>
                 <div class="form-group row">
                  <label for="licence_tax" class="col-sm-2 col-form-label">Tax (%)</label>
                   <div class="col-sm-10">
                     <input type="number" min="0" max="100" class="form-control" name="licence_tax"  onchange="amount_settings();" value="{{ old('licence_tax',0) }}">
                   </div>
                 </div>
                 <div class="form-group row">
                  <label for="licence_taxableamount" class="col-sm-2 col-form-label">Total Amount with Tax</label>
                   <div class="col-sm-10">
                     <input type="number" min="0" class="form-control" name="licence_taxableamount"  onchange="amount_settings();" value="{{ old('licence_taxableamount',0) }}" readonly>
                   </div>
                 </div>
                 <div class="form-group row">
                  <label for="licence_net_amount" class="col-sm-2 col-form-label">Payment Amount</label>
                   <div class="col-sm-10">
                     <input type="number" min="0" class="form-control" name="licence_net_amount"  onchange="amount_settings();" value="{{ old('licence_net_amount',0) }}" readonly>
                   </div>
                 </div>
                 <div class="form-group row">
                  <label for="licence_validity" class="col-sm-2 col-form-label">Validity <span class="small">(How many days !!!)</span></label>
                   <div class="col-sm-10">
                     <input type="number" min="0" class="form-control {{ $errors->has('licence_validity') ? 'is-invalid' : '' }}" name="licence_validity" value="{{ old('licence_validity',0) }}" required>
                     @if ($errors->has('licence_validity'))
                         <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('licence_validity') }}</strong>
                     </span>
                     @endif
                   </div>
                 </div>
                 <div class="form-group row">
                  <label for="licence_user_limit" class="col-sm-2 col-form-label">User Limit</span></label>
                   <div class="col-sm-10">
                     <input type="number" min="2" class="form-control {{ $errors->has('licence_user_limit') ? 'is-invalid' : '' }}" name="licence_user_limit" value="{{ old('licence_user_limit',2) }}" required>
                     @if ($errors->has('licence_user_limit'))
                         <span class="invalid-feedback" role="alert">
                         <strong>{{ $errors->first('licence_user_limit') }}</strong>
                     </span>
                     @endif
                   </div>
                 </div>
               <div class="form-group row">
                 <label for="licence_status" class="col-sm-2 col-form-label">Status</label>
                 <div class="col-sm-10">
                    <input type="checkbox" id="toggle-two" name="licence_status" @if(old('licence_status')) checked @endif data-onstyle="success" data-offstyle="danger">
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
<script src="{{asset('theme/assets/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
<script>
  $('#licence_description').summernote({
          height: 300,
          tabsize: 2
      });
</script>
<script>
    $(function() {
      $('#toggle-two').bootstrapToggle({
        on: 'Enabled',
        off: 'Disabled'
      });
      $('#role_id').select2();
      $( "input[type='number']" ).change(function() {
        var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));
        if ($(this).val() > max)
        {
            $(this).val(max);
        }
        else if ($(this).val() < min)
        {
            $(this).val(min);
        }       
      });
    });
    $("input[type=number]").focus(function() {
      if($(this).attr('readonly')) return false;
      $(this).select();
   });
   function amount_settings(){
    var licence_amount=$("input[name=licence_amount]").val() ? $("input[name=licence_amount]").val():0;
    var licence_discount=$("input[name=licence_discount]").val() ? $("input[name=licence_discount]").val():0;
    var licence_total=$("input[name=licence_total]").val() ? $("input[name=licence_total]").val():0;
    var licence_tax=$("input[name=licence_tax]").val() ? $("input[name=licence_tax]").val():0;
    var licence_taxableamount=$("input[name=licence_taxableamount]").val() ? $("input[name=licence_taxableamount]").val():0;
    var licence_net_amount=$("input[name=licence_net_amount]").val() ? $("input[name=licence_net_amount]").val():0;

    licence_total = licence_amount-(licence_amount*(licence_discount/100));
    $("input[name=licence_total]").val(licence_total);

    licence_taxableamount = licence_total+(licence_total*(licence_tax/100));
    $("input[name=licence_taxableamount]").val(licence_taxableamount);
    $("input[name=licence_net_amount]").val(licence_taxableamount);
   }
  </script>
@endsection