@extends('backend.layouts.master')
@section('title','Edit Product')
@section('breadcrumb','Products')
@section('sub_breadcrumb','Edit Product')
@section('main-content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
        <div class="card">
            <h5 class="mt-5 mx-5">Add Product</h5>
            <div class="card-body">
                <form method="post" action="{{route('product.update',$productEdit->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{$productEdit->title}}"
                            class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="summary" value="" name="summary" >{{$productEdit->summary}}</textarea>
                        @error('summary')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{$productEdit->description}}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="is_featured">Is Featured</label><br>
                        <input type="checkbox" name='is_featured' id='is_featured' value='1' value='{{$productEdit->is_featured}}' {{(($productEdit->is_featured) ? 'checked' : '')}}> Yes
                    </div>
                    {{-- {{$categories}} --}}

                    <div class="form-group">
                        <label for="cat_id">Category <span class="text-danger">*</span></label>
                        <select name="cat_id" id="cat_id" value="{{$productEdit->cat_id}}" class="form-control">
                            <option value="">--Select any category--</option>
                            @foreach ($category as $categorys)
                                <option value='{{ $categorys->id }}'{{(($productEdit->cat_id==$categorys->id)? 'selected' : '')}}>{{ $categorys->title }}</option>
                                
                            @endforeach
                        </select>
                    </div>
                    @php 
                        $sub_cat_info=DB::table('categories')->select('title')->where('id',$productEdit->child_cat_id)->get();
                        // dd($sub_cat_info);
                    @endphp

                    <div class="form-group {{(($productEdit->child_cat_id)? '' : 'd-none')}}"  id="child_cat_div">
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
                        <input id="price" type="number" name="price" placeholder="Enter price" value="{{$productEdit->price}}" class="form-control">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="discount" class="col-form-label">Discount(%)</label>
                        <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount"
                            value="{{$productEdit->discount}}" class="form-control">
                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="size">Size</label>
                        <select name="size[]" class="form-control">
                            <option value="">--Select any size--</option>
                            @foreach($productEdit as $item)              
                                @php 
                                $data=explode(',',$item->size);
                                // dd($data);
                                @endphp
                                    <option value="S"  @if( in_array( "S",$data ) ) selected @endif>Small</option>
                                    <option value="M"  @if( in_array( "M",$data ) ) selected @endif>Medium</option>
                                    <option value="L"  @if( in_array( "L",$data ) ) selected @endif>Large</option>
                                    <option value="XL"  @if( in_array( "XL",$data ) ) selected @endif>Extra Large</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label for="brand_id">Brand</label>
                        {{-- {{$brands}} --}}

                        <select name="brand_id" class="form-control">
                            <option value="">--Select Brand--</option>
                            @foreach ($brand as $brands)
                                <option value="{{ $brands->id }}"{{(($productEdit->brand_id==$brands->id)? 'selected':'')}}>{{ $brands->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="condition">Condition</label>
                        <select name="condition" class="form-control">
                            <option value="">--Select Condition--</option>
                            <option value="default" {{(($productEdit->condition=='default')? 'selected':'')}}>Default</option>
                            <option value="new" {{(($productEdit->condition=='new')? 'selected':'')}}>New</option>
                            <option value="hot" {{(($productEdit->condition=='hot')? 'selected':'')}}>Hot</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stock">Quantity <span class="text-danger">*</span></label>
                        <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity" value="{{$productEdit->stock}}" 
                            class="form-control">
                        @error('stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="hidden" name="old_photo" value="{{$productEdit->photo}}">
                            <input id="thumbnail" class="form-control" type="file" name="photo" value="{{$productEdit->photo}}">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option value="active" {{(($productEdit->status=='active')? 'selected' : '')}}>Active</option>
                            <option value="inactive" {{(($productEdit->status=='inactive')? 'selected' : '')}}>Inactive</option>
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
