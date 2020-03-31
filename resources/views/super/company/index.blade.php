@extends('super.layouts.app')
@section('style')
<link href="{{ asset('theme/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
<link href="{{ asset('theme/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
  <div class="col-sm-9">
  <h4 class="page-title">Company</h4>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="javaScript:void();">Company</a></li>
      <li class="breadcrumb-item active" aria-current="page">ALL Companies</li>
   </ol>
</div>
<!--Start Company Index Content-->

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header"><i class="fa fa-table"></i>All Companies Details <div class="pull-right"><a class="btn btn-primary" href="javascript:void(0);">Add Company</a></div></div>
      <div class="card-body">
        <div class="table-responsive">
        <table id="default-datatable" class="table table-bordered display responsive nowrap" width="100%">
          <thead>
              <tr>
                  <th>Company Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Registration Number</th>
                  <th>Licence Valid Upto</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
              </tr>
          </tbody>
          <tfoot>
              <tr>
                <th>Company Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Registration Number</th>
                <th>Licence Valid Upto</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
          </tfoot>
      </table>
      </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row-->

<!-- Bootstrap core JavaScript-->

<!--End Company Index Content-->
@endsection
@section('script')
{{--    --}}
{{--  <script src="{{asset('theme/assets/js/bootstrap.min.js')}}"></script>  --}}
<script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('theme/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#default-datatable').DataTable({
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 Rows', '25 Rows', '50 Rows', 'Show All']
                ],
                ordering: true,
                responsive: true
            });
        });
    </script>
@endsection