<!DOCTYPE html>
<html lang="en">

   @include('layouts/_header')

    <body class="page-sub-page page-legal" id="page-top" data-offset="90">
       @include('layouts/_head')
        
       <div class="wrapper">
            <div id="content" class="container">
                <div class="row">
                    <div class="col-md-3">
                        @yield('side-bar')
                    </div>
                    <div class="col-md-9">
                        @yield('content')
                    </div>
                </div>
            </div>            
            @include('layouts/_footer')
            
        </div>
                          
        <script src="{{ url('/js/bootbox.min.js') }}"></script>
        <script src="https://cdn.datatables.net/s/bs/jqc-1.11.3,dt-1.10.10/datatables.min.js"></script> 
        <script src="{{ url('/js/app.js') }}"></script>
        <script src="{{ url('/js/bootstrap-maxlength.js') }}"></script>
        <script src="{{ url('/js/bootstrap-select.min.js') }}"></script>

        @yield('extra-js')

        @if(Session::has('message'))
            @include('layouts._dialogs-alert')
        @endif

    </body>
</html>
