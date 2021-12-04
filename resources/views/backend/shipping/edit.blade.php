@extends('backend.layouts.master')
@section('title', 'Edit Shoppings')
@section('breadcrumb', 'Shoppings')
@section('sub_breadcrumb', 'Edit Shoppings')
@section('main-content')
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
            <div class="card">
                <h5 class="mt-5 mx-3">Add Shipping</h5>
                <div class="card-body">
                    <form method="post" action="{{ route('shipping.update', $shipping_edit->id) }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PATCH')
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Type <span class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="type" placeholder="Enter title"
                                value="{{ $shipping_edit->type }}" class="form-control">
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price" class="col-form-label">Price <span class="text-danger">*</span></label>
                            <input id="price" type="number" name="price" placeholder="Enter price"
                                value="{{ $shipping_edit->price }}" class="form-control">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="active" {{ $shipping_edit->status == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ $shipping_edit->status == 'inactive' ? 'selected' : '' }}>
                                    Inactive</option>
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
