@extends('backend.layouts.master')
@section('title', 'Add Shoppings')
@section('breadcrumb', 'Shoppings')
@section('sub_breadcrumb', 'Add Shoppings')
@section('main-content')
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
            <div class="card">
                <h5 class="mt-5 mx-3">Add Shipping</h5>
                <div class="card-body">
                    <form method="post" action="{{ route('shipping.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Type <span class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="type" placeholder="Enter title"
                                value="{{ old('type') }}" class="form-control">
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price" class="col-form-label">Price <span class="text-danger">*</span></label>
                            <input id="price" type="number" name="price" placeholder="Enter price"
                                value="{{ old('price') }}" class="form-control">
                            @error('price')
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
