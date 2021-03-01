@extends('layout.guest')
@section('menu')
     <li><a href="#top" class="smoothScroll">Home</a></li>
     <li><a href="#about" class="smoothScroll">About Us</a></li>
     <li><a href="#team" class="smoothScroll">Doctors</a></li>
     <li><a href="#news" class="smoothScroll">News</a></li>
     <li><a href="#google-map" class="smoothScroll">Contact</a></li>
     <li class="appointment-btn"><a href="#appointment">Make an appointment</a></li>     
@endsection
@section('content')


 <!-- HOME -->
 <section id="home" class="slider" data-stellar-background-ratio="0.5">
     <div class="container">
          <div class="row">

                    <div class="owl-carousel owl-theme">
                         <div class="item item-first">
                              <div class="caption">
                                   <div class="col-md-offset-1 col-md-10">
                                        <h3>Let's make your life happier</h3>
                                        <h1>Healthy Living</h1>
                                        <a href="#team" class="section-btn btn btn-default smoothScroll">Meet Our Doctors</a>
                                   </div>
                              </div>
                         </div>

                         <div class="item item-second">
                              <div class="caption">
                                   <div class="col-md-offset-1 col-md-10">
                                        <h3>Aenean luctus lobortis tellus</h3>
                                        <h1>New Lifestyle</h1>
                                        <a href="#about" class="section-btn btn btn-default btn-gray smoothScroll">More About Us</a>
                                   </div>
                              </div>
                         </div>

                         <div class="item item-third">
                              <div class="caption">
                                   <div class="col-md-offset-1 col-md-10">
                                        <h3>Pellentesque nec libero nisi</h3>
                                        <h1>Your Health Benefits</h1>
                                        <a href="#news" class="section-btn btn btn-default btn-blue smoothScroll">Read Stories</a>
                                   </div>
                              </div>
                         </div>
                    </div>

          </div>
     </div>
</section>


<!-- ABOUT -->
<section id="about">
     <div class="container">
          <div class="row">

               <div class="col-md-6 col-sm-6">
                    <div class="about-info">
                         <h2 class="wow fadeInUp" data-wow-delay="0.6s">Welcome to Your <i class="fa fa-h-square"></i>ealth Center</h2>
                         <div class="wow fadeInUp" data-wow-delay="0.8s">
                              <p>Aenean luctus lobortis tellus, vel ornare enim molestie condimentum. Curabitur lacinia nisi vitae velit volutpat venenatis.</p>
                              <p>Sed a dignissim lacus. Quisque fermentum est non orci commodo, a luctus urna mattis. Ut placerat, diam a tempus vehicula.</p>
                         </div>
                         <figure class="profile wow fadeInUp" data-wow-delay="1s">
                              <img src="{{URL::to('assets/frontend/images/author-image.jpg')}}" class="img-responsive" alt="">
                              <figcaption>
                                   <h3>Dr. Neil Jackson</h3>
                                   <p>General Principal</p>
                              </figcaption>
                         </figure>
                    </div>
               </div>
               
          </div>
     </div>
</section>


<!-- TEAM -->
<section id="team" data-stellar-background-ratio="1">
     <div class="container">
          <div class="row">

               <div class="col-md-6 col-sm-6">
                    <div class="about-info">
                         <h2 class="wow fadeInUp" data-wow-delay="0.1s">Our Doctors</h2>
                    </div>
               </div>

               <div class="clearfix"></div>

               @foreach($doctors as $doctor)
               <div class="col-md-4 col-sm-6">
                    <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                         <a href="{{ route('doctor.details',$doctor->id) }}"><img src="{{URL::asset($doctor->image)}}" class="img-responsive" alt=""></a>

                              <div class="team-info">
                                   <h3>{{ $doctor->name }}</h3>
                                   <p>{{ $doctor->department->name }}</p>
                                   <div class="team-contact-info">
                                        <p><i class="fa fa-phone"></i> {{ $doctor->mobile }}</p>
                                        <p><i class="fa fa-envelope-o"></i> <a href="#">{{ $doctor->email }}</a></p>
                                      
                                   </div>
                                   <a class="btn btn-primary" href="{{ route('doctor.details',$doctor->id) }}">View Details</a>
                                   <ul class="social-icon">
                                       
                                        <li><a href="#" class="fa fa-envelope-o"></a></li>
                                   </ul>
                                  
                              </div>

                    </div>
               </div>
               
               @endforeach
               
               
          </div>
     </div>
</section>


<!-- NEWS -->
<section id="news" data-stellar-background-ratio="2.5">
     <div class="container">
          <div class="row">

               <div class="col-md-12 col-sm-12">
                    <!-- SECTION TITLE -->
                    <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                         <h2>Latest News</h2>
                    </div>
               </div>

               <div class="col-md-4 col-sm-6">
                    <!-- NEWS THUMB -->
                    <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                         <a href="news-detail.html">
                              <img src="{{URL::to('assets/frontend/images/news-image1.jpg')}}" class="img-responsive" alt="">
                         </a>
                         <div class="news-info">
                              <span>March 08, 2018</span>
                              <h3><a href="news-detail.html">About Amazing Technology</a></h3>
                              <p>Maecenas risus neque, placerat volutpat tempor ut, vehicula et felis.</p>
                              <div class="author">
                                   <img src="{{URL::to('assets/frontend/images/author-image.jpg')}}" class="img-responsive" alt="">
                                   <div class="author-info">
                                        <h5>Jeremie Carlson</h5>
                                        <p>CEO / Founder</p>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col-md-4 col-sm-6">
                    <!-- NEWS THUMB -->
                    <div class="news-thumb wow fadeInUp" data-wow-delay="0.6s">
                         <a href="news-detail.html">
                              <img src="{{URL::to('assets/frontend/images/news-image2.jpg')}}" class="img-responsive" alt="">
                         </a>
                         <div class="news-info">
                              <span>February 20, 2018</span>
                              <h3><a href="news-detail.html">Introducing a new healing process</a></h3>
                              <p>Fusce vel sem finibus, rhoncus massa non, aliquam velit. Nam et est ligula.</p>
                              <div class="author">
                                   <img src="{{URL::to('assets/frontend/images/author-image.jpg')}}" class="img-responsive" alt="">
                                   <div class="author-info">
                                        <h5>Jason Stewart</h5>
                                        <p>General Director</p>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <div class="col-md-4 col-sm-6">
                    <!-- NEWS THUMB -->
                    <div class="news-thumb wow fadeInUp" data-wow-delay="0.8s">
                         <a href="news-detail.html">
                              <img src="{{URL::to('assets/frontend/images/news-image3.jpg')}}" class="img-responsive" alt="">
                         </a>
                         <div class="news-info">
                              <span>January 27, 2018</span>
                              <h3><a href="news-detail.html">Review Annual Medical Research</a></h3>
                              <p>Vivamus non nulla semper diam cursus maximus. Pellentesque dignissim.</p>
                              <div class="author">
                                   <img src="{{URL::to('assets/frontend/images/author-image.jpg')}}" class="img-responsive" alt="">
                                   <div class="author-info">
                                        <h5>Andrio Abero</h5>
                                        <p>Online Advertising</p>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

          </div>
     </div>
</section>


<!-- MAKE AN APPOINTMENT -->

<section id="appointment" data-stellar-background-ratio="3">
     <div class="container">
          <div class="row">
 
               <div class="col-md-6 col-sm-6">
                    <img src="{{URL::to('assets/frontend/images/appointment-image.jpg')}}" class="img-responsive" alt="">
               </div>
 
               <div class="col-md-6 col-sm-6"  id="appointment">
                   
                   
                    <!-- CONTACT FORM HERE -->
                   
 
                         <!-- SECTION TITLE -->
                         <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                              <h2>Make an appointment</h2>
                              <div class="d-flex">
                                   <button class="btn btn-primary" id="new">New Patient</button> 
                                    <button class="btn btn-success" id="old"> Old Patient</button>
                              </div>
                         </div>
                         
                      
                         {!! Form::open(['url' => '/appointments','method'=>'post',"id"=>"appointment-form","role"=>"form"]) !!}
 
                         <div class="wow fadeInUp " data-wow-delay="0.8s">
                              <div class="col-md-6 col-sm-6 " style="display:none"  id="patientId">
                                   
                                   {!! Form::label('Patient Id','Patient Id', ['class' => 'form-control-label']);!!}
                                   {!! Form::number("patient_id",null, ["class"=>"form-control "]) !!}
                                   <span class="validation-error">{{ $errors->first("patient_id") }}</span>
                              </div>
 
                              <div class="col-md-6 col-sm-6 "  id="name">
                                   
                                   {!! Form::label('name','Name', ['class' => 'form-control-label']);!!}
                                   {!! Form::text("name",null, ["class"=>"form-control ","placeholder"=>"Your Name",]) !!}
                                   <span class="validation-error">{{ $errors->first("name") }}</span>
                              </div>
 
                              <div class="col-md-6 col-sm-6 " id="email">
                                  
                                   {!! Form::label('email','Email', ['class' => 'form-control-label']);!!}
                                   {!! Form::email("email",null, ["class"=>"form-control ","placeholder"=>"Your Email"]) !!}
                                   <span class="validation-error">{{ $errors->first("email") }}</span>
                              </div>
 
                              <div class="col-md-6 col-sm-6" id="phone">
                                  
                                   {!! Form::label('mobile','Mobile', ['class' => 'form-control-label']);!!}
                                   {!! Form::text("mobile",null, ["class"=>"form-control ","placeholder"=>"Your Mobile"]) !!}
                                   <span class="validation-error">{{ $errors->first("mobile") }}</span>
                              </div>
                              
 
                              <div class="col-md-6 col-sm-6">
                                   {!! Form::label('department_id', 'Select Department', ['class' => 'form-control-label']);!!}
                                   {!! Form::select('department_id', $departments ,  null , ['placeholder' => 'Select Department',"class"=>"form-control department",'id'=>'department','required' => 'required']) !!}
                                   <span class="validation-error">{{ $errors->first("department_id") }}</span>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                   <label for="select">Select Doctor</label>
                                       <select name="doctor_id" id="doctor" class="form-control doctor" >
                                             <option value="0" disabled="true" selected="true">Doctor Name</option>
                                        </select>
                                        <span class="validation-error">{{ $errors->first("doctor_id") }}</span>
                              </div>
                              <div class="col-md-6 col-sm-6">
                                   {!! Form::label('date','Date:', ['class' => 'form-control-label']);!!}
                                   {!! Form::date("date",NULL, ["class"=>"form-control","placeholder"=>"Your Email","id"=>"date",'required' => 'required']) !!}
                                   <span class="validation-error">{{ $errors->first("date") }}</span>
                              </div>
 
                              <div class="col-md-12 col-sm-12">
                                   {!! Form::label('message', 'Message', ['class' => 'form-control-label']);!!}
                                   {!! Form::textarea('message', null, ['class' => 'form-control','id'=>'message','rows'=>5,'required' => 'required']) !!}
                                   <span class="validation-error">{{ $errors->first("messgae") }}</span>
                                   {!! Form::hidden('status',0) !!}
                                  
                                   <button type="submit" class="form-control" id="cf-submit" name="submit">Submit Button</button>
                              </div>
                         </div>
                         {!! Form::close() !!}
               </div>
 
          </div>
     </div>
 </section>

 @endsection