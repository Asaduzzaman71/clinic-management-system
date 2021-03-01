<section class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">

         <div class="navbar-header">
              <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                   <span class="icon icon-bar"></span>
                   <span class="icon icon-bar"></span>
                   <span class="icon icon-bar"></span>
              </button>

              <!-- lOGO TEXT HERE -->
              <a href="{{ route('home') }}" class="navbar-brand"><i class="fa fa" style="font-size:30px">S</i>mart Clinic</a>
         </div>

         <!-- MENU LINKS -->
         <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
 
                   @yield('menu')
                   
                   <li class="login-btn"><a href="{{route('login')}}">login</a></li>
                 
              </ul>
         </div>

    </div>
</section>
