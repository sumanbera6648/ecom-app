@extends('backend.layouts.master')

@section('main-content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
        <div class="card">
            <h5 class="card-header">Edit Coupon</h5>
            <div class="card-body">
            <form method="post" action="{{route('coupon.update',$coupon_edit->id)}}">
                @csrf 
                @method('PATCH')
                <div class="form-group">
                <label for="inputTitle" class="col-form-label">Coupon Code <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="code" placeholder="Enter Coupon Code"  value="{{$coupon_edit->code}}" class="form-control">
                @error('code')
                <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
        
                <div class="form-group">
                    <label for="type" class="col-form-label">Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-control">
                        <option value="fixed" {{(($coupon_edit->type=='fixed') ? 'selected' : '')}}>Fixed</option>
                        <option value="percent" {{(($coupon_edit->type=='percent') ? 'selected' : '')}}>Percent</option>
                    </select>
                    @error('type')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Value <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="number" name="value" placeholder="Enter coupon_edit value"  value="{{$coupon_edit->value}}" class="form-control">
                    @error('value')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="active" {{(($coupon_edit->status=='active') ? 'selected' : '')}}>Active</option>
                    <option value="inactive" {{(($coupon_edit->status=='inactive') ? 'selected' : '')}}>Inactive</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group mb-3">
                <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection
