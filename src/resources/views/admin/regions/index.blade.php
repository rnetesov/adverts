@extends('layouts.app')

@section('styles')
    @include('admin.partials.styles')
@endsection()

@section('scripts')
    @include('admin.partials.scripts')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.nav')
            <a href="{{ route('admin.regions.create') }}" class="btn btn-success mt-2">Create</a>
            @include('admin.regions.partials.table', ['regions' => $regions])
        </div>
    </div>
@endsection


