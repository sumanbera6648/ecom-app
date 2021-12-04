@extends('backend.layouts.master')
@section('title','Post Category')

@section('main-content')
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-6">
                <h5 class="mt-5">Sub-Category Data Table</h5>
                <div class="table-responsive mb-4 mt-4">
                    <table class="multi-table table table-hover" style="width:100%">
                        <thead>

                            <tr>
                                <th>Id</th>
                                <th>Titel</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($p_category as $category)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$category->title}}</td>

                                <td class="text-center">
                                    @if ($category->status == 'active')
                                        <span class="badge badge-success">{{ $category->status }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ $category->status }}</span>
                                    @endif
                                </td>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary"
                                    @php $prodID= Crypt::encrypt($category->id); @endphp
                                            href="{{ route('postcategory.edit', $prodID) }}">Edit</a>
                                    <form class="mt-2"method="POST" action="{{ route('postcategory.destroy', [$category->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-primary dltBtn" data-id={{ $category->id }}
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


