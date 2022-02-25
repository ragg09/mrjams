@extends('clinicViews.layouts.master')
@section('title', 'Dashboard')
@section('extraStyle')
    <link rel="stylesheet" href="{{ URL::asset('css/clinic/logs/index.css') }}">
@endsection

@section('content')
<div class="col-lg-12">
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
                    <tr class="table-{{$row->remark}}">
                        <th scope="row">{{$row->date}}</th>
                        <td>{{$row->time}}</td>
                        <td>{{$row->message}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
 
@endsection

@section('js_script')
@endsection