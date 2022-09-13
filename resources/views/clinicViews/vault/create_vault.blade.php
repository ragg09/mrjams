@extends('clinicViews.layouts.vault')
@section('title', 'Create Vault')
@section('extraStyle')
@endsection
@section('content')


    <div style="background: white; padding: 50px;">
        <div class="row">
            <div class="col  d-flex justify-content-center">
                <h1 class="" style="width: auto;">Create Vault!</h1>
            </div>
        </div>

        <div class="row">
            <div class="col  d-flex justify-content-center">
                <h6 class="" style="width: auto;">Clinic owner must manage this vault to track and print doctor's
                    conpensation.</h6>
            </div>
        </div>




        <div class="row mt-5">
            @if ($message = Session::get('success'))
                <div class="row">
                    <div class="col  d-flex justify-content-center">
                        <p class="text-danger alert-danger p-3 rounded" style="width: auto;"> {{ $message }} </p>


                    </div>
                </div>
            @endif


            <div class="col d-flex justify-content-center">
                <form action="{{ route('clinic.owners-vault.store') }}" method="POST">
                    @csrf

                    <input type="text" name="create_vault" id="create_vault" hidden value="create_vault">
                    <div class="mb-3">
                        <label for="password1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password1" name="password">
                    </div>

                    <div class="mb-3">
                        <label for="password2" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password2" name="password_confirmation">
                    </div>

                    <button type="submit" class="btn btn-primary">Create Vault</button>
                </form>
            </div>

        </div>

    </div>






@endsection

@section('js_script')

@endsection
