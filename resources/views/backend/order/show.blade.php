@extends('backend.layouts.master')
@section('title', 'Products')
@section('breadcrumb', 'Products')
@section('sub_breadcrumb', 'Products Table')
@section('main-content')
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-6">
                <h5 class="mt-5">Products Data Table</h5>
                <div class="table-responsive mb-4 mt-4">
                    <table class="multi-table table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Order No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                {{-- <th>Phone</th>
                                <th>Post Code</th> --}}
                                <th>Address</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $data)
                                <tr>
                                    <th>{{ $data->id }}</th>
                                    <th>{{ $data->order_number }}</th>
                                    <th>{{ $data->user->name }}</th>
                                    <th>{{ $data->user->email }}</th>
                                    {{-- <th>{{$data->user->phone}}</th>
                                <th>{{$data->user->post_code}}</th> --}}
                                    <th>{{ $data->user->address }}</th>
                                    <th>{{ $data->product_id }}</th>
                                    {{-- <th>{{ $data->product->title }}</th> --}}
                                    <th>{{ $data->quantity }}</th>
                                    <th>{{ $data->total_amount }}</th>
                                    <th>{{ $data->status }}</th>
                                    <td class="text-center">
                                        <a class="btn btn-primary" href="{{ route('invoice_view', [$data->id]) }}">View</a>

                                            <button type="button" class="btn btn-primary edit" id="" value="{{ $data->id }}">
                                                Edit Status
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S.N.</th>
                                <th>Order No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Total Amount</th>
                                <th>Status</th>
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
                <form class="" method="post" action="{{route('modal_update')}}">
                    @method('put')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        </div>
                        <input type="hidden" id="editStaus" name="editStaus" value="{{$data->id}}" />
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <select class="custom-select" id="status" name="status">
                                    <option value="new" {{(($data->status=='new') ? 'selected' : '')}}>New</option>
                                    <option value="process" {{(($data->status=='process') ? 'selected' : '')}}>Process</option>
                                    <option value="delivered" {{(($data->status=='delivered') ? 'selected' : '')}}>Delivered</option>
                                    <option value="cancel" {{(($data->status=='cancel') ? 'selected' : '')}}>Cancel</option>
                                </select>
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
    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
           $(document).on('click','.edit',function(){
               var editStaus = $(this).val();
                $('#editModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/admin/edit-status/"+editStaus,
                    success: function(response){
                        console.log(response.order);
                        $('#status').val(response.order.status);
                        $('#editStaus').val(editStaus);
                    }
                });
           });
        });
    </script>
    <script>
    </script>
@endpush
@endsection

