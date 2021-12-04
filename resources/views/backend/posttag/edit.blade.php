@extends('backend.layouts.master')
@section('title','Add PostTag')
@section('main-content')
<div class="row layout-top-spacing">
  <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
    <div class="card">
        <h5 class="mt-5 mx-3">Edit Post Tag</h5>
        <div class="card-body">
          <form method="post" action="{{route('posttag.update',$tagEdit->id)}}">
            @csrf 
            @method('PATCH')
            <div class="form-group">
              <label for="inputTitle" class="col-form-label">Title</label>
              <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$tagEdit->title}}" class="form-control">
              @error('title')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="status" class="col-form-label">Status</label>
              <select name="status" class="form-control">
                <option value="active" {{(($tagEdit->status=='active') ? 'selected' : '')}}>Active</option>
                <option value="inactive" {{(($tagEdit->status=='inactive') ? 'selected' : '')}}>Inactive</option>
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