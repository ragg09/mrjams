@extends('clinicViews.layouts.master')
@section('title', 'Logs')
@section('extraStyle')
    <link rel="stylesheet" href="{{ URL::asset('css/clinic/logs/index.css') }}">
@endsection

@section('content')
    <div class="col-lg-12">

        @if (count($data) > 0)
            <div class="text-white bg-secondary" id="dashboard_table_div">
                <table class="table bg-secondary table-dark" id="dashboard_table">

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
                            <tr class="table-{{ $row->remark }}">
                                <th scope="row">{{ $row->date }}</th>
                                <td>{{ $row->time }}</td>
                                <td>{{ $row->message }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="container" style="height: 80vh">
                <div class="row h-100 justify-content-center align-items-center">
                    <img class="rounded" src="{{ URL::asset('images/mrjams/noData.jpg') }}" alt="no data available"
                        style="width: 500px" id="nodata_img">
                </div>
            </div>

        @endif


    </div>

@endsection

@section('js_script')
@endsection
