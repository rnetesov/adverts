<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Region\CreateRequest;
use App\Http\Requests\Admin\Region\UpdateRequest;
use App\Models\Region;
use Illuminate\Http\Request;
use Str;
use function flash;
use function redirect;
use function view;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin-panel');
    }

    public function index(Request $request)
    {
        $regions = $this->getRegions($request);
        return view('admin.regions.index', compact('regions'));
    }

    public function create(Request $request)
    {
        $parent = null;

        if ($request->get('parent')) {
            $parent = Region::findOrFail($request->get('parent'));
        }

        return view('admin.regions.create', compact('parent'));
    }

    public function store(CreateRequest $request)
    {
        $region = Region::create([
            'name' => $request['name'],
            'slug' => $request['slug'] ?? Str::slug($request['name']),
            'parent_id' => $request['parent']
        ]);
        flash()->success('Region was success created');
        return redirect()->route('admin.regions.show', $region);
    }

    public function show(Request $request, Region $region)
    {
        $regions = $this->getRegions($request, $region);
        return view('admin.regions.show', compact('region', 'regions'));
    }

    public function edit(Region $region)
    {
        return view('admin.regions.edit', compact('region'));
    }

    public function update(UpdateRequest $request, Region $region)
    {
        $region->update([
            'name' => $request['name'],
            'slug' => $request['slug'] ?? \Str::slug($request['name']),
            'parent_id' => $region->parent_id
        ]);
        flash()->info('Region was success updated');
        return redirect()->route('admin.regions.show', $region);
    }

    public function destroy(Region $region)
    {
        $region->delete();
        flash()->info('Region was success deleted');
        return redirect()->route('admin.regions.index');
    }

    protected function getRegions(Request $request, Region $region = null)
    {
        if ($region) {
            $query = $region->children();
        } else {
            $query = Region::where('parent_id', null);
        }

        if (!empty($id = $request['id'])) {
            $query->where('id', $id);
        }

        if (!empty($name = $request['name'])) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if (!empty($slug = $request['slug'])) {
            $query->where('slug', 'like', '%' . $slug . '%');
        }

        if (!empty($sort = $request['sort'])) {
            $query->orderBy($sort, $request['order'] ?: 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        return $query->get();
    }
}
