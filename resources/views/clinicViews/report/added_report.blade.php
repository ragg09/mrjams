<div class="">
    <div class="row p-1">

        <div class="col-sm-12 col-md-12 col-lg-12 p-3">
            <div class="p-2" id="accounting_box_first">
                <div class="row p-4">


                    <div class="col">
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Specialization</th>
                                        <th scope="col">Served</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($x = 0; $x < 3; $x++)
                                        <tr>
                                            <td>{{ $complete_specialists_data[$x]->name }}</td>
                                            <td>{{ $complete_specialists_data[$x]->specialization }}</td>
                                            <td>{{ $complete_specialists_data[$x]->served }}</td>
                                        </tr>
                                    @endfor



                                </tbody>
                            </table>
                            <div class="col-12  d-flex justify-content-end ">
                                <p class="text-muted" style="margin-right: 20px">Doctor With The Most Performed Services
                                </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>




    </div>
</div>
