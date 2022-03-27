@extends('clinicViews.layouts.settings')
@section('title', 'Settings')
@section('extraStyle')

@endsection

@section('content')
    @include('clinicViews.settings.details')
    @include('clinicViews.settings.timedate')
    @include('clinicViews.settings.preferences')

    @include('clinicViews.settings.specialists')
        @include('clinicViews.settings.specialists_create_modal')
        @include('clinicViews.settings.specialists_edit_modal')
        @include('clinicViews.settings.specialists_delete_modal')
@endsection

@section('js_script')
    <script src="{{ URL::asset('js/clinic/settings/settings.js') }}"></script>
    <script src="{{ URL::asset('js/clinic/settings/details.js') }}"></script>
    <script src="{{ URL::asset('js/clinic/settings/specialists.js') }}"></script>
@endsection
   