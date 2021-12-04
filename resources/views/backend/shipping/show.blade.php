@extends('backend.layouts.master')
@section('title', 'Shippings')
@section('breadcrumb', 'Shippings')
@section('sub_breadcrumb', 'Shippings Table')
@section('main-content')
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <h5 class="mt-5">shipping Data Table</h5>
                <div class="table-responsive mb-4 mt-4">
                    <table class="multi-table table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shipping as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->type }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td class="text-center">
                                        @if ($data->status == 'active')
                                            <span class="badge badge-success">{{ $data->status }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $data->status }}</span>
                                        @endif
                                    </td>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-primary" href="{{ route('shipping.edit', $data->id) }}">Edit</a>
                                        <a>
                                            <form class="mt-2" method="POST"
                                                action="{{ route('shipping.destroy', [$data->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-primary dltBtn" data-id={{ $data->id }}
                                                    data-toggle="tooltip" data-placement="bottom"
                                                    title="Delete">Delete</button>
                                            </form>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S.N.</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("Your data is safe!");
                        }
                    });
            })
        })
    </script>
@endpush
