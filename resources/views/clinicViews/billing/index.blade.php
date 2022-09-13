@extends('clinicViews.layouts.master')
@section('title', 'Billing')
@section('extraStyle')
    <style>
        :root {
            --varyDarkBlue: hsl(234, 12%, 34%);
            --grayishBlue: hsl(229, 6%, 66%);
            --veryLightGray: hsl(0, 0%, 98%);
        }

        #nodata_img {
            background-color: var(--veryLightGray);
            box-shadow: 0px 20px 30px -20px var(--grayishBlue);
            border-top: 2px solid rgb(11, 95, 173);
            border-radius: 5px;
        }

        #bill_history {
            width: 90%;
            margin: auto;
        }

        #bill_history p {
            border-top: 2px dashed;
            border-color: blue !important;
            margin: 0;
            padding: 30px;
            counter-increment: section;
            position: relative;
        }



        #bill_history p:nth-child(even):before {
            content: counter(section);
            right: 100%;
            margin-right: -20px;
            position: absolute;
            border-radius: 50%;
            padding: 5px;
            height: 40px;
            width: 40px;
            background-color: blue;
            text-align: center;
            color: white;
            font-size: 110%;
        }

        #bill_history p:nth-child(odd):before {
            content: counter(section);
            left: 100%;
            margin-left: -20px;
            position: absolute;
            border-radius: 50%;
            padding: 5px;
            height: 40px;
            width: 40px;
            background-color: blue;
            text-align: center;
            color: white;
            font-size: 110%;
        }

        #bill_history p:nth-child(even) {
            border-left: 2px dashed;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
            margin-right: 30px;
            padding-right: 0;
        }

        #bill_history p:nth-child(odd) {
            border-right: 2px dashed;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
            margin-left: 30px;
            padding-left: 0;
        }

        #bill_history p:first-child {
            border-top: 0;
            border-top-right-radius: 0;
            border-top-left-radius: 0;
        }

        #bill_history p:last-child {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
    </style>
@endsection
@section('content')
    <div class="dropdown">
        <a class="btn btn-muted dropdown-toggle float-end" href="#" role="button" id="dropdownMenuLink"
            data-bs-toggle="dropdown" aria-expanded="false">
            Sort by
        </a>

        <ul class="dropdown-menu bg-light bg-gradient" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="/clinic/billing">All</a></li>
            <li><a class="dropdown-item" href="/clinic/billing?SortBy=balance">With Balance</a></li>
            <li><a class="dropdown-item" href="/clinic/billing?SortBy=paid">Fully Paid</a></li>
        </ul>
    </div>
    @if ($bill_status != '')
        <div id="div_bill_table">
            <table class="table bg-white">
                <thead>
                    <tr id="services_table_head">
                        {{-- <th scope="col">Total</th> --}}
                        <th scope="col"></th>
                        <th scope="col" class="align-middle text-center">Name</th>
                        <th scope="col" class="align-middle text-center">Total</th>
                        <th scope="col" class="align-middle text-center">Paid</th>
                        <th scope="col" class="align-middle text-center">Balance</th>
                        <th scope="col" class="align-middle text-center">Finished at</th>
                        <th scope="col" class="align-middle text-center">Updated at</th>
                        <th scope="col" class="align-middle text-center">{{-- Actiom --}}</th>

                    </tr>
                </thead>
                <tbody id="service_table_body">
                    @for ($x = 0; $x < count($bills); $x++)
                        <tr>
                            <td class="align-middle text-center">
                                <a href="/clinic/patient/{{ $customers[$x]->id }}"
                                    class="rounded-circle btn btn-outline-light" data-id="{{ $customers[$x]->id }}"
                                    id="view_patient_details">
                                    <img class="rounded-circle" src="{{ $customers[$x]->avatar }}"
                                        alt="{{ $customers[$x]->avatar }}">
                                </a>

                            </td>
                            <td class="align-middle text-center">{{ $customers[$x]->name }}</td>
                            <td class="align-middle text-center">&#8369;{{ $customers[$x]->total }}</td>
                            @if ($customers[$x]->total == $customers[$x]->paid)
                                <td class="align-middle text-center"><i class="fa fa-check-circle text-success"
                                        aria-hidden="true"></i></td>
                                <td class="align-middle text-center"> - </td>
                            @else
                                <td class="align-middle text-center">&#8369;{{ $customers[$x]->paid }}</td>
                                <td class="align-middle text-center">&#8369;{{ $customers[$x]->balance }}</td>
                            @endif


                            <td class="align-middle text-center">{{ date('F d, Y', strtotime($customers[$x]->created_at)) }}
                            </td>
                            <td class="align-middle text-center">{{ date('F d, Y', strtotime($customers[$x]->updated_at)) }}
                            </td>
                            <td class="align-middle text-center">
                                <a class="btn btn-outline-primary mt-1" data-id="{{ $customers[$x]->ro_id }}"
                                    data-bs-toggle="modal" data-bs-target="#view_bill_details" id="view_billing_detail_btn">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>

                                <a id="bill_history_btn" data-id="{{ $customers[$x]->bill_id }}"
                                    data-bs-target="#bill_history_modal" class="btn btn-outline-success mt-1"
                                    data-bs-toggle="modal">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                </a>

                                @if ($customers[$x]->total != $customers[$x]->paid)
                                    <br>

                                    <a data-id="{{ $customers[$x]->bill_id }}" id="view_billing_update_btn"
                                        class="btn btn-outline-warning mt-1" data-bs-toggle="modal"
                                        data-bs-target="#update_bill_view">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>

                                    <a data-name="{{ $customers[$x]->name }}" data-email="{{ $customers[$x]->email }}"
                                        data-ro_id="{{ $customers[$x]->ro_id }}" id="send_email_btn"
                                        data-bs-target="#send_email_modal" class="btn btn-outline-danger mt-1"
                                        data-bs-toggle="modal">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </a>
                                @endif



                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        @include('clinicViews.billing.detail_modal')
        @include('clinicViews.billing.history_modal')
        @include('clinicViews.billing.update_bill')
        @include('clinicViews.billing.send_email')
    @else
        <div class="container" style="height: 80vh">
            <div class="row h-100 justify-content-center align-items-center">
                <img class="rounded" src="{{ URL::asset('images/mrjams/noData.jpg') }}" alt="no data available"
                    style="width: 500px" id="nodata_img">
            </div>
        </div>
    @endif
@endsection

@section('js_script')
    <script src="{{ URL::asset('js/clinic/billings/views.js') }}"></script>
@endsection
