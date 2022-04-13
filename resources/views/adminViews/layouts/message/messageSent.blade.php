@extends('adminViews.layouts.master')

@section('title', 'Title')


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
                  <span>Message</span>
              </li>
          </ol>
      </nav>
  </div>
  <div class="header-divider"></div>
</header>
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <h3>Reply</h3>
            @csrf
            <div class="mb-3">
                <div class="container">
                    @foreach ($adminSent as $adminSents)
                    <div class="timeline">
                        <div class="timeline-row">
                            <div class="timeline-time">
                                {{ $adminSents->created_at}}
                            </div>
                            <div class="timeline-content">
                                {{-- <i class="icon-attachment"></i> --}}
                                <h4 style="color:#ffffff;"> Receiver: {{ $adminSents->receiver}}</h4>
                                <p style="color:#ffffff;"> Message: {{ $adminSents->message}}</p>
                                {{-- <div class="thumbs">
                                    <img class="img-fluid rounded" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Maxwell Admin">
                                    <img class="img-fluid rounded" src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="Maxwell Admin">
                                    <img class="img-fluid rounded" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="Maxwell Admin">
                                </div>
                                <div class="">
                                    <span class="badge badge-pill">Sales</span>
                                    <span class="badge badge-pill">Admin</span>
                                </div> --}}
                            </div>
                        </div>
                            {{-- <div class="timeline-row">
                                <div class="timeline-content">
                                    <p class="m-0">Loading...</p>
                                </div>
                            </div> --}}
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
        </div>
    </div>
</div>


@endsection

@section('extraScript')

{{-- <script src="{{ URL::asset('js/admin/userAnalytics.js') }}"></script> --}}

@endsection
