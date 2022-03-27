{{-- <style>
#Preferences:before{
  content: 'Future Feature';
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: ;
  
  color: #0d745e;
  font-size: 100px;
  font-weight: 500px;
  display: grid;
  justify-content: center;
  align-content: center;
  opacity: 0.2;
  transform: rotate(-45deg);
}
</style> --}}
<div class="row justify-content-center" id="Preferences" >
    
    <div class="col-lg-7 border" style="background: #eef5f9;">
        
        <form action="/clinic/settings/{{ $general->id }}_EditAutoSched" method="POST" id="edit_autosched_form">
            @csrf
            {{method_field('PUT')}}
            <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic checkbox toggle button group">
                @for ($x = 0; $x <= 6; $x++)
                    @if ($auto_sched_day_status[$x] == "on")
                        <input type="checkbox" class="btn-check" id="btn_{{ $days[$x] }}" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="btn_{{ $days[$x] }}">{{ ucfirst($days[$x]) }}</label>
                    @else
                        <input type="checkbox" class="btn-check" id="btn_{{ $days[$x] }}" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btn_{{ $days[$x] }}">{{ ucfirst($days[$x]) }}</label>
                    @endif

                    {{-- <input type="checkbox" class="btn-check" id="btn_{{ $days[$x] }}" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="btn_{{ $days[$x] }}">{{ ucfirst($days[$x]) }}</label> --}}
                @endfor

            </div>

            <div class="row border mt-2 mb-1">
                <div class="col"> 
                    <button type="submit" class="btn btn-primary w-100" id="auto_sched_btn" disabled>Update</button>                
                </div>
            </div>

           <div class="row  mt-3" id="div_auto_sched_options">
               <div class="col">
                    <div class="row">
                        <div class="col-auto">
                            <p>Auto Accept
                                <i class="fa fa-question-circle mx-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Please be noted that by enabling this, appointments will automatically accept depends on your settings.">
                                </i>
                            </p>
                        </div>
                        <div class="col-auto">
                            <div class="form-check form-switch">
                                @if ($auto_accept == "on")
                                    <input class="form-check-input" type="checkbox" role="switch" id="auto_accept_switch" checked>
                                @else
                                    <input class="form-check-input" type="checkbox" role="switch" id="auto_accept_switch">
                                @endif
                            </div>
                        </div>
                    </div>

               </div>
               <div class="col">
                    <div class="row">
                        <div class="col-auto">
                            <p>Auto fill date
                                <i class="fa fa-question-circle mx-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enabling this, your clinic will accept appointments orderly. By default, patient can select their prefered time based on your settings.">
                                </i>
                            </p>
                        </div>
                        <div class="col-auto">
                            <div class="form-check form-switch">
                                @if ($auto_fill_date == "on")
                                    <input class="form-check-input" type="checkbox" role="switch" id="auto_fill_date_switch" checked>
                                @else
                                    <input class="form-check-input" type="checkbox" role="switch" id="auto_fill_date_switch">
                                @endif
                            </div>
                        </div>
                    </div>
               </div>
               <div class="col">
                    <div class="row">
                        <div class="col-auto">
                            <p>coming soon
                                <i class="fa fa-question-circle mx-2" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="bottom" title="coming soon">
                                </i>
                            </p>
                        </div>
                        <div class="col-auto">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" disabled>
                            </div>
                        </div>
                    </div>
               </div>
           </div>

           <input type="text" name="auto_accept" id="auto_accept" hidden>
           <input type="text" name="auto_fill_date" id="auto_fill_date" hidden>
           <input type="text" name="auto_summary" id="auto_summary" hidden>
    
            <div class="row">
                @for ($x = 0; $x <= 6; $x++)
                    @if ($auto_sched_day_status[$x] == "on")
                    <div class="col-lg-12 col-md-6 col-sm-6 p-2" id="div_{{ $days[$x] }}" style="display: block">
                    @else
                    <div class="col-lg-12 col-md-6 col-sm-6 p-2" id="div_{{ $days[$x] }}" style="display: none">
                    @endif
                        <div class="border p-2 bg-white mx-lg-2">
                            <div class="row">
                                <div class="col">
                                    <p>{{ $days_full[$x] }}</p>
                                </div>
                                <div class="col">
                                    <div class="form-check form-switch d-flex justify-content-end">
                                        @if ($auto_sched_day_status[$x] == "on")
                                            <input class="form-check-input" type="checkbox" role="switch" checked id="{{ $days[$x] }}_status">
                                        @else
                                            <input class="form-check-input" type="checkbox" role="switch" id="{{ $days[$x] }}_status">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row border">
                                <div class="col-lg col-md-12 col-sm-12 mx-1 mr-1">
                                    <div class="row">
                                        <div class="col">Time</div>
                                        <div class="col">AM</div>
                                        <div class="col">PM</div>
                                    </div>

                                    @for ($i = 1; $i <= 6; $i++)
                                        
                                        <div class="row">
                                            <div class="col">
                                                {{ $i }}:00
                                            </div>
                                            <div class="col">
                                                <div class="form-check form-switch">
                                                    @if ($auto_sched_data_all[$x][$i-1]== "o")
                                                        <input class="form-check-input" type="checkbox" role="switch" id="{{ $days[$x] }}_{{ $i }}" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" role="switch" id="{{ $days[$x] }}_{{ $i }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check form-switch">
                                                    @if ($auto_sched_data_all[$x][$i+11]== "o")
                                                        <input class="form-check-input" type="checkbox" role="switch" id="{{ $days[$x] }}_{{ $i+12 }}" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" role="switch" id="{{ $days[$x] }}_{{ $i+12 }}">
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                
                                <div class="col-lg col-md-12 col-sm-12 mx-1 ml-1">
                                    <div class="row">
                                        <div class="col d-sm-none d-md-none d-lg-block">Time</div>
                                        <div class="col d-sm-none d-md-none d-lg-block">AM</div>
                                        <div class="col d-sm-none d-md-none d-lg-block">PM</div>
                                    </div>

                                    @for ($i = 7; $i <= 12; $i++)
                                        <div class="row">
                                            <div class="col">
                                                {{ $i }}:00
                                            </div>
                                            <div class="col">
                                                <div class="form-check form-switch">
                                                    @if ($auto_sched_data_all[$x][$i-1]== "o")
                                                        <input class="form-check-input" type="checkbox" role="switch" id="{{ $days[$x] }}_{{ $i }}" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" role="switch" id="{{ $days[$x] }}_{{ $i }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check form-switch">
                                                    @if ($auto_sched_data_all[$x][$i+11]== "o")
                                                        <input class="form-check-input" type="checkbox" role="switch" id="{{ $days[$x] }}_{{ $i+12 }}" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" role="switch" id="{{ $days[$x] }}_{{ $i+12 }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>


                        </div>
                    </div>
                @endfor
            </div>
        </form>
    </div>    
     
    <input id="future_feature" value="Future Purposes" hidden>
</div>   


{{-- ung js nito nasa timedat.js --}}

<script>
    function watermark(text) {
    var body = document.getElementById('Preferences');
    var bg = "url(\"data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='100px' width='100px'>" +
        "<text transform='translate(20, 100) rotate(-45)' fill='rgb(245,45,45)' font-size='16' >" + text + "</text></svg>\")";
    body.style.backgroundImage = bg
    }

    //for this test
    var input = document.getElementById('future_feature');
    watermark(input.value);
    input.addEventListener('input', function(evt) {
    watermark(this.value);
    });
</script>