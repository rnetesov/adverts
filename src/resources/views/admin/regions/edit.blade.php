@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.regions.edit', $region) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.regions.update', $region) }}" method="post">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                           value="{{ $region->name }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                           value="{{ $region->slug }}">
                    @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

{{--                <div class="form-group">--}}
{{--                    <label for="parent">Parent</label>--}}
{{--                    <select class="form-control @error('parent') is-invalid @enderror" id="parent" name="role">--}}
{{--                        @foreach($categories as $category)--}}
{{--                            <option value=""></option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                    @error('role')--}}
{{--                    <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--                </div>--}}

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
