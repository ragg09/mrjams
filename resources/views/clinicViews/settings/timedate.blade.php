<div class="row justify-content-center mt-5" id="TimeDate">
    <div class="col-lg-7 border bg-white rounded p-2">
        <form action="/clinic/settings/{{ $general->id }}_time" method="POST" id="edit_timedate_form">
            @csrf
            {{method_field('PUT')}}
            <div class="row mb-3">
                <div class="col fw-bold d-flex justify-content-center">Day</div>
                <div class="col fw-bold d-flex justify-content-center">Minimum</div>
                <div class="col fw-bold d-flex justify-content-center">Maximum</div>
                <div class="col fw-bold d-flex justify-content-center">On / Off</div>
            </div>

            @foreach ($availability as $row)
                <div class="row align-items-baseline">
                    <div class="col d-flex justify-content-center">
                        <p class="fw-bold">{{ $row->day }}</p>
                        <input type="text" class="form-control" id="day{{ $row->count }}" name="day{{ $row->count }}" value="{{ $row->day }}" hidden>
                    </div>
    
                    <div class="col d-flex justify-content-center">
                        <div class="form-group" id="flatpickr">
                            <input type="text" class="form-control" id="min_time{{ $row->count }}" name="min_time{{ $row->count }}" value="{{ $row->min }}">
                        </div>
                    </div>
    
                    <div class="col d-flex justify-content-center">
                        <div class="form-groug" id="flatpickr">
                            <input type="text" class="form-control" id="max_time{{ $row->count }}" name="max_time{{ $row->count }}" value="{{ $row->max }}">
                        </div>
                    </div>

                    @if ($row->status == 'on')
                        <div class="col d-flex justify-content-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status{{ $row->count }}" role="switch{{ $row->count }}" id="flexSwitchCheckDefault" checked>
                            </div>
                        </div>
                    @else
                        <div class="col d-flex justify-content-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status{{ $row->count }}" role="switch" id="flexSwitchCheckDefault">
                            </div>
                        </div>
                    @endif
    
                </div>
            @endforeach
            <div class="row ">
                <div class="col d-flex justify-content-end"> 
                    <button type="submit" class="btn btn-primary" id="timedata_btn" disabled>Update</button>                
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ URL::asset('js/clinic/settings/timedate.js') }}"></script>
