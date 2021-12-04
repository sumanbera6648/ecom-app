<!DOCTYPE html>
<html lang="en">
<head>
   @include('backend.layouts.head') 
</head>
<body>
    <!-- BEGIN LOADER -->
    
    <div id="load_screen"> 
        <div class="loader"> 
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

@include('backend.layouts.header')

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('backend.layouts.sidebar')
        <!--  END SIDEBAR  -->
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                @yield('main-content')
            
            </div>
            
     @include('backend.layouts.footer')      
    </body>
    </html>