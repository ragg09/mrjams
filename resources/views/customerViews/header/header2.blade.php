

    <header>
      <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #6497B1;">
          <div class="container-fluid">
            {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
            <a href="/"><img src="{{ asset('images/mrjams/logowithname.PNG') }}" style="margin-left: 5px;" width="160" height="65"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">

              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown"  style="font-weight:bold; margin-left: 580px">
              <ul class="navbar-nav" >
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('customer.about')}}">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('customer.clinicList.index')}}">Clinics</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('customer.mail.index')}}">Appointments</a> 
                </li>
                <li class="nav-item dropdown">
                  {{-- <p id="customerName"></p> --}}
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      {{-- {{ Auth::user()-> email}} --}}
              
                        {{-- {{ $customer->lname }}, {{ $customer->fname }} --}}
                
                      <span id="customerName"></span>
                      {{-- Account --}}
                    </a>
                  
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="/customer/customerinfo/create"><i class="fa fa-user" aria-hidden="true" style="margin-right: 10%;"></i> Profile</a></li>

                    <li><a class="dropdown-item" href="{{route('customer.announcement.index')}}"><i class="fa fa-bullhorn" aria-hidden="true" style="margin-right: 10%;"></i>Announcement</a></li>

                    {{-- <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#rate-modal"><i class="fa fa-commenting" aria-hidden="true" style="margin-right: 10%;"></i>Give Feedback</a></li> --}}

                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" ><i class="fa fa-sign-out" aria-hidden="true" style="margin-right: 10%;"></i>Logout</a><form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                      </form></li>
                    {{-- <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
  </header>
