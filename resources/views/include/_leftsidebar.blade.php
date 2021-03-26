<div class="br-sideleft sideleft-scrollbar">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
    <ul class="br-sideleft-menu">
      <li class="br-menu-item">
        <a href="index.html" class="br-menu-link active">
          <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
          <span class="menu-item-label">Dashboard</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->

      @can('viewAny', App\Models\Department::class)
      <li class="br-menu-item">
        <a href="{{route('departments.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Department</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @endcan
      @can('viewAny', App\Models\Facility::class)
      <li class="br-menu-item">
        <a href="{{route('facilities.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Deparment Facility</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @endcan
      @can('viewAny', App\Models\Test::class)
      <li class="br-menu-item">
        <a href="{{ route('tests.index') }}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
          <span class="menu-item-label">Test</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item -->
      @endcan
      
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
      
      <li class="br-menu-item">
        <a href="{{route('schedules.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Docrtor Schedule</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @if(Auth()->user()->role_id==2)
      <li class="br-menu-item">
        <a href="#" class="br-menu-link with-sub">
          <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
          <span class="menu-item-label">Appointment</span>
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub">
          <li class="sub-item"><a href="{{route('appointments.approved',$doctor->id)}}" class="sub-link">Approved Appointments</a></li>
          <li class="sub-item"><a href="{{route('appointments.requested',$doctor->id)}}" class="sub-link">Requested Appointments</a></li>
          
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
          <li class="sub-item"><a href="{{route('appointments.accepted',$patient->id)}}" class="sub-link">Accepted Appointments</a></li>
          <li class="sub-item"><a href="{{route('appointments.pending',$patient->id)}}" class="sub-link">Requested Appointments</a></li>
          
        </ul>
      </li>
      @endif
      
      @can('viewAny', App\Models\Blood::class)
      <li class="br-menu-item">
        <a href="{{route('bloods.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Blood</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @endcan
      @can('viewAny', App\Models\Doctor::class)
      <li class="br-menu-item">
        <a href="{{route('doctors.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Doctor</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @endcan
   
      @can('viewAny', App\Models\Patient::class)
      <li class="br-menu-item">
        <a href="{{route('patients.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Patient</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @endcan
      
      @can('viewAny', App\Models\Accountant::class)
      <li class="br-menu-item">
        <a href="{{route('accountants.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Accountant</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
    @endcan
    @can('viewAny', App\Models\Laboratorist::class)
      <li class="br-menu-item">
        <a href="{{route('laboratorists.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Laboratorist</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
     @endcan
     @can('viewAny', App\Models\Invoice::class)
      <li class="br-menu-item">
        <a href="{{route('invoices.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Invoice</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @endcan
  
     
     
      @can('viewAny', App\Models\BloodDonor::class)
      <li class="br-menu-item">
        <a href="{{route('bloodDonors.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Blood Donor</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @endcan
      @can('viewAny', App\Models\Setting::class)
      <li class="br-menu-item">
        <a href="{{route('settings.index')}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Settings</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @endcan


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
      @if(Auth()->user()->role_id==4)
      <li class="br-menu-item">
        <a href="{{route('accountants.edit',$accountant->id)}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Manage Profile</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @endif
      @if(Auth()->user()->role_id==5)
      <li class="br-menu-item">
        <a href="{{route('laboratorists.edit',$laboratorist->id)}}" class="br-menu-link">
          <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
          <span class="menu-item-label">Manage Profile</span>
        </a><!-- br-menu-link -->
      </li><!-- br-menu-item --><!-- br-menu-item -->
      @endif
     
    </ul><!-- br-sideleft-menu -->

   
    <br>
  </div><!-- br-sideleft -->