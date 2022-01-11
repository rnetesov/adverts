@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.regions.show', $region) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('admin.partials.nav')

            <div class="d-flex mt-2">
                <a class="btn btn-primary mr-1" href="{{ route('admin.regions.edit', $region) }}">Edit</a>
                <a href="#"
                   onclick="confirm('You want to delete the current region') ? document.getElementById('form-delete').submit() : false"
                   class="btn btn-danger mr-1">Delete</a>
                <a href="{{ route('admin.regions.create', ['parent' => $region->id]) }}" class="btn btn-primary">Add Nested</a>

                <form action="{{ route('admin.regions.destroy', $region) }}" method="post" class="invisible"
                      id="form-delete">
                    @csrf
                    @method('delete')
                </form>
            </div>

            <table class="table table-striped mt-2 mb-2 table-bordered">
                <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $region->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $region->name }}</td>
                </tr>
                <tr>
                    <th>Slug</th>
                    <td>{{ $region->slug }}</td>
                </tr>
                </tbody>
            </table>

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
