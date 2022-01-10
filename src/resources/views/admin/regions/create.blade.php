@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.regions.create', $parent) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.partials.nav')
            <form action="{{ route('admin.regions.store', ['parent' => $parent ? $parent->id : null]) }}" method="post">
                @csrf
                @method('post')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                           value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                           value="{{ old('slug') }}">
                    @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
@endsection
