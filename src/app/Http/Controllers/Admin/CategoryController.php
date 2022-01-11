<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\CreateRequest;
use App\Http\Requests\Admin\Categories\UpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin-panel');
    }

    public function index()
    {
        $categories = $this->getCategories();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->getCategories();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(CreateRequest $request)
    {
        $category = Category::create([
            'name' => $request['name'],
            'slug' => $request['slug'] ?: \Str::slug($request['name']),
            'parent_id' => $request['parent']
        ]);
        flash()->info('Category was success created');
        return redirect()->route('admin.categories.show', $category);
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $categories = $this->getCategories();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $category->update([
            'name' => $request['name'],
            'slug' => $request['slug'] ?: \Str::slug($request['name']),
            'parent_id' => $request['parent']
        ]);

        flash()->info('Category success updated');
        return redirect()->route('admin.categories.show', $category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        flash()->info('Category was success deleted');
        return redirect()->route('admin.categories.index');
    }

    public function up(Category $category)
    {
        $category->up();
        return redirect()->route('admin.categories.index');
    }

    public function down(Category $category)
    {
        $category->down();
        return redirect()->route('admin.categories.index');
    }

    public function first(Category $category)
    {
        if ($first = $category->siblings()->defaultOrder()->first()) {
            $category->insertBeforeNode($first);
        }

        return redirect()->route('admin.categories.index');
    }

    public function last(Category $category)
    {
        if ($last = $category->siblings()->defaultOrder('desc')->first()) {
            $category->insertAfterNode($last);
        }
        return redirect()->route('admin.categories.index');
    }

    protected function getCategories()
    {
        return Category::withDepth()->defaultOrder()->get();
    }

}
