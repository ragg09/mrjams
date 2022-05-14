<div id="sidebar-wrapper">
    <div class="sidebar-nav">
        <div id="logo-wrapper">
            <a href="/">
                <img src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" id="logo"/>
            </a>
        </div>

            <a href="/clinic/settings" id="menu-toggle">
                <div id="sidebar-option">
                    <i class="fa fa-bars" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Dashboard"></i>
                </div>
            </a>

        <a href="" id="DetailsSettings">
            <div id="sidebar-option">
                <i class="fa fa-info-circle" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Clinic Details"></i>Clinic Details
            </div>
        </a>

        <a href="" id="TimeDateSettings">
            <div id="sidebar-option">
                <i class="fa fa-calendar" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Time & Date"></i>Manual Schedule
            </div>
        </a>

        <a href="" id="PreferencesSettings" hidden>
            <div id="sidebar-option">
                <i class="fa fa-calendar" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Preferences"></i>Auto Schedule
            </div>
        </a>

        <a href="" id="SpecialistsSettings">
            <div id="sidebar-option">
                <i class="fa fa-users" aria-hidden="true" style="margin-right: 20px; margin-left: 10px" title="Specialists"></i>Specialists
            </div>
        </a>
        {{-- nav menus end--}}
        
    </div>
</div>


