@extends('backend.layouts.master')
@section('title','Products')
@section('breadcrumb','Products')
@section('sub_breadcrumb','Products Table')
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
                                <th>Title</th>
                                <th>Category</th>
                                <th>Brand Name</th>
                                {{-- <th>Is Featured</th> --}}
                                <th>Price</th>
                                <th>Discount(%)</th>
                                <th>Size</th>
                                <th>Condition</th>
                                <th>Stock</th>
                                {{-- <th>Photo</th> --}}
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product ->title }}</td>
                                {{-- <td>{{ $product->category->title }}</td>
                                <td>{{ $product->brand->title}}</td> --}}
                                {{-- <td>{{ $product ->category ->title}}</td>
                                <td>{{ $product ->brand ->title}}</td> --}}
                                {{-- <td>{{ $product->is_featured}}</td> --}}
                                <td>{{ $product->price}}</td>
                                <td>{{ $product->discount}} %</td>
                                <td>{{ $product->size }}</td>
                                <td>{{ $product->condition}}</td>

                                <td>{{ $product->stock}}</td>
                                {{-- <td>
                                    <img src="{{ asset('product_photo') }}/{{ $product->photo }}" class="img-fluid zoom"
                                    style="max-width:80px" alt="{{ $product->photo }}">
                                </td> --}}
                                <td class="text-center">
                                    @if ($product->status == 'active')
                                        <span class="badge badge-success">{{ $product->status }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ $product->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary" href="{{ route('product.edit', $product->id) }}">Edit</a>
                                    <a>
                                        <form class="mt-2"method="POST" action="{{ route('product.destroy', [$product->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-primary dltBtn" data-id={{ $product->id }}
                                                 data-toggle="tooltip"
                                                data-placement="bottom" title="Delete">Delete</button>
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
                                <th>Category</th>
                                <th>Is Featured</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Size</th>
                                <th>Condition</th>
                                <th>Stock</th>
                                <th>Photo</th>
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
    $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        $('.dltBtn').click(function(e){
          var form=$(this).closest('form');
            var dataID=$(this).data('id');
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
<script>
    $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        $('.dltBtn').click(function(e){
          var form=$(this).closest('form');
            var dataID=$(this).data('id');
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
{{-- <tr>
    <th>S.N.</th>
    <th>Order No.</th>
    <th>Name</th>
    <th>Email</th>
    <th>Product Name</th>
    <th>Quantity</th>
    <th>Total Amount</th>
    <th>Status</th>
    <th>Action</th>
    </tr> --}}


