<form action="/customer/rate" method="POST" id="main_form">
            @csrf
            <div class="modal fade" id="rate-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">

                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><img src="{{ URL::asset('images/mrjams/logowithname.PNG') }}" width="200px" height="70px" style="margin: -15px;"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                
                        <div class="modal-body" style="align-items: left; justify-content: left;">

                            <div class="form-group">
                                <label for="area" style="margin-bottom: 5px;"><b>How can we improve?</b></label>
                                
        
                                <select class="form-select" aria-label="Default select example" id="area" name="area">
                                    <option selected>Choose an area</option>
                                    <option value="Appointment">Appointment</option>
                                    <option value="Billings">Billings</option>
                                    <option value="Calendar">Calendar</option>
                                    <option value="Dashboard">Dashboard</option>
                                    <option value="Emails">Emails</option>
                                    <option value="Logs">Logs</option>
                                    <option value="Mapping">Mapping</option>
                                    <option value="Material Inventory">Material Inventory</option>
                                    <option value="Packages">Packages</option>
                                    <option value="Services">Services</option>
                                    <option value="Settings">Settings</option>
                                    <option value="User Interface">User Interface</option>
                                    <option value="Others">Others</option>
                                </select>
        
                                <span class="text-danger error-text area_error"></span>
                            </div>
        
                            <div class="form-group mt-2">
                                <label for="text" style="margin-bottom: 5px;"><b>Details</b></label>
                                <textarea class="form-control w-100" id="text" style="min-height: 200px; max-height: 200px" placeholder="Please include as much information as possible . . ." name="message"></textarea>
                                <span class="text-danger error-text message_error"></span>
                            </div>


                            <div class="form-group mt-2">
                                <label for="text" style="margin-bottom: 5px;"><b>How would you rate our System?</b></label>
                                <input type="hidden" name="rater_id" value="{{Auth::user()->id}}">
                 
                                <div class="rating"> 
                                    <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> 
                                    <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
                                    <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> 
                                    <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> 
                                    <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                </div>
                            </div>
                            
                            
                        </div>
                
                        <div class="modal-footer">
                            {{-- mga button --}}
                            <button type="submit" class="btn btn-warning" data-bs-dismiss="modal" aria-label="Submit">Submit</button>
        
                        </div>

                    
                
                    </div>
                </div>
            </div>

        </form>