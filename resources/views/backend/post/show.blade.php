@extends('backend.layouts.master')
@section('title','Posts')
@section('breadcrumb','Posts')
@section('sub_breadcrumb','Posts Tables')
@section('main-content')
<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

        <div class="widget-content widget-content-area br-6">
            <h5 class="mt-5">Brand Data Table</h5>
            <div class="table-responsive mb-4 mt-4">
                <table class="multi-table table table-hover" style="width:100%">
                {{-- @if(count($posts)>0) --}}
                    <thead>
                        <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Tag</th>
                        <th>Author</th>
                        <th>Photo</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Tag</th>
                        <th>Author</th>
                        <th>Photo</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                <tbody>
                
                    @foreach($posts as $post)   
                    @php 
                    $author_info=DB::table('users')->select('name')->where('id',$post->added_by)->get();
                    // dd($sub_cat_info);
                    // dd($author_info);
                    @endphp
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->post_cat_id}}</td>
                            <td>{{$post->tags}}</td>
                            <td>
                                @foreach($author_info as $data)
                                    {{$data->name}}
                                @endforeach
                            </td>
                            <td>
                                @if($post->photo)
                                    <img src="{{ asset('post_photo') }}/{{ $post->photo }}" class="img-fluid zoom" style="max-width:80px"
                                    alt="{{ $post->photo }}">                                
                                @else
                                    <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                                @endif
                            </td>                   
                            <td class="text-center">
                                @if($post->status=='active')
                                    <span class="badge badge-success">{{$post->status}}</span>
                                @else
                                    <span class="badge badge-warning">{{$post->status}}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="btn btn-primary"href="{{ route('post.edit', $post->id) }}">Edit</a>
                                <a>
                                    <form class="mt-2" method="POST" action="{{ route('post.destroy', [$post->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-primary dltBtn" data-id={{ $post->id }}
                                            data-toggle="tooltip" data-placement="bottom"title="Delete">Delete</button>
                                    </form>
                                </a>
                            </td>
                        </tr>  
                    @endforeach
                </tbody>
                </table>
            </div>
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