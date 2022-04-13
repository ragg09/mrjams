<div class="">
    <div class="row p-1 mt-2">

        <div class="col-lg-12 col-md-12 col-sm-12 p-3">
            <div class="p-2 d-flex justify-content-center align-items-center position-relative" id="accounting_box">

                <div class="position-absolute top-0 end-0" style="z-index: 4" id="print_inventory" hidden>
                    <div class="m-3">
                        <a data-bs-toggle="modal" data-bs-target="#material_report" class="btn btn-primary" title="Generate Report">
                            Generate Report <i class="fa fa-print" aria-hidden="true"></i>
                        </a>

                        <a href="/clinic/print/{{ date("FY") }}_inventory" class="btn btn-primary" id="" target="_blank" title="Print Inventory">
                            Print Listing <i class="fa fa-print" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded" id="materials_chart" style="width: 100%; height: 100%">
                    
                </div>

            </div>
        </div>   

        
    </div>
</div>