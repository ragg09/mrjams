@extends('clinicViews.layouts.settings')
@section('title', 'Settings')
@section('extraStyle')
<style>
    #clinic_rating{
        border: 1px solid red;
        width: 300px;
        float: right !important;
    }
</style>
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
   