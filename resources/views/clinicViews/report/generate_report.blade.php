<form action="/clinic/report/{{ $clinic->id }}/edit" method="GET" target="_blank">
    <div class="modal fade" id="generate_report_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Report Generator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">


                    <div class="accordion" id="accordionAppointment">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="app_heading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_appointmnet" aria-expanded="false"
                                    aria-controls="collapse_appointmnet">
                                    Appointment
                                </button>
                            </h2>
                            <div id="collapse_appointmnet" class="accordion-collapse collapse"
                                aria-labelledby="app_heading" data-bs-parent="#accordionAppointment">
                                <div class="accordion-body">
                                    <div class="form-group mb-3" hidden>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="app_summary2"
                                                value="detailed" name="app_option_selected" checked>
                                            <label class="form-check-label" for="app_summary2">Detailed <i
                                                    class="fa fa-question-circle mx-2" aria-hidden="true"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Generate a tabular report including name and availed service and/or package.">
                                                </i></label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="app_summary"
                                                value="summary" name="app_option_selected">
                                            <label class="form-check-label" for="app_summary">Summary <i
                                                    class="fa fa-question-circle mx-2" aria-hidden="true"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Generate a total count of the selected dates.">
                                                </i></label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                value="1" name="app_done">
                                            <label class="form-check-label" for="inlineCheckbox1">Done</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                value="2" name="app_pending">
                                            <label class="form-check-label" for="inlineCheckbox2">Pending</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3"
                                                value="3" name="app_declined">
                                            <label class="form-check-label" for="inlineCheckbox3">Declined</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox4"
                                                value="4" name="app_accepted">
                                            <label class="form-check-label" for="inlineCheckbox4">Accepted</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox5"
                                                value="5" name="app_nego">
                                            <label class="form-check-label" for="inlineCheckbox5">Negotiation</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox6"
                                                value="6" name="app_expired">
                                            <label class="form-check-label" for="inlineCheckbox6">Expired</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox7"
                                                value="8" name="app_cancelled">
                                            <label class="form-check-label" for="inlineCheckbox7">Cancelled</label>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="accordionBilling">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="bill_heading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_billing" aria-expanded="false"
                                    aria-controls="collapse_billing">
                                    Billing
                                </button>
                            </h2>
                            <div id="collapse_billing" class="accordion-collapse collapse"
                                aria-labelledby="bill_heading" data-bs-parent="#accordionBilling">
                                <div class="accordion-body">
                                    <div class="form-group mb-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckboxBill1"
                                                value="fully_paid" name="billing_fully_paid">
                                            <label class="form-check-label" for="inlineCheckboxBill1">Fully
                                                Paid</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckboxBill2"
                                                value="with_balance" name="billing_with_balance">
                                            <label class="form-check-label" for="inlineCheckboxBill2">With
                                                Balance</label>
                                        </div>

                                        <div class="form-check form-check-inline" hidden>
                                            <input class="form-check-input" type="checkbox" id="inlineCheckboxBill3"
                                                value="today" name="billing_today" checked>
                                            <label class="form-check-label" for="inlineCheckboxBill3">Daily</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="accordionMaterials">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="material_heading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_material" aria-expanded="false"
                                    aria-controls="collapse_material">
                                    Materials
                                </button>
                            </h2>
                            <div id="collapse_material" class="accordion-collapse collapse"
                                aria-labelledby="material_heading" data-bs-parent="#accordionMaterials">
                                <div class="accordion-body">
                                    <div class="form-group mb-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox"
                                                id="inlineCheckboxMaterial1" value="list" name="material_list">
                                            <label class="form-check-label" for="inlineCheckboxMaterial1">Material
                                                List <i class="fa fa-question-circle mx-2" aria-hidden="true"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Genereate tabular data without selecting range of dates.">
                                                </i></label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox"
                                                id="inlineCheckboxMaterial2" value="used_per_day"
                                                name="material_used_per_day">
                                            <label class="form-check-label" for="inlineCheckboxMaterial2">Used per day
                                                (Consumable & Medicine)</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox"
                                                id="inlineCheckboxMaterial3" value="top_selected"
                                                name="material_top_selected">
                                            <label class="form-check-label" for="inlineCheckboxMaterial3">Used
                                                Materials Summary</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="accordionServicePackage">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="ServicePackage_heading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_ServicePackage" aria-expanded="false"
                                    aria-controls="collapse_ServicePackage">
                                    Services & Packages
                                </button>
                            </h2>
                            <div id="collapse_ServicePackage" class="accordion-collapse collapse"
                                aria-labelledby="ServicePackage_heading" data-bs-parent="#accordionServicePackage">
                                <div class="accordion-body">
                                    <div class="form-group mb-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox"
                                                id="inlineCheckboxServicePackage2" value="availed_per_day"
                                                name="ServicePackage_availed_per_day">
                                            <label class="form-check-label"
                                                for="inlineCheckboxServicePackage2">Availed per day</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox"
                                                id="inlineCheckboxServicePackage1" value="list"
                                                name="ServicePackage_list">
                                            <label class="form-check-label"
                                                for="inlineCheckboxServicePackage1">Service & Package List <i
                                                    class="fa fa-question-circle mx-2" aria-hidden="true"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Genereate tabular data without selecting range of dates.">
                                                </i></label>
                                        </div>



                                        <div class="form-check form-check-inline" hidden>
                                            <input class="form-check-input" type="checkbox"
                                                id="inlineCheckboxServicePackage3" value="top_selected"
                                                name="ServicePackage_top_selected">
                                            <label class="form-check-label" for="inlineCheckboxServicePackage3">Top
                                                Selected Services & Packages <i class="fa fa-question-circle mx-2"
                                                    aria-hidden="true" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom"
                                                    title="Genereate tabular data without selecting range of dates.">
                                                </i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group d-flex justify-content-center mt-2">
                        <h4>Select Range of Dates</h4>
                    </div>
                    <div class="form-group d-flex justify-content-center" id="flatpickr">
                        <input type="text" class="" id="generate_report_modal_flatpicker"
                            name="datetime_report_generator" hidden>
                    </div>

                </div>

                <div class="modal-footer">
                    <button id="generate_report_all" type="submit" class="btn btn-primary" disabled>Print <i
                            class="fa fa-print" aria-hidden="true"></i></button>

                    <button class="btn btn-primary" type="button" id="response_waiting_equipment_create" disabled
                        hidden>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Waiting for response . . .
                    </button>
                </div>

            </div>
        </div>
    </div>

</form>
