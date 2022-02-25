@extends('clinicViews.layouts.master')
@section('title', 'Appointment')
@section('extraStyle')
@endsection
@section('content')

<div class="col-lg-12 overflow-hidden">
    @if ($data != "")
    <div class="row mb-2 bg-white">
        RESERVE FOR FILTER FUNCTIONS
    </div>

    <div class="col-lg-12 bg-white rounded" id="appointment_table">
        <table class="table">
            <thead>
                <tr id="appointment_table_head">
                    {{-- <th scope="col">Receipt</th> --}}
                    <th class="text-center" scope="col"></th>
                    <th class="text-center" scope="col">Email</th>
                    <th class="text-center" scope="col">Date of booking</th>
                    <th class="text-center" scope="col">Availed Service</th>
                    <th class="text-center" scope="col">Action</th>
                </tr>
            </thead>
            <tbody  id="appointment_table_body">
                {{-- 15 max --}}
                @foreach ($data as $row)
                    <tr>
                    
                        {{-- <td class="align-middle">{{$row->ro_id}}</td> --}}
                        <td class="align-middle text-center"><img class="rounded-circle" src="{{$row->user_avatar}}" alt="{{$row->user_avatar}}"></td>
                        <td class="align-middle text-center">{{$row->user_email}}</td>
                        <td class="align-middle text-center">{{$row->app_created_at}}</td>
                        <td class="align-middle text-center">{{$row->ro_package_name }}</td>
                        <td class="align-middle text-center">
                            <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detail_modal_up" id="detail_modal" data-id="{{ $row->ro_id }}" title="View Details">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        {{-- <div class="d-flex justify-content-center" id="pagination_div">
            {{ $next->links() }}
        </div> --}}
        @include('clinicViews.appointment.detail_modal')
        @include('clinicViews.appointment.accept_modal')
        @include('clinicViews.appointment.decline_modal')
    </div>
    @else
        <h3>No Available Data To Show</h3>
        <p>by deafault wala pang availble, once may accepted appointment na, lalabas na table</p>
    @endif
    
</div>


@endsection

@section('js_script')
    <script src="{{ URL::asset('js/clinic/appointment/appointment.js') }}"></script>
@endsection