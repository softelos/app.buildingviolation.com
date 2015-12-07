<!DOCTYPE html>
<html lang="en">

   @include('layouts/_header')

   <body class="page-sub-page page-legal" id="page-top" data-offset="90">
       @include('layouts/_head')
        
       <div class="wrapper">
            <div id="content" class="container">
                <div class="row">
                    <div class="col-md-12 text-center page-error">
                        @yield('content')
                    </div>
                </div>
            </div>
            @include('layouts/_footer')
        </div>
                
    </body>

</html>
