@extends('backend.layouts.master')
@section('title','Add Banner')
@section('breadcrumb','Banners')
@section('sub_breadcrumb','Add Banner')
@section('main-content')
<div class="row layout-top-spacing">
<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
    <form id="work-platforms" class="section work-platforms" method="POST" action="{{route('banner.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="info">
            <h5 class="mt-5">Add Banner Table</h5>
            <div class="row">
                <div class="col-md-11 mx-auto">

                    <div class="platform-div">
                        <div class="form-group">
                            <label for="platform-title">Name</label>
                            <input type="text" name="title" class="form-control mb-4" id="platform-title" placeholder="Platforms Title" value="" >
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="platform-description">Photo</label>
                            <input class="form-control mb-4" type="file" name="photo" value="">
                            @error('photo')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="platform-description">Description</label>
                            <input class="form-control mb-4" type="text" name="description" value="">
                            @error('description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>

                        <div class="form-group">
                            <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <button type="submit" class="btn btn-primary top-center" style="float: right; width:120px;" value="">submit</button>
                    </div>

                </div>

            </div>
        </div>
    </form>
</div>
</div>
@endsection
@push('scripts')
<script>
$('.top-center').click(function() {
    Snackbar.show({
        text: 'Banner add successfully.',
        pos: 'top-center'
    });
});
</script>

@endpush
