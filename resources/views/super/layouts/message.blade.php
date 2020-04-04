<!-- Success Message -->
@if(Session::has('success'))
    {{--  <div class="alert alert-success">
        <div class="col">
            {{ Session::get('success') }}
        </div>
    </div>  --}}
@endif
<!-- Error Message -->
@if(Session::has('error'))
    {{--  <div class="alert alert-danger">
        <div class="col">
            {{ Session::get('error') }}
        </div>
    </div>  --}}
@endif
