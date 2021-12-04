@extends('backend.layouts.master')

@section('main-content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
 <!-- DataTales Example -->
        <div class="card shadow mb-4">
            
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Coupon List</h6>
            <a href="{{route('coupon.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Coupon</a>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                {{-- @if(count($coupons)>0) --}}
                <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>S.N.</th>
                    <th>Coupon Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S.N.</th>
                        <th>Coupon Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th >Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($coupons as $coupon)   
                        <tr>
                            <td>{{$coupon->id}}</td>
                            <td>{{$coupon->code}}</td>
                            <td>
                                @if($coupon->type=='fixed')
                                    <span class="badge badge-primary">{{$coupon->type}}</span>
                                @else
                                    <span class="badge badge-warning">{{$coupon->type}}</span>
                                @endif
                            </td>
                            <td>
                                @if($coupon->type=='fixed')
                                    ${{number_format($coupon->value,2)}}
                                @else
                                    {{$coupon->value}}%
                                @endif</td>
                            <td>
                                @if($coupon->status=='active')
                                    <span class="badge badge-success">{{$coupon->status}}</span>
                                @else
                                    <span class="badge badge-warning">{{$coupon->status}}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="btn btn-primary"
                                    href="{{ route('coupon.edit', $coupon->id) }}">Edit</a>
                                <a>
                                    <form class="mt-2" method="POST"
                                        action="{{ route('coupon.destroy', [$coupon->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-primary dltBtn" data-id={{ $coupon->id }}
                                            data-toggle="tooltip" data-placement="bottom"
                                            title="Delete">Delete</button>
                                    </form>
                                </a>
                            </td>
                        </tr>  
                    @endforeach
                </tbody>
                </table>
                {{-- @else
                <h6 class="text-center">No Coupon found!!! Please create coupon</h6>
                @endif --}}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection



@push('scripts')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script>
      
      $('#banner-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[4,5]
                }
            ]
        } );
        // Sweet alert
        function deleteData(id){
            
        }
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