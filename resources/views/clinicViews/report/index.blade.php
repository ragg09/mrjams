@extends('clinicViews.layouts.master')
@section('title', 'Appointment')
@section('extraStyle')
    <style>
        :root {
            --varyDarkBlue: hsl(234, 12%, 34%);
            --grayishBlue: hsl(229, 6%, 66%);
            --veryLightGray: hsl(0, 0%, 98%);
        }

        #accounting_box_first {
            background-color: var(--veryLightGray);
            box-shadow: 0px 20px 40px -10px var(--grayishBlue);
            border-top: 2px solid rgb(11, 95, 173);
            border-radius: 5px;
            min-height: 15px;
            overflow: hidden;
        }

        #accounting_box {
            background-color: var(--veryLightGray);
            box-shadow: 0px 20px 40px -10px var(--grayishBlue);
            border-top: 2px solid rgb(11, 95, 173);
            border-radius: 5px;
            min-height: 300px;
            overflow: hidden;
        }

        
        
    </style>
@endsection
@section('content')
    <div class="row" id="print_summary" hidden>
        <div class="col d-flex justify-content-end">
            <a href="/clinic/print/{{ date("FY") }}_summary" class="btn btn-primary" id="" target="_blank" title="Print Summary">
                Print Summary <i class="fa fa-print" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    @include('clinicViews.report.accounting')
    @include('clinicViews.report.appointment_statistic')
    @include('clinicViews.report.top_services_and_packages')
    @include('clinicViews.report.top_materials')
    @include('clinicViews.report.material_report_modal')
@endsection

@section('js_script')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ URL::asset('js/clinic/reports/reports.js') }}"></script>
@endsection


   