@extends('super.layouts.app')
@section('style')
<link href="{{ asset('theme/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
<link href="{{ asset('theme/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
  <div class="col-sm-9">
  <h4 class="page-title">Licence</h4>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="javaScript:void();">Demo Admin</a></li>
    <li class="breadcrumb-item"><a href="javaScript:void();">Privilege Settings</a></li>
    <li class="breadcrumb-item active" aria-current="page">All Licence</li>
  </ol>
</div>
<!--Start Licence Index Content-->

<div class="row col">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header"><span class="card-title"><i class="fa fa-table"></i> All Licence Details</span> <div class="pull-right"><a class="btn btn-primary" href="{{route('add-licence')}}">Add Licence</a></div></div>
      <div class="card-body">
        <div class="table-responsive">
        <table id="default-datatable" class="table table-bordered display responsive nowrap" width="100%">
          <thead>
              <tr>
                  <th class="col">Licence Name</th>
                  <th class="col">Licence Key</th>
                  <th class="col">Licence Description</th>
                  <th class="col">Licence Discount</th>
                  <th class="col">Licence Total</th>
                  <th class="col">Licence Net Total</th>
                  <th class="col">Licence Validity</th>
                  <th class="col">Licence Date From</th>
                  <th class="col">Licence Date To</th>
                  <th class="col">Mac Address</th>
                  <th class="col">Licence Status</th>
                  <th class="col">Action</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                <th>Licence Name</th>
                <th>Licence Key</th>
                <th>Licence Description</th>
                <th>Licence Discount</th>
                <th>Licence Total</th>
                <th>Licence Net Total</th>
                <th>Licence Validity</th>
                <th>Licence Date From</th>
                <th>Licence Date To</th>
                <th>Mac Address</th>
                <th>Licence Status</th>
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
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
      <script type="text/javascript">
        $(function () {
            $('#default-datatable').DataTable({
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 Rows', '25 Rows', '50 Rows', 'Show All']
                ],
                ordering: true,
                responsive: {
                  details: {
                      display: $.fn.dataTable.Responsive.display.modal( {
                          header: function ( row ) {

                              var data = row.data();
                              return 'Details for '+data['licence_name'];
                          }
                      } ),
                      renderer: function ( api, rowIdx, columns ) {
                        var data = $.map( columns, function ( col, i ) {
                            return col.hidden ?
                                '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                    '<td>'+col.title+':'+'</td> '+
                                    '<td>'+col.data+'</td>'+
                                '</tr>' :
                                '';
                        } ).join('');
         
                        return data ?
                            $('<table/>').append( data ) :
                            false;
                    }//$.fn.dataTable.Responsive.renderer.tableAll()
                  }
              },
                processing: true,
                serverSide: true,
                ajax:{
                  url: "{{ route('fetch-licence') }}",
                  dataType: "json",
                  type: "POST",
                  data:{ _token: "{{csrf_token()}}"}
                },
                columns: [
                    { data: 'licence_name'},
                    { data: 'licence_key'},
                    { data: 'licence_description'},
                    { data: 'licence_discount'},
                    { data: 'licence_amount'},
                    { data: 'licence_net_amount'},
                    { data: 'licence_validity'},
                    { data: 'licence_from'},
                    { data: 'licence_to'},
                    { data: 'licence_mac'},
                    { data: 'licence_status',orderable: false, searchable: false},
                    { data: 'action',hidden:true,orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection