@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('admin.partials.nav')
            <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-2">Create</a>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th style="width:11%">Action</th>
                </tr>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            {!! str_repeat('&nbsp; ', $category->depth * 4) !!}
                            <a href="{{ route('admin.categories.show', $category) }}">
                               {{ $category->name }}
                            </a>
                        </td>
                        <td>
                            {{ $category->slug }}
                        </td>
                        <td>
                            <form action="{{ route('admin.categories.first', $category) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('patch')
                                <button href="#" class="badge badge-primary p-1" type="submit">
                                    <i class="fas fa-angle-double-up"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.categories.up', $category) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('patch')
                                <button href="#" class="badge badge-primary p-1" type="submit">
                                    <i class="fas fa-angle-up"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.categories.down', $category) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('patch')
                                <button href="#" class="badge badge-primary p-1" type="submit">
                                    <i class="fas fa-angle-down"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.categories.last', $category) }}" method="post" class="d-inline-block">
                                @csrf
                                @method('patch')
                                <button href="#" class="badge badge-primary p-1" type="submit">
                                    <i class="fas fa-angle-double-down"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

@section('styles')
    @include('admin.partials.styles')
@endsection()

@section('scripts')
    @include('admin.partials.scripts')
@endsection
