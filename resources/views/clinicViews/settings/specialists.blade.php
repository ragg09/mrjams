<div class="row justify-content-center" id="Specialists">
    <div class="col-lg-7 border">
        <div id="specialists_table">
            @if (count($specialists)>0)
                <table class="table">
                    <thead>
                        <tr id="specialists_table_head">
                            <th scope="col">Name</th>
                            <th scope="col">Specialization</th>
                            <th scope="col">Time Availability</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($specialists as $row)
                            <tr>
                                <td>{{ $row->fullname }}</td>
                                <td>{{ $row->specialization }}</td>
                                <td>{{ date('h:i A', strtotime($row->min_time )) }} - {{ date('h:i A', strtotime($row->max_time ))}}</td>
                                <td>    
                                    <a href="" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit_specialists_modal" id="edit_specialist" data-id="{{ $row->id }}" title="Edit {{$row->fullname}}">
                                        <i class="fa fa-pencil" aria-hidden="true" ></i>
                                    </a>
                                    <a href="" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete_specialists_modal" id="delete_specialist" data-id="{{$row->id}}" title="Delete {{$row->fullname}}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="row mt-2">
                    <div class="col-12 w-75 mx-auto rounded" style="background: rgb(245, 6, 6)">
                        <div class=" mx-auto p-1">
                            <p class="text-white">
                                <i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i>
                                Please add Specialist if {{ $general->name }} has more than one doctors. 
                                The system will inlcude this settings to optimize your appointment scheduling.
                                Thank you for your understanding.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row mb-3 mt-2">
                    <img src="{{ URL::asset('images/mrjams/noData1.jpg') }}" alt="no data available">
                </div>
            @endif
        </div>
        
        <div class="row ">
            <div class="col d-flex justify-content-center"> 
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create_specialists_modal">
                    <i class="fas fa-plus"></i>
                </button>               
            </div>
        </div>
    </div>
</div>    