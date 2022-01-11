@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.categories.create') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('admin.partials.nav')
            <form action="{{ route('admin.categories.store') }}" method="post">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="title" name="name"
                           value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                           value="{{ old('slug') }}">
                    @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect2">Parent</label>
                    <select class="form-control  @error('parent') is-invalid @enderror" id="categories" name="parent" >
                        <option value="">As root</option>
                        @foreach($categories as $category)
                            <option {{ old('parent') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                                {!! str_repeat('&nbsp;', $category->depth * 4) !!}
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
@endsection
