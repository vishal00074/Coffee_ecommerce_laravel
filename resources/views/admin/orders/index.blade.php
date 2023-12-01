@extends('admin.app')

@section('content')



<div class="content">

    <div class="card">

        <div class ="card-header header-elements-inline s-filter">

            <div class="col-md-6">

                <h6 class="card-title"><b>Orders</b></h6></div>

                <div class="col-md-6 text-right">

                <!--<a href="{{ url('admin/products/create') }}" class="btn btn-primary" > <i class="icon-circle-left2 mr-1"></i> Add</a>-->

                <a href="{{ url('/admin') }}" class="btn-success"> <i class="icon-circle-left2 mr-1"></i> Back</a>

            </div> 

        </div>

               

        <table class="table get_order_list">

            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Name</th>
                    <th>Email</th>
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
        
        var dataTable = $('.get_order_list').DataTable({

            processing: true,

            serverSide: true,

            autoWidth: false,

            //pageLength: 5,

            scrollX: true,

            "order": [[ 0, "desc" ]],

            ajax: "{{ url('/admin/orders') }}",

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

                {data: 'order_id', name: 'order_id'},
                
                {data: 'shipping_name', name: 'shipping_name'},
                
                {data: 'shipping_email', name: 'shipping_email'},
                  
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

                confirmButtonText: 'Yes, cancel it!',

                cancelButtonText: 'No, do not cancel!',

                confirmButtonClass: 'btn btn-success',

                cancelButtonClass: 'btn btn-danger',

                buttonsStyling: false

            }).then(function(result) {

                if(result.value) {

                    $.ajax({

                        type:'DELETE',

                        url : "{{ url('/admin/products') }}"+'/'+id,

                        success: function (response) {

                            swalInit.fire(

                                'Deleted!',

                                'Your file has been deleted.',

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

                        'Your imaginary file is safe.',

                        'error'

                    )

                }

            });

        });

    });

</script>

@endsection