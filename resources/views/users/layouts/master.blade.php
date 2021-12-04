<!DOCTYPE html>
<html lang="en">
@include('users.layouts.head')
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      @include('users.layouts.header')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('users.layouts.sidebar')
        <!-- partial -->
        <div class="main-panel">
          @yield('main-content')
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          @include('users.layouts.footer')
