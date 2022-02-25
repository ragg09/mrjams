<div id="sidebar-wrapper">
    <div class="sidebar-nav">
        <div id="logo-wrapper">
            <a href="/">
                <img src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" id="logo"/>
            </a>
        </div>

        <a href="" id="menu-toggle">
            <div id="sidebar-option">
                <i class="fa fa-bars" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Dashboard"></i>
            </div>
        </a>

        {{-- nav menus --}}
        <a href="/clinic" >
            <div id="sidebar-option">
                
                <i class="fa fa-tachometer" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Dashboard"></i>DASHBOARD
            </div>
        </a>
        <a href="#"  class="menu_appointment">
            <div id="sidebar-option">
                <i class="fa fa-calendar" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Appointment"></i>APPOINTMNET<i class="fa fa-caret-down" aria-hidden="true" style="float: right; margin-right: 5px"></i>
            </div>
        </a>
        {{-- dropdown menu appointment --}}
            <div id="sidebar-option-dropdown" class="menu_appointment_dropdown">
                <a href="{{ route('clinic.appointment.index') }}">
                    <div id="sidebar-option">
                        <i class="fa fa-calendar" aria-hidden="true" style="margin-right: 20px; margin-left: 30px"></i>In-coming
                    </div>
                </a>
                <a href="{{ route('clinic.appointment.create') }}">
                    <div id="sidebar-option">
                        <i class="fa fa-calendar" aria-hidden="true" style="margin-right: 20px; margin-left: 30px"></i>Accepted
                    </div>
                </a>
            </div> 
        {{-- dropdown menu appointment end--}}
        <a href="{{ route('clinic.patient.index') }}">
            <div id="sidebar-option">
                <i class="fa fa-users" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Patient"></i>PATIENT
            </div>
        </a>
        <a href="{{ route('clinic.billing.index') }}">
            <div id="sidebar-option">
                <i class="fa fa-money-bill" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Billings"></i>BILLINGS
            </div>
        </a>
       <a href="{{ route('clinic.services.index') }}" class="menu_services">
            <div id="sidebar-option">
                <i class="fa fa-user-md" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Service"></i>SERVICES
            </div>
        </a>
         <a href="{{ route('clinic.equipments.index') }}" class="menu_equipments">
            <div id="sidebar-option">
                <i class="fa fa-stethoscope" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Equipments"></i>EQUIPMENTS
            </div>
        </a>
        <a href="{{ route('clinic.packages.index') }}">
            <div id="sidebar-option">
                <i class="fa fa-medkit" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Packages"></i>PACKAGES
            </div>
        </a>
        <a href="{{ route('clinic.report.index') }}">
            <div id="sidebar-option">
                <i class="fa fa-bar-chart"  aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Report"></i>REPORT
            </div>
        </a>
        <a href="#">
            <div id="sidebar-option">
                <i class="fa fa-info-circle" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="About"></i>ABOUT
            </div>
        </a>
        {{-- nav menus end--}}
        
    </div>
</div>

