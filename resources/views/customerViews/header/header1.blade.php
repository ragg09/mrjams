{{-- Header: Home and About --}}
<header>
    <nav>

      <li><img src="{{asset('images/mrjams/logowithname.PNG') }}" class="logotitle"></li>

      <li style="padding-top:15px;">
        <a href="/" style="text-decoration: none; color:black; ">Home</a>
      </li>

      <li style="padding-top:15px;">
        <a href="{{route('customer.about')}}" style="text-decoration: none; color:black;">About</a>
      </li>

      <li style="padding-top:15px;">
        <a href="{{route('customer.clinicList.index')}}" style="text-decoration: none; color:black;">Clinics</a>
      </li>
   
      <li style="padding-top:15px;">
        <a href="{{route('customer.mail.index')}}" style="text-decoration: none; color:black;">Appointments</a>
      </li>

      <li style="padding-top:8px;">
        <a href="/customer/customerinfo/create" style="text-decoration: none; color:black;">
          <img src="{{Auth::user()->avatar}}" alt="customer" class="rounded-circle p-1 bg-dark" width="40">
        </a>
      </li>

      <li>
        <div class="dropdown" style="padding-top:9px; margin-left: -15px; margin-right: -15px;">
            <button class="btn btn-transparent" type="button" id="notifIcon_btn" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 100%">
                <i class="fa fa-bell fa-lg" aria-hidden="true"></i>
                <span id="notif_count" hidden></span>
            </button>
            
            <ul class="dropdown-menu" aria-labelledby="notifIcon_btn" id="notification_list">
                {{-- data came from js --}}
            </ul>
        </div>
      
      </li>
      
      <li style="padding-top:15px;">
        <a href="{{route('customer.announcement.index')}}" style="text-decoration: none; color:black;">
          <i class="fa fa-bullhorn fa-lg " aria-hidden="true"></i>
        </a>
      </li>

      <li style="padding-top:15px;">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>
        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        </form>
      </li>
                      
  
  </nav> 
</header>

