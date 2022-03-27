@extends('clinicViews.layouts.master')
@section('title', 'Dashboard')
@section('extraStyle')
    <link rel="stylesheet" href="{{ URL::asset('css/clinic/logs/index.css') }}">
@endsection
@section('content')
{{-- style="height: 570px; overflow: hidden" --}}

<div class="row" >

    <div class="col-xl-7">
        <div class="row bg-white" id="dashboard_calendar_div">
    
            {{-- <h1>WIP | LATEST APPOINTMENTS</h1> --}}
            <div class="col-lg-12" id="calendar_div"></div>
        </div>
    </div>
    <div class="col-xl-5">
        <div class="bg-white" id="dashboard_table_div">

            {{-- <h1>WIP | NOTIFICATION</h1> --}}
            {{-- <span class="bell fa fa-bell"></span> --}}

            <a href="{{ route('clinic.logs.index') }}"  title="Click to see Logs History"><i class="fa fa-book mx-2 mb-2" aria-hidden="true"></i> Clinic Logs History</a>

            @if (count($data) > 0)
                <table class="table table-dark" id="dashboard_table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="colspan">Message</th>
            
                        </tr>
                    </thead>
                    <tbody>
                        {{-- 15 max --}}
                        @foreach ($data as $row)
                            <tr class="table-{{$row->remark}}">
                                <th scope="row">{{date('Md,Y', strtotime($row->date)) }}</th>
                                <td>{{ date('h:ia', strtotime($row->time))}}</td>
                                <td class="">{{$row->message}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <img src="{{ URL::asset('images/mrjams/noData.jpg') }}" alt="no data available" style="width: 100%" id="nodata_img">
            @endif
            
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