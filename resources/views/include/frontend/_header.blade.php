<header>
    <div class="container">
         <div class="row">

              <div class="col-md-4 col-sm-5">
                   <p>Welcome to {{ $setting->title }}</p>
              </div>
                   
              <div class="col-md-8 col-sm-7 text-align-right">
                   <span class="phone-icon"><i class="fa fa-phone"></i> {{ $setting->contact }}</span>
                   <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> 6:00 AM - 10:00 PM (Mon-Fri)</span>
                   <span class="email-icon"><i class="fa fa-envelope-o"></i> <a href="#"> {{ $setting->email }}</a></span>
              </div>

         </div>
    </div>
</header>