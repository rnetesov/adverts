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
            <a href="{{ route('admin.users.create') }}" class="btn btn-success mt-2">Create</a>
            <form action="" method="get">
                <table class="table table-striped mt-2 table-bordered">
                    <thead>
                    <tr>
                        @php($order = request('order') == 'asc' ? 'desc' : 'asc')
                        <th style="width: 8%" class="text-center">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'id','order' => $order]) }}"> ID
                                <i class="fas fa-sort"></i>
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'name','order' => $order]) }}"> Name
                                <i class="fas fa-sort"></i>
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'email','order' => $order]) }}"> Email
                                <i class="fas fa-sort"></i>
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'status','order' => $order]) }}"> Status
                                <i class="fas fa-sort"></i>
                            </a>
                        </th>
                        <th>
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'role','order' => $order]) }}"> Role
                                <i class="fas fa-sort"></i>
                            </a>
                        </th>
                    </tr>
                    <tr class="filter">
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control @error('id') is-invalid @enderror" name="id"
                                       min="1" value="{{ request('id') }}">
                                @error('id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ request('name') }}">
                                @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ request('email') }}">
                                @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="form-group">
                                    <select class="form-control" name="status">
                                        <option value=""></option>
                                        @foreach($statuses as $k => $v)
                                            <option {{ (request('status') == $k) ? 'selected' : '' }} value="{{ $k }}">
                                                {{ $v }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <select class="form-control" name="role">
                                    <option value=""></option>
                                    @foreach($roles as $k => $v)
                                        <option {{ (request('role') == $k) ? 'selected' : '' }} value="{{ $k }}">
                                            {{ $v }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                    </tr>

                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center">{{ $user->id }}</td>
                            <td><a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->isActive())
                                    <span class="badge badge-primary">Active</span>
                                @endif

                                @if ($user->isWait())
                                    <span class="badge badge-secondary">Waiting</span>
                                @endif
                            </td>
                            <td>
                                @if ($user->isAdmin())
                                    <span class="badge badge-danger">Admin</span>
                                @endif

                                @if ($user->isUser())
                                    <span class="badge badge-warning">User</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>

            {{ $users->withQueryString()->links() }}

        </div>
    </div>
@endsection

