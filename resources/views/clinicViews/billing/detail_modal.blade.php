<div class="modal fade" id="view_bill_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
    
            <div class="modal-header">
                {{-- <a  class="printPage" href="#">Print</a> --}}
                <h5 class="modal-title" id="exampleModalLongTitle">Customer & Patient Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
    
            <div class="modal-body">
                    <div class="row" id="detail_modal_body">
                        {{-- data came from js --}}
                    </div>
            </div>
    
            <div class="modal-footer" id="detail_modal_footer">
                <a href="" class="btn btn-primary" id="view_bill_details_print" target="_blank">
                    Print <i class="fa fa-print" aria-hidden="true"></i>
                </a>
                {{-- button came from js --}}
            </div>
    
        </div>
    </div>
</div>