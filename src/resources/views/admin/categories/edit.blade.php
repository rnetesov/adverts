@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.categories.edit', $category) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('admin.partials.nav')
            <form action="{{ route('admin.categories.update', $category) }}" method="post">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                           value="{{ $category->name }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slug">slug Address</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                           value="{{ $category->slug }}">
                    @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect2">Parent</label>
                    <select class="form-control  @error('parent') is-invalid @enderror" id="categories" name="parent" >
                        <option value="">As root</option>
                        @php($current = $category)
                        @foreach($categories as $category)
                            <option {{ ($current->parent_id == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">
                                {!! str_repeat('&nbsp;', $category->depth * 4) !!}
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
