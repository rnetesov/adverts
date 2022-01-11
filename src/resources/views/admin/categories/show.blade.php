@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.categories.show', $category) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('admin.partials.nav')
            <div class="d-flex mt-2">
                <a class="btn btn-primary mr-1" href="{{ route('admin.categories.edit', $category) }}">Edit</a>

                <a href="#"
                   onclick="confirm('You want to delete the current category') ? document.getElementById('form-delete').submit() : false"
                   class="btn btn-danger">Delete</a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="post" class="invisible"
                      id="form-delete">
                    @csrf
                    @method('delete')
                </form>
            </div>
            <table class="table table-striped mt-2 table-bordered">
                <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <th>Slug</th>
                    <td>{{ $category->slug }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
