@extends('clinicViews.layouts.master')
@section('title', 'Patient')
@section('extraStyle')
    
@endsection
@section('content')
    @if (count($customers) > 0)
        <div class="col-lg-12 bg-white rounded" id="patient_table">
            <br>
            <table class="table display" id="PatientDataTable" >
                <thead>
                    <tr id="patient_table_head">
                        <th  scope="col"></th>
                        <th  scope="col">Name</th>
                        <th  scope="col">Email</th>
                        <th  scope="col"></th> 
                    </tr>
                </thead>
                <tbody  id="patient_table_body">
                    {{-- 15 max --}}
                    @foreach ($customers as $row)
                        <tr>
                            <td class="align-middle"><img class="rounded-circle" src="{{$row->avatar}}" alt="&#9829;"></td>
                            <td class="align-middle">{{$row->name}}</td>
                            <td class="align-middle">{{$row->email}}</td>
                            <td class="align-middle">
                                <a href="/clinic/patient/{{$row->id}}" class="btn btn-outline-primary" data-id="{{$row->id}}" id="view_patient_details">
                                    <i class="fa fa-eye" aria-hidden="true" ></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    @else
        <div class="container" style="height: 80vh">
            <div class="row h-100 justify-content-center align-items-center">
                <img class="rounded" src="{{ URL::asset('images/mrjams/noData.jpg') }}" alt="no data available" style="width: 500px" id="nodata_img">
            </div>
        </div>
    @endif
@endsection

@section('js_script')
    <script src="{{ URL::asset('js/clinic/patient/patient.js') }}"></script>
@endsection

   