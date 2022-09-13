<div class="">
    <div class="row p-1">

        <div class="col-sm-12 col-md-6 col-lg-6  p-3">
            <div class="p-2" id="accounting_box_first">
                <div class="row">
                    <div class="col d-flex justify-content-center my-auto">
                        <i class="fa fa-credit-card display-2 text-info" aria-hidden="true"></i>
                    </div>

                    <div class="col">
                        <div class="row">
                            <div class="col-12  d-flex justify-content-end ">
                                <p style="font-size: 30px; font-weight: bold; margin-right: 20px">
                                    &#8369;{{ number_format($total_paid, 0) }}</p>
                            </div>
                            <div class="col-12  d-flex justify-content-end ">
                                <p class="text-muted" style="margin-right: 20px">Total Paid</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-12 col-md-6 col-lg-6  p-3">
            <div class="p-2" id="accounting_box_first">
                <div class="row">
                    <div class="col d-flex justify-content-center my-auto">
                        <i class="fa fa-credit-card display-4 text-primary" aria-hidden="true"></i>
                    </div>

                    <div class="col">
                        <div class="row">
                            <div class="col-12  d-flex justify-content-end ">
                                <p style="font-size: 30px; font-weight: bold; margin-right: 20px">
                                    &#8369;15,250</p>
                            </div>
                            <div class="col-12  d-flex justify-content-end ">
                                <p class="text-muted" style="margin-right: 20px">Today's Revenue</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>



    </div>


    <div class="row p-1">


        <div class="col-sm-12 col-md-6 col-lg-6  p-3">
            <div class="p-2" id="accounting_box_first">
                <div class="row">
                    <div class="col d-flex justify-content-center my-auto">
                        <i class="fa fa-credit-card display-4 text-info" aria-hidden="true"></i>
                    </div>

                    <div class="col">
                        <div class="row">
                            <div class="col-12  d-flex justify-content-end ">
                                <p style="font-size: 30px; font-weight: bold; margin-right: 20px">
                                    &#8369;{{ number_format($total_balance, 0) }}</p>
                            </div>
                            <div class="col-12  d-flex justify-content-end ">
                                <p class="text-muted" style="margin-right: 20px">Expected Payment</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>



        <div class="col-sm-12 col-md-6 col-lg-6  p-3">
            <div class="p-2" id="accounting_box_first">
                <div class="row">
                    <div class="col d-flex justify-content-center my-auto">
                        <i class="fa fa-credit-card display-4 text-primary" aria-hidden="true"></i>
                    </div>

                    <div class="col">
                        <div class="row">
                            <div class="col-12  d-flex justify-content-end ">
                                <p style="font-size: 30px; font-weight: bold; margin-right: 20px">
                                    &#8369;{{ number_format($total_paid + $total_balance, 0) }}</p>
                            </div>
                            <div class="col-12  d-flex justify-content-end ">
                                <p class="text-muted" style="margin-right: 20px">Revenue (Raw)</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>




    </div>
</div>
