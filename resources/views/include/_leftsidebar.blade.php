<div class="br-sideleft sideleft-scrollbar">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
    <ul class="br-sideleft-menu">
      <li class="br-menu-item">
        <a href="index.html" class="br-menu-link active">
          <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
          <span class="menu-item-label">Dashboard</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
      @if(Auth()->user()->role_id==2)
      <li class="br-menu-item">
        <a href="{{route('prescription.doctor',$doctor->id)}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Prescription</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
      @endif
      @if(Auth()->user()->role_id==3)
      <li class="br-menu-item">
        <a href="{{route('prescription.patient',$patient->id)}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Prescription</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
      @endif

     
      @if(Auth()->user()->role_id==2)
      <li class="br-menu-item">
        <a href="#" class="br-menu-link with-sub">
          <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
          <span class="menu-item-label">Appointment</span>
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub">
          <li class="sub-item"><a href="{{route('appointments.approved',$doctor->id)}}" class="sub-link">Approved Appointments</a></li>
          <li class="sub-item"><a href="{{route('appointments.requested',$doctor->id)}}" class="sub-link">Requested Appointments</a></li>
          <li class="sub-item"><a href="card-listing.html" class="sub-link">Shop &amp; Listing</a></li>
        </ul>
      </li>
      @endif
      @if(Auth()->user()->role_id==3)
      <li class="br-menu-item">
        <a href="#" class="br-menu-link with-sub">
          <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
          <span class="menu-item-label">Appointment</span>
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub">
          <li class="sub-item"><a href="{{route('appointments.accepted',$patient->id)}}" class="sub-link">Approved Appointments</a></li>
          <li class="sub-item"><a href="{{route('appointments.pending',$patient->id)}}" class="sub-link">Requested Appointments</a></li>
          <li class="sub-item"><a href="card-listing.html" class="sub-link">Shop &amp; Listing</a></li>
        </ul>
      </li>
      @endif
      
      <li class="br-menu-item">
        <a href="#" class="br-menu-link with-sub">
          <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
          <span class="menu-item-label">UI Elements</span>
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub">
          <li class="sub-item"><a href="accordion.html" class="sub-link">Accordion</a></li>
          <li class="sub-item"><a href="alerts.html" class="sub-link">Alerts</a></li>
          <li class="sub-item"><a href="buttons.html" class="sub-link">Buttons</a></li>
          <li class="sub-item"><a href="cards.html" class="sub-link">Cards</a></li>
          <li class="sub-item"><a href="carousel.html" class="sub-link">Carousel</a></li>
          <li class="sub-item"><a href="dropdowns.html" class="sub-link">Dropdowns</a></li>
          <li class="sub-item"><a href="icons.html" class="sub-link">Icons</a></li>
          <li class="sub-item"><a href="images.html" class="sub-link">Images</a></li>
          <li class="sub-item"><a href="list.html" class="sub-link">Lists</a></li>
          <li class="sub-item"><a href="modal.html" class="sub-link">Modal</a></li>
          <li class="sub-item"><a href="media.html" class="sub-link">Media Object</a></li>
          <li class="sub-item"><a href="pagination.html" class="sub-link">Pagination</a></li>
          <li class="sub-item"><a href="popups.html" class="sub-link">Tooltip &amp; Popover</a></li>
          <li class="sub-item"><a href="progress.html" class="sub-link">Progress</a></li>
          <li class="sub-item"><a href="spinners.html" class="sub-link">Spinners</a></li>
          <li class="sub-item"><a href="typography.html" class="sub-link">Typography</a></li>
        </ul>
      </li><!-- br-menu-item -->
      <li class="br-menu-item">
        <a href="#" class="br-menu-link with-sub">
          <i class="menu-item-icon ion-ios-redo-outline tx-24"></i>
          <span class="menu-item-label">Navigation</span>
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub">
          <li class="sub-item"><a href="navigation.html" class="sub-link">Basic Nav</a></li>
          <li class="sub-item"><a href="navigation-layouts.html" class="sub-link">Nav Layouts</a></li>
          <li class="sub-item"><a href="navigation-effects.html" class="sub-link">Nav Effects</a></li>
        </ul>
      </li>
      <li class="br-menu-item">
        <a href="{{route('bloods.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Blood</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      <li class="br-menu-item">
        <a href="{{route('doctors.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Doctor</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      <li class="br-menu-item">
        <a href="{{route('schedules.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Schedule</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      <li class="br-menu-item">
        <a href="{{route('patients.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Patient</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->

      <li class="br-menu-item">
        <a href="{{route('departments.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Department</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      <li class="br-menu-item">
        <a href="{{route('facilities.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Deparment Facility</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
     
      @if(Auth()->user()->role_id==1)
      <li class="br-menu-item">
        <a href="{{route('admin.edit',$admin->id)}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Manage Profile</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @endif
      @if(Auth()->user()->role_id==2)
      <li class="br-menu-item">
        <a href="{{route('doctors.edit',$doctor->id)}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Manage Profile</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @endif
      @if(Auth()->user()->role_id==3)
      <li class="br-menu-item">
        <a href="{{route('patients.edit',$patient->id)}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Manage Profile</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @endif
     
    </ul><!-- br-sideleft-menu -->

   
    <br>
  </div><!-- br-sideleft -->