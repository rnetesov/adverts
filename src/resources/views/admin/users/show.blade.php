@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.users.show', $user) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('admin.partials.nav')
            <div class="d-flex mt-2">
                <a class="btn btn-primary mr-1" href="{{ route('admin.users.edit', $user) }}">Edit</a>
                @if($user->isWait())
                    <a href="#" onclick="document.getElementById('form-verify').submit()" class="btn btn-success mr-1">Verify</a>
                    <form action="{{ route('admin.users.verify', $user) }}" method="post" class="invisible"
                          id="form-verify">
                        @csrf
                        @method('patch')
                    </form>
                @endif

                <a href="#"
                   onclick="confirm('You want to delete the current user') ? document.getElementById('form-delete').submit() : false"
                   class="btn btn-danger">Delete</a>
                <form action="{{ route('admin.users.destroy', $user) }}" method="post" class="invisible"
                      id="form-delete">
                    @csrf
                    @method('delete')
                </form>
            </div>
            <table class="table table-striped mt-2 table-bordered">
                <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if ($user->isActive())
                            <span class="badge badge-primary">Active</span>
                        @endif

                        @if ($user->isWait())
                            <span class="badge badge-secondary">Waiting</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>
                        @if ($user->isAdmin())
                            <span class="badge badge-danger">Admin</span>
                        @endif

                        @if ($user->isUser())
                            <span class="badge badge-warning">User</span>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
