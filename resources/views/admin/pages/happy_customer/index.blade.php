@extends('admin.app')

@section('content')

<div class="content">
    <div class="card">
        <div class ="card-header header-elements-inline s-filter">
            <div class="col-md-6">
                <h6 class="card-title"><b>Happy Customer  List</b></h6></div>
                <!-- <a href="">
                   <button type="button" class="btn btn-primary btn-sm" ><i class="icon-plus-circle2 mr-2"></i> Add</button>
                </a> -->
                <div class="col-md-6 text-right">
                <a href="{{ url('/admin/add_customer') }}" class="btn btn-primary" > <i class="fas fa-plus mr-1"></i> Add</a>
              <a href="{{ url('/admin') }}" class="btn-success"> <i class="icon-circle-left2 mr-1"></i> Back</a>
				
            </div> 
        </div>
               
        <table class="table get_cetegory_list">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>ACTION</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@section('script')
<script src="{{asset('public/assets/admin/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // init datatable.
        var url = window.location.origin;
        var dataTable = $('.get_cetegory_list').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            //pageLength: 5,
            scrollX: true,
            "order": [[ 0, "desc" ]],
            ajax: "{{ url('/admin/happy_customer') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'name', name: 'name'},
                {data: 'image', name: 'image',
                    render: function( data, type, full, meta ) {
                        return "<img src="+ url +"/"+ data + " height=\"60\"  width=\"80\" alt='No Image'/>";
                    }
                },
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false}
            ]
        });
        
        $('body').on('click', '.delete-queries', function () {
            var id = $(this).attr('data-id');
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, do not delete!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function(result) {
                if(result.value) {
                    $.ajax({
                        type:'DELETE',
                        url : "{{ url('/admin/delete_customer') }}"+'/'+id,
                        success: function (response) {
                            swalInit.fire(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            )
                            .then((willDelete) => {
                                location.reload();
                            });
                        },
                        error: function (response) {
                            swalInit.fire(
                                'Error deleting!',
                                'Please try again!',
                                'error'
                            )
                        }
                    });
                }
                else if (result.dismiss === swal.DismissReason.cancel) {
                    swalInit.fire(
                        'Cancelled',
                        'Your record is safe.',
                        'error'
                    )
                }
            });
        });
    });
</script>
@endsection