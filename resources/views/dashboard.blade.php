
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @include('partials.dashboard-content')

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
