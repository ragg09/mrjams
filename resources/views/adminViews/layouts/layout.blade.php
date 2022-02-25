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
                  <span>"PAGE"</span>
              </li>
          </ol>
      </nav>
  </div>
  <div class="header-divider"></div>
</header>


@endsection

@section('extraScript')

<script src="{{ URL::asset('js/admin/userAnalytics.js') }}"></script>

@endsection
