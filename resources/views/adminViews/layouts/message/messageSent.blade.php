@extends('adminViews.layouts.master')

@section('title', 'MR. JAMS - Announcement')


@section('extraStyle')
    <link href="{{ asset('css/admin/messageSent.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('./css/admin/newUI.css') }}">
@endsection


@section('content')
    <header class="header header-sticky mb-2 mt-5">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-0 ms-2" style="background-color: #B3CDE0">
                    <li class="breadcrumb-item" style="margin-left: 20px;">
                        <span>Home</span>
                    </li>
                    <li class="breadcrumb-item active">
                        <span>Message</span>
                    </li>
                    <li class="breadcrumb-item active">
                        <span>Announcement</span>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="header-divider"></div>
    </header>

    {{-- <div class="col-md-8"> --}}
    <div class="panel panel-default" id="announce_id">
        <div class="panel-body" style="padding: 20px; background-color: white">
            <div class="h4 text-left text-danger" style="padding-bottom: 10px;"><b>Announcements: </b></div>

            <div class="timeline">

                <!-- Timeline header -->
                @foreach ($adminSent as $adminSents)
                    <div class="timeline-entry">
                        <div class="timeline-stat">
                            <div class="timeline-icon">
                                <img src="/images/mrjams/mr-jams-logo.png" alt="admin">
                            </div>
                            <div class="timeline-time" style="font-size: 18px; color: black;">
                                {{ date('h:i A', strtotime($adminSents->created_at)) }}</div>
                        </div>
                        <div class="timeline-label">
                            <h2 class="mar-no pad-btm"><a href="#" class="text-danger"><b>MR. JAMS</b></a></h4>
                                <p style="font-size: 18px;">{{ date('M j, Y', strtotime($adminSents->created_at)) }}</p>
                                <hr style="border: 3px solid black; border-radius: 2px;">
                                <p style="font-size: 17px;"><b>Receiver:</b> {{ $adminSents->receiver }}</p>
                                <p style="font-size: 17px;"><b>Message:</b> {{ $adminSents->message }}</p>
                        </div>
                    </div>
                @endforeach


            </div>



        </div>
    </div>
    </div>
    </div>
    {{-- </div> --}}
    {{-- <div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <h3>Reply</h3>
            @csrf
            <div class="mb-3">
                <div class="container">
                    @foreach ($adminSent as $adminSents)
                    <div class="timeline">
                        <div class="timeline-row">
                            <div class="timeline-time">
                                {{ $adminSents->created_at}}
                            </div>
                            <div class="timeline-content">

                                <h4 style="color:#ffffff;"> Receiver: {{ $adminSents->receiver}}</h4>
                                <p style="color:#ffffff;"> Message: {{ $adminSents->message}}</p>

                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div> --}}


@endsection

@section('extraScript')

    {{-- <script src="{{ URL::asset('js/admin/userAnalytics.js') }}"></script> --}}

@endsection
