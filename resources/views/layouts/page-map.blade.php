<!DOCTYPE html>
<html lang="en">

   @include('layouts/_header')

   <body class="page-sub-page page-legal" id="page-top" data-offset="90">
       @include('layouts/_head')
        
       <div class="wrapper">
       
          <div class="page-map">
              @yield('content')
          </div>

          @include('layouts/_footer')

        </div>

        @yield('extra-js')               
                
    </body>

</html>
