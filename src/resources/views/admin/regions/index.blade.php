@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('admin.partials.nav')
            <a href="{{ route('admin.regions.create') }}" class="btn btn-success">Create</a>
            @include('admin.regions.partials.table', ['regions' => $regions])
        </div>
    </div>
@endsection

@section('styles')
    @include('admin.partials.styles')
@endsection()

@section('scripts')
    @include('admin.partials.scripts')
@endsection
