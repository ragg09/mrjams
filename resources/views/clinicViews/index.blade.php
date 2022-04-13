@extends('clinicViews.layouts.master')
@section('title', 'Dashboard')
@section('extraStyle')
    <link rel="stylesheet" href="{{ URL::asset('css/clinic/logs/index.css') }}">
@endsection
@section('content')
{{-- style="height: 570px; overflow: hidden" --}}

<div class="row" >

    <div class="col-12  mx-auto">
        <div class="row bg-white" id="dashboard_calendar_div">
    
            {{-- <h1>WIP | LATEST APPOINTMENTS</h1> --}}
            <div class="col-lg-12" id="calendar_div"></div>
        </div>
    </div>
</div>

{{-- <div class="col-lg-11 bg-white mt-3 p-3 rounded border m-auto overflow-hidden" id="dash_stats">
    <div style="width: 100%" id="curve_chart"></div>
</div> --}}

@include('clinicViews.appointment.accepted_view_detail_modal')


@endsection

@section('js_script')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="{{ URL::asset('js/clinic/dashboard/dashboard.js') }}"></script>
@endsection