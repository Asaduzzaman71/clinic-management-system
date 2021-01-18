<!DOCTYPE html>
<html lang="en">
  <head>
    @include('include._head')
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo"><a href=""><span>[</span>Smart <i>clinic</i><span>]</span></a></div>
    @include('include._leftsidebar')
    <!-- ########## END: LEFT PANEL ########## -->



    <!-- ########## START: HEAD PANEL ########## -->
    @include('include._leftsidebar') 
    <!-- ########## END: HEAD PANEL ########## -->

    @include('include._header')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
    @yield('content')
    @include('include._footer')
   </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


    @include('include._javascript')
    
  </body>
</html>
