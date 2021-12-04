@extends('backend.layouts.master')
@section('title','Brands')
@section('breadcrumb','Brands')
@section('sub_breadcrumb','Brands Table')
@section('main-content')
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-6">
                <h5 class="mt-5">Brand Data Table</h5>
                <div class="table-responsive mb-4 mt-4">
                    <table class="multi-table table table-hover" style="width:100%">
                        <thead>
                            
                            <tr>
                                <th>Id</th>
                                <th>Titel</th>
                                <th>Photo</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brand as $brand_item )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$brand_item->title}}</td>
                                <td><img src="{{ asset('brand_photo') }}/{{ $brand_item->photo }}" class="img-fluid zoom"
                                    style="max-width:80px" alt="{{ $brand_item->photo }}"></td>
                                <td>
                                    @if ($brand_item->status == 'active')
                                        <span class="badge badge-success">{{ $brand_item->status }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ $brand_item->status }}</span>
                                    @endif
                                </td>
                                </td>
                                <td class="text-center">
                                    <form class="mt-2"method="POST" action="{{ route('brand.destroy', [$brand_item->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-primary dltBtn" data-id={{ $brand_item->id }}
                                             data-toggle="tooltip"
                                            data-placement="bottom" title="Delete">Delete</button>
                                    </form>
                            </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Titel</th>
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
@endpush


