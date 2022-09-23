@extends('clinicViews.layouts.vault')
@section('title', 'Vault Index')
@section('extraStyle')
@endsection
@section('content')


    <div style="background: white; padding: 50px;">
        <div class="justify-content-end d-flex">
            <a class="justify-content-end d-flex text-secondary"
                href="{{ route('clinic.owners-vault.show', 'doctor-payslip-history') }}" style="font-size: 40px;">
                <i class="fa fa-clipboard" aria-hidden="true"></i>
            </a>
        </div>

        <div class="row mb-5">
            <div class="col  d-flex justify-content-center">
                <h1 class="mx-auto">Payslip Printing</h1>
            </div>
        </div>


        <table class="table">
            <thead>
                <tr>
                    <th class="text-center" scope="col">Name</th>
                    <th class="text-center" scope="col">Claimable</th>
                    <th class="text-center" scope="col">From</th>
                    <th class="text-center" scope="col">To</th>
                    <th class="text-center" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compensations as $row)
                    <tr>
                        <th class="text-center" scope="row">{{ $row->name }}</th>
                        <td class="text-center">&#8369;{{ $row->claimable }}</td>
                        <td class="text-center">{{ date_format($row->from, 'M d, Y') }}</td>
                        <td class="text-center">{{ date_format($row->to, 'M d, Y') }}</td>
                        <td class="text-center">

                            <a class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#view_payslip"
                                data-id="{{ $row->id }}" id="payslip_btn">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </a>

                            <a href="{{ route('clinic.owners-vault.show', $row->id) }}" class="btn btn-outline-primary">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>



    <div class="modal fade" id="view_payslip" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Print Payslip</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="text" id="specialist_id" hidden>
                    Are you sure you want to print <span id="specialist_name"></span>'s payslip?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="print_claimable">Print and Claim</button>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('js_script')
    <script>
        $(function() {
            $(document).on('click', 'a#payslip_btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                console.log(id);

                $.ajax({
                    type: "GET",
                    url: "/clinic/owners-vault/" + id + "/edit",
                    success: function(data) {
                        console.log(data);
                        $('#specialist_name').text(data.fullname);
                        $('#specialist_id').val(data.id);
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });


            });

            $(document).on('click', '#print_claimable', function(e) {
                e.preventDefault();
                var id = $('#specialist_id').val();

                console.log(id);

                $.ajax({
                    type: "DELETE",
                    url: "/clinic/owners-vault/" + id,
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(data) {
                        console.log(data);
                        var url =
                            "/clinic/owners-vault/create?name=" + data.name + "&clinic=" + data
                            .clinic + "&salary=" + data.salary;
                        window.open(url, '_blank').focus();
                        location.reload();
                    },
                    error: function(error) {
                        console.log('error');
                    }
                });


            });
        })
    </script>
@endsection
