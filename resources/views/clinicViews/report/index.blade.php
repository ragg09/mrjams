@extends('clinicViews.layouts.master')
@section('title', 'Appointment')
@section('extraStyle')
    <style>
        :root {
            --varyDarkBlue: hsl(234, 12%, 34%);
            --grayishBlue: hsl(229, 6%, 66%);
            --veryLightGray: hsl(0, 0%, 98%);
        }

        #accounting_box {
            background-color: var(--veryLightGray);
            box-shadow: 0px 20px 40px -10px var(--grayishBlue);
            border-top: 2px solid rgb(11, 95, 173);
            border-radius: 5px;
            min-height: 150px;
            overflow: hidden;
        }
        
    </style>
@endsection
@section('content')
    @include('clinicViews.report.accounting')
    @include('clinicViews.report.appointment_statistic')
    @include('clinicViews.report.top_services_and_packages')
    @include('clinicViews.report.top_materials_and_customer')
@endsection

@section('js_script')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ URL::asset('js/clinic/reports/services.js') }}"></script>

@endsection
   