<!DOCTYPE html>
<html lang="en">

   @include('layouts/_header')
   @include('layouts/_head')
    
    <body class="page-sub-page page-legal" id="page-top" data-offset="90">
    
        <div class="wrapper">
            <div id="content" class="container signup-big">
                @yield('content')

            </div>

            @include('layouts/_footer')
            
        </div>

        <script src="{{ url('/js/bootbox.min.js') }}"></script>
        <script src="https://cdn.datatables.net/s/bs/jqc-1.11.3,dt-1.10.10/datatables.min.js"></script> 
        <script src="{{ url('/js/app.js') }}"></script>
        <script src="{{ url('/js/bootstrap-maxlength.js') }}"></script>        
        <script src="{{ url('/js/bootstrap-select.min.js') }}"></script>        

        @if(Session::has('message'))
            @include('layouts._dialogs-alert')
        @endif
                          
    </body>
</html>
