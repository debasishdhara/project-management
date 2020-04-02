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
    <li class="breadcrumb-item"><a href="javaScript:void();">Licence</a></li>
    <li class="breadcrumb-item active" aria-current="page">All Licence</li>
  </ol>
</div>
<!--Start Licence Index Content-->

<div class="row col">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header"><span class="card-title"><i class="fa fa-table"></i> All Licence Details</span> <div class="pull-right"><a class="btn btn-primary" href="{{route('add-users')}}">Add Licence</a></div></div>
      <div class="card-body">
        <div class="table-responsive">
        <table id="default-datatable" class="table table-bordered display responsive nowrap" width="100%">
          <thead>
              <tr>
                  <th class="col">Permission Name</th>
                  <th class="col">Status</th>
                  <th class="col">Role Name</th>
                  <th class="col">Action</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                <th>Permission Name</th>
                <th>Status</th>
                <th>Role Name</th>
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
                              return 'Details for '+data['permission_name'];
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
                  url: "{{ route('fetch-permission') }}",
                  dataType: "json",
                  type: "POST",
                  data:{ _token: "{{csrf_token()}}"}
                },
                columns: [
                    { data: 'permission_name'},
                    { data: 'permission_status',orderable: false, searchable: false},
                    { data: 'role',orderable: false, searchable: false},
                    { data: 'action',hidden:true,orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection