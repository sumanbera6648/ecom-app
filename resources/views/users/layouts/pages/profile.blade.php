@extends('users.layouts.master')
@section('main-content')
<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Form elements </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Forms</a></li>
          <li class="breadcrumb-item active" aria-current="page">Form elements</li>
        </ol>
      </nav>
</div>
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Horizontal Two column</h4>
          <form class="form-sample">
            <p class="card-description"> Personal info </p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                    <input type="text" value="{{ $profile->name }}" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Phone Number</label>
                  <div class="col-sm-9">
                    <input class="form-control mb-4" type="text" name="phone" value="{{ $profile->phone }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Photo</label>
                  <div class="col-sm-9">
                    <input class="form-control mb-4" type="file" name="photo" value="{{ $profile->photo }}">
                  </div>
                </div>
              </div>
            </div>
            <p class="card-description"> Address </p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Address 1</label>
                  <div class="col-sm-9">
                    <input type="text" value="{{ $profile->address }}" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Postcode</label>
                  <div class="col-sm-9">
                    <input type="text" value="{{ $profile->post_code }}" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Country</label>
                  <div class="col-sm-9">
                    <select class="form-control">
                      <option>America</option>
                      <option>Italy</option>
                      <option>Russia</option>
                      <option>Britain</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">State</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">City</label>
                    <div class="col-sm-9">
                      <input type="text" value="{{$profile->city}}" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>
            <button type="submit" class="btn btn-primary mr-auto">submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
