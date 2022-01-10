<form action="{{ url()->current() }}" method="get">
    <table class="table table-striped mt-2 table-bordered">
        <thead>
        <tr>
            <th style="width: 8%" class="text-center">
                @php($order = request('order') == 'asc' ? 'desc' : 'asc')
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'id','order' => $order]) }}"> ID
                    <i class="fas fa-sort"></i>
                </a>
            </th>
            <th>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'name','order' => $order]) }}">Name
                    <i class="fas fa-sort"></i>
                </a>
            </th>
            <th>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'slug','order' => $order]) }}">Slug
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
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                           value="{{ request('slug') }}">
                    @error('slug')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </td>
        </tr>

        </thead>
        <tbody>
        @foreach($regions as $region)
            <tr>
                <td class="text-center">{{ $region->id }}</td>
                <td><a href="{{ route('admin.regions.show', $region) }}">{{ $region->name }}</a></td>
                <td>{{ $region->slug }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
