@extends('backend.layouts.master')
@section('title','Add Product')
@section('breadcrumb','Products')
@section('sub_breadcrumb','Add Product')
@section('main-content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
        <div class="card">
            <h5 class="mt-5 mx-3">Add Product</h5>
            <div class="card-body">
                <form method="post" action="{{ route('product.store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="title" placeholder="Enter title" value=""
                            class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="summary" name="summary"></textarea>
                        @error('summary')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="is_featured">Is Featured</label><br>
                        <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes
                    </div>
                    {{-- {{$categories}} --}}

                    <div class="form-group">
                        <label for="cat_id">Category <span class="text-danger">*</span></label>
                        <select name="cat_id" id="cat_id" class="form-control">
                            <option value="">--Select any category--</option>
                            @foreach ($category as $categorys)
                                <option value='{{ $categorys->id }}'>{{ $categorys->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group d-none" id="child_cat_div">
                        <label for="child_cat_id">Sub Category</label>
                        <select name="child_cat_id" id="child_cat_id" class="form-control">
                            <option value="">--Select any category--</option>
                            {{-- @foreach ($parent_cats as $key => $parent_cat)
                    <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
                @endforeach --}}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
                        <input id="price" type="number" name="price" placeholder="Enter price" value="" class="form-control">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="discount" class="col-form-label">Discount(%)</label>
                        <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"
                            value="" class="form-control">
                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="size">Size</label>
                        <select name="size[]" class="form-control">
                            <option value="">--Select any size--</option>
                            <option value="S">Small (S)</option>
                            <option value="M">Medium (M)</option>
                            <option value="L">Large (L)</option>
                            <option value="XL">Extra Large (XL)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="brand_id">Brand</label>
                        {{-- {{$brands}} --}}

                        <select name="brand_id" class="form-control">
                            <option value="">--Select Brand--</option>
                            @foreach ($brand as $brands)
                                <option value="{{ $brands->id }}">{{ $brands->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="condition">Condition</label>
                        <select name="condition" class="form-control">
                            <option value="">--Select Condition--</option>
                            <option value="default">Default</option>
                            <option value="new">New</option>
                            <option value="hot">Hot</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stock">Quantity <span class="text-danger">*</span></label>
                        <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity" value=""
                            class="form-control">
                        @error('stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input id="thumbnail" class="form-control" type="file" name="photo" value="">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection


@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        // $('select').selectpicker();
    </script>

    <script>
        $('#cat_id').change(function() {
            var cat_id = $(this).val();
            if (cat_id != null) {
                // Ajax call
                $.ajax({
                    url: "/category/" + cat_id + "/child",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: cat_id
                    },
                    type: "POST",
                    success: function(response) {
                        if (typeof(response) != 'object') {
                            response = $.parseJSON(response)
                        }
                        var html_option = "<option value=''>----Select sub category----</option>"
                        if (response.status) {
                            var data = response.data;
                            if (response.data) {
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data, function(id, title) {
                                    html_option += "<option value='" + id + "'>" + title +
                                        "</option>"
                                });
                            } else {}
                        } else {
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);
                    }
                });
            } else {}
        })
    </script>
@endpush
