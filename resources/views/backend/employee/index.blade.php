@extends('backend.layouts.master')
@section('title', 'Products')
@section('breadcrumb', 'Products')
@section('sub_breadcrumb', 'Products Table')
@section('main-content')
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-6">

                <h5 class="mt-5">Products Data Table</h5>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#empModal">
                    Add Employee
                </button>
                <div class="table-responsive mb-4 mt-4">
                    <table class="multi-table table table-hover" style="width:100%">
                        <thead>
                            <tr>

                                <th>id </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($employee as $data)

                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $data->name }}</th>
                                <th>{{ $data->email}} </th>
                                <th>Address</th>
                                <td class="text-center">
                                    <a class="btn btn-primary" href="#">View</a>
                                    <button type="button" class="btn btn-primary" id="edit" value="{{ $data->id }}">
                                        Edit Employee
                                </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>id </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="" method="post" action="{{route('employees.update')}}">
                    @method('put')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        </div>

                        <div class="modal-body">
                            <div class="modal-body">
                                <input type="hidden" id="editStaus" name="editStaus" value="{{$data->id}}" />
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{$data->name}}" placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{$data->email}}" placeholder="Enter email">
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                Discard</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- add mpdal --}}
    <div class="modal fade" id="empModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="ajaxform">
                <div class="modal-body">
                    @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="addEmp" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end module --}}
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '#edit', function() {
                    var editStaus = $(this).val();
                    $('#editModal').modal('show');
                    var id = $(this).val();
                    var url = '{{ route("employees.edit", ":id") }}';
                    url = url.replace(':id', id);
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(response) {
                            console.log(response);
                            $('#name').val(response.employee.name);
                            $('#email').val(response.employee.email);
                            $('#editStaus').val(editStaus);
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#addEmp").on('click', function(e) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('employees.store') }}",
                        data: $('#ajaxform').serialize(),
                        success: function(response) {
                            $('#empModal').modal('hide')
                        },

                    })
                });
            });
        </script>
    @endpush
@endsection
