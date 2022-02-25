@extends('adminViews.layouts.master')

@section('title', 'Clinic')


@section('extraStyle')
    
@endsection


@section('content')
<header class="header header-sticky mb-4"> 
  <div class="container-fluid">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                  <span>Home</span>
              </li>
              <li class="breadcrumb-item active">
                  <span>Clinic</span>
              </li>
          </ol>
      </nav>
  </div>
  <div class="header-divider"></div>
</header>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                {{-- @php 
                dd($clinic);
                @endphp --}}
                {{-- @foreach($clinic as $clinics) --}}
                    <p>{{ $clinic->id}}</p> <br>
                    <p>{{ $clinic->name}}</p> <br>
                    <p>{{ $clinic->phone}}</p> <br>
                    <p>{{ $clinic->telephone}}</p>
                {{-- @endforeach  --}}
                    {{-- <p>{{ $customer->id}}</p> <br>
                    <p>{{ $customer->name}}</p> <br> --}}
                    {{-- <p>{{ $clinic->phone}}</p> <br>
                    <p>{{ $clinic->telephone}}</p> --}}
            </div>
      </div>
  </div>


@endsection

@section('extraScript')

{{-- <script src="{{ URL::asset('js/admin/userAnalytics.js') }}"></script> --}}

@endsection
