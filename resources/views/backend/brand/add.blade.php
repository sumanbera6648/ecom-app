@extends('backend.layouts.master')
@section('title','Add Brand')
@section('breadcrumb','Brands')
@section('sub_breadcrumb','Add Brand')
@section('main-content')
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
            <form id="work-platforms" class="section work-platforms" method="POST" action="{{route('brand.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="info">
                    <h5 class="mt-5">Add Brand Table</h5>
                    <div class="row">
                        <div class="col-md-11 mx-auto">

                            <div class="platform-div">
                                <div class="form-group">
                                    <label for="platform-title">Title</label>
                                    <input type="text" name="title" class="form-control mb-4" id="platform-title"
                                        placeholder="Platforms Title" value="">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="platform-description">Photo</label>
                                    <input class="form-control mb-4" type="file" name="photo" value="">
                                    @error('photo')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary" style="float: right; width:120px;"
                                    value="">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

