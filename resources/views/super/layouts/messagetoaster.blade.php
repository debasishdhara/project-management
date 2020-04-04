<!-- Success Message -->
@if(Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
@endif
<!-- Error Message -->
@if(Session::has('error'))
    toastr.error('{{ Session::get('success') }}');
@endif
