@extends('admin.app')

@section('content')
<!-- Content area -->
<div class="content">
    <div class="card">
        <div class ="card-header header-elements-inline s-filter">
            <div class="col-md-6 mb-1">
                <h6 class="card-title"><b>User Quries List</b></h6> </div>
                <div class="col-md-6 text-right">
					<a  class="btn btn-success btn-sm" href="{{ url('/admin') }}" class="text-white"> <i class="icon-circle-left2 mr-1"></i> Back</a>
	        </div>
        </div>
        
        <table class="table get_courses_data">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
 
<script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" defer="defer"></script>
<script src="assets/resource/tiny_mce.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // init datatable.
        var dataTable = $('.get_courses_data').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 7,
            scrollX: true,
            "order": [[ 0, "desc" ]],
            ajax: "{{ url('/admin/user_quries') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'subject', name: 'subject'},
                {data: 'message', name: 'message'}
            ]
        });
        
        
        
        // $('body').on('click', '.delete-blog', function () {
        //     var id = $(this).attr('data-id');
        //     swalInit.fire({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         type: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: 'Yes, cancel it!',
        //         cancelButtonText: 'No, do not cancel!',
        //         confirmButtonClass: 'btn btn-success',
        //         cancelButtonClass: 'btn btn-danger',
        //         buttonsStyling: false
        //     }).then(function(result) {
        //         if(result.value) {
        //             $.ajax({
        //                 type:'DELETE',
        //                 url : "{{ url('/admin/blogs/delete') }}"+'/'+id,
        //                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //                 success: function (response) {
        //                     swalInit.fire(
        //                         'Deleted!',
        //                         'Your file has been deleted.',
        //                         'success'
        //                     )
        //                     .then((willDelete) => {
        //                         location.reload();
        //                     });
        //                 },
        //                 error: function (response) {
        //                     swalInit.fire(
        //                         'Error deleting!',
        //                         'Please try again!',
        //                         'error'
        //                     )
        //                 }
        //             });
        //         }
        //         else if (result.dismiss === swal.DismissReason.cancel) {
        //             swalInit.fire(
        //                 'Cancelled',
        //                 'Your imaginary file is safe.',
        //                 'error'
        //             )
        //         }
        //     });
        // });
    });
</script>
@endsection
<!-- ========== table components end ========== -->