@extends('backend.layouts.master')
@section('title','Categories')
@section('breadcrumb','Categorys')
@section('sub_breadcrumb','Categories Table')
@section('main-content')
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

            <div class="widget-content widget-content-area br-6">
                <h5 class="mt-5">Categories Data Table</h5>
                <div class="table-responsive mb-4 mt-4">
                    <table class="multi-table table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>TitleS</th>
                                <th>Summary</th>
                                <th>Is Parent</th>
                                <th>Parent Name</th>
                                <th>Photo</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $category_item)
                                @php
                                    $parent_cats = DB::table('categories')
                                        ->select('title')
                                        ->where('id', $category_item->parent_id)
                                        ->get();
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category_item->title }}</td>
                                    <td>{{ $category_item->summary }}</td>
                                    <td>{{ $category_item->is_parent == 1 ? 'Yes' : 'No' }}</td>
                                    <td>
                                        @foreach ($parent_cats as $parent_cat)
                                            {{ $parent_cat->title }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <img src="{{ asset('category_photo') }}/{{ $category_item->photo }}"
                                            class="img-fluid zoom" style="max-width:80px"
                                            alt="{{ $category_item->photo }}">
                                    </td>
                                    <td class="text-center">
                                        @if ($category_item->status == 'active')
                                            <span class="badge badge-success">{{ $category_item->status }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $category_item->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-primary"
                                        @php $prodID= Crypt::encrypt($category_item->id); @endphp
                                            href="{{ route('category.edit', $prodID) }}">Edit</a>
                                        <a>
                                            <form class="mt-2" method="POST"
                                                action="{{ route('category.destroy', [$category_item->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-primary dltBtn" data-id={{ $category_item->id }}
                                                    data-toggle="tooltip" data-placement="bottom"
                                                    title="Delete">Delete</button>
                                            </form>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <th>Id</th>
                            <th>Titel</th>
                            <th>Summary</th>
                            <th>Is Parent</th>
                            <th>Parent Name</th>
                            <th>Photo</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
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
