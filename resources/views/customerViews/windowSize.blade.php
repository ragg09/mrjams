@extends('customerViews.layouts.customerlayout')
@section('title', 'MR. JAMS - Download')
@section('specificStyle')
    <link rel="stylesheet" href="{{asset('./css/customer/windowSize.css')}}">
@endsection
@section('content')
    <div>
        <img src="{{asset('images/mrjams/downloadSize.jpg') }}" alt="" class="center">
        <button onclick="history.back()" type="button" class="btn btn-primary mx-auto d-block" id="back_btn"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</button>
    </div>
@endsection
    
