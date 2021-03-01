@extends('layout.guest')
@section('content')

<section id="appointment" data-stellar-background-ratio="3">
    <div class="container">
         <div class="row">

              <div class="col-md-6 col-sm-6">
                    <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                         <img src="{{URL::asset($doctor->image)}}" class="img-responsive" alt="">

                            <div class="team-info">
                                   <h3>{{ $doctor->name }}</h3>
                                   <p>{{ $doctor->department->name }}</p>
                                   <div class="team-contact-info">
                                        <p><i class="fa fa-phone"></i> {{ $doctor->mobile }}</p>
                                        <p><i class="fa fa-envelope-o"></i> <a href="#">{{ $doctor->email }}</a></p>
                                      
                                   </div>
                                   <a class="btn btn-primary" href=" ">View Details</a>
                                   <ul class="social-icon">
                                       
                                        <li><a href="#" class="fa fa-envelope-o"></a></li>
                                   </ul>                    
                              </div>
                              <div class="table-responsive m-5">
                                <table class="table  table-colored table-dark">
                                  <thead class="thead-colored thead-dark">
                                        <tr>
                                            <th>Doctor Name</th>
                                            <th>Department</th>
                                            <th>Day</th>
                                            <th>Starting Time</th>
                                            <th>Ending TIme</th>
                                            <th>No of patient</th>
                                       
                                           
                                        </tr>
                            
                            
                                    </thead>   
                                 <tbody>   
                                    @foreach($schedules as $schedule)
                                      <tr>
                                          
                                          <td class="center">{{$schedule->doctor->name}}</td>
                                          <td class="center">{{$schedule->doctor->department->name}}</td>
                                          <td class="center">{{$schedule->day->day_name}}</td>
                                          <td class="center">{{$schedule->starting_time}}</td>
                                          <td class="center">{{$schedule->ending_time}}</td>
                                          <td class="center">{{$schedule->total_patient}}</td>
                                         
                                      </tr>
                                      @endforeach
                                    </tbody>
                                </table>  
                            </div>
                    </div>
               
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
