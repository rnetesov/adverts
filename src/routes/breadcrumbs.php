<?php

use App\Models\Region;
use App\Models\Category;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('register', function ($trail) {
    $trail->parent('home');
    $trail->push('Register', route('register'));
});

Breadcrumbs::for('login', function ($trail) {
    $trail->parent('home');
    $trail->push('Login', route('login'));
});

Breadcrumbs::for('cabinet.home', function ($trail) {
    $trail->parent('home');
    $trail->push('User Cabinet', route('cabinet.home'));
});

//Admin
Breadcrumbs::for('admin.home', function ($trail) {
    $trail->parent('home');
    $trail->push('Admin', route('admin.home'));
});

//Admin Users
Breadcrumbs::for('admin.users.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Users', route('admin.users.index'));
});

Breadcrumbs::for('admin.users.show', function ($trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.show', $user));
});

Breadcrumbs::for('admin.users.edit', function ($trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push(ucfirst($user->name), route('admin.users.show', $user));
    $trail->push('Edit', route('admin.users.edit', $user));
});

Breadcrumbs::for('admin.users.create', function ($trail) {
    $trail->parent('admin.users.index');
    $trail->push('Create', route('admin.users.create'));
});

//Admin Regions
Breadcrumbs::for('admin.regions.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Regions', route('admin.regions.index'));
});

Breadcrumbs::for('admin.regions.show', function ($trail, Region $region) {
    if ($parent = $region->parent) {
        $trail->parent('admin.regions.show', $parent);
    } else {
        $trail->parent('admin.regions.index');
    }
    $trail->push($region->name, route('admin.regions.show', $region));
});

Breadcrumbs::for('admin.regions.create', function ($trail, Region $region = null) {
    if ($region) {
        $trail->parent('admin.regions.show', $region);
    } else {
        $trail->parent('admin.regions.index');
    }

    $trail->push('Create', route('admin.regions.create'));
});

Breadcrumbs::for('admin.regions.edit', function ($trail, Region $region) {
    $trail->parent('admin.regions.show', $region);
    $trail->push('Edit', route('admin.regions.edit', $region));
});

//Admin Categories
Breadcrumbs::for('admin.categories.index', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Categories', route('admin.categories.index'));
});

Breadcrumbs::for('admin.categories.create', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Create', route('admin.categories.create'));
});

Breadcrumbs::for('admin.categories.show', function ($trail, Category $category) {
    if ($parent = $category->parent) {
        $trail->parent('admin.categories.show', $parent);
    } else {
        $trail->parent('admin.categories.index');
    }

    $trail->push($category->name, route('admin.categories.show', $category));
});

Breadcrumbs::for('admin.categories.edit', function ($trail, Category $category) {
    if ($parent = $category->parent) {
        $trail->parent('admin.categories.show', $parent);
    } else {
        $trail->parent('admin.categories.index');
    }

    $trail->push($category->name, route('admin.categories.show', $category));
});


