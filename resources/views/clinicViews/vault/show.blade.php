@extends('clinicViews.layouts.vault')
@section('title', 'Vault Specialist Service List')
@section('extraStyle')
@endsection
@section('content')


    <div style="background: white; padding: 50px;">


        <div class="row mb-5">
            <div class="col  d-flex justify-content-center">
                <h2 class="mx-auto">{{ $this_specialists->fullname }}'s Service List</h2>
            </div>
        </div>


        <table class="table">
            <thead>
                <tr>
                    <th class="text-center" scope="col">Claimable</th>
                    <th class="text-center" scope="col">Date</th>
                    <th class="text-center" scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compensations as $row)
                    <tr>
                        <td class="text-center">&#8369;{{ $row->compensation }}</td>
                        <td class="text-center">{{ date_format($row->created_at, 'M d, Y') }}</td>
                        <td class="text-center">

                            <a class="btn btn-outline-primary mt-1" data-id="{{ $row->receipt_order_id }}"
                                data-bs-toggle="modal" data-bs-target="#view_bill_details" id="view_billing_detail_btn">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>


    @include('clinicViews.billing.detail_modal')




@endsection

@section('js_script')
    {{-- <script src="{{ URL::asset('js/clinic/billings/views.js') }}"></script> --}}

    <script>
        $(function() {
            $(document).on('click', 'a#view_billing_detail_btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    type: "DELETE",
                    url: "/clinic/billing/" + id,
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(data) {
                        // console.log(data);

                        $("#detail_modal_body").empty();

                        $("#detail_modal_body").append(
                            '<div class="col-lg-5" style="border-right: 1px solid black"><div class="row d-flex align-items-baseline"><div class="col-lg-4 col-md-4 col-sm-4"><img class="rounded-circle" src="' +
                            data.data.user_avatar +
                            '"></div><div class="col-lg-8 col-md-8 col-sm-8 align-bottom"><span>' +
                            data.data.user_contact + '<br>' + data.data.user_email +
                            '</span></div></div><div class="row mt-4 mx-4"><p><i class="fas fa-user-tag mx-3"></i> ' +
                            data.data.user_name +
                            '</p><p><i class="fas fa-venus-mars mx-3"></i>' + data.data
                            .user_gender +
                            ' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>' +
                            data.data.user_age +
                            ' y/o </p><p><i class="fas fa-address-book mx-3"></i> ' + data
                            .data.user_address +
                            ' </p></div></div><div class="col-lg-7 mt-md-5 mt-sm-5 mt-lg-0"><div class="row"><h2>Patient</h2><div class="col-lg-4 d-flex align-items-center justify-content-center"><i class="fas fa-briefcase-medical" style="font-size: 60px"></i></div><div class="col-lg-8"><h4 class="mx-4">&#x2022;' +
                            data.data.package_service_summary +
                            '</h4></div></div><div class="row mt-5 mx-2"><p><i class="fas fa-user-tag mx-3"></i> ' +
                            data.data.patient_name +
                            ' </p><p><i class="fas fa-venus-mars mx-3"></i>' + data.data
                            .patient_gender +
                            ' <span class="mx-3"></span> <i class="fas fa-calendar-day mx-3"></i>' +
                            data.data.patient_age +
                            ' y/o </p><p><i class="fas fa-address-book mx-3"></i> ' + data
                            .data.patient_address + ' </p></div></div>');

                        $('#view_bill_details_print').attr('href', "/clinic/print/" + id +
                            "_receipt");

                    },
                    error: function(error) {
                        console.log('error');
                    }
                });


            });
        })
    </script>
@endsection
