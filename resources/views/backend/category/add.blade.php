@extends('backend.layouts.master')
@section('title','Add Category')
@section('breadcrumb','Categorys')
@section('sub_breadcrumb','Add Category')
@section('main-content')
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
            <form id="work-platforms" class="section work-platforms" method="POST" action="{{route('category.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="info">
                    <h5 class="mt-5">Add Category</h5>
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
                                    <label for="summary" class="col-form-label">Summary</label>
                                    <textarea class="form-control" id="summary" name="summary"></textarea>
                                    @error('summary')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="is_parent">Is Parent</label><br>
                                    <input type="checkbox" name='is_parent' id='is_parent' value='1' checked> Yes                        
                                  </div>
                                  <div class="form-group d-none" id='parent_cat_div'>
                                    <label for="parent_id">Parent Category</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="">--Select any category--</option>
                                        @foreach($parent_cats as $parent)
                                            <option value='{{$parent->id}}'>{{$parent->title}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="platform-description">Photo</label>
                                    <input class="form-control mb-4" type="file" name="photo" value="">
                                    @error('photo')
                                    <span class="text-danger">{{$message}}</span>
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
@push('scripts')
{{-- <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script> --}}
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    // $('#lfm').filemanager('image');
    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Write short description.....",
          tabsize: 2,
          height: 120
      });
    });
</script>
<script>
    $('#is_parent').change(function(){
      var is_checked=$('#is_parent').prop('checked');
      // alert(is_checked);
      if(is_checked){
        $('#parent_cat_div').addClass('d-none');
        $('#parent_cat_div').val('');
      }
      else{
        $('#parent_cat_div').removeClass('d-none');
      }
    })
  </script>
  @endpush
