<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatusesController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function() {
    return '<h1>Home Page</h1>';
})->name('home');

Route::get('about', function() {
    return '<a href= "'.route('home').'">Go to home</a> ';
});

Route::get('search/{id}', function($id) {
    return '<a href= "'.route('user', $id).'">You want to search ID: '.$id.' </a> ';
});

Route::group(['prefix' => 'user'], function() {
    Route::get('/', function() {
        return 'User Page';
    });

    Route::get('/{id}', function($id) {
        return 'User: ' . $id;
    });

    Route::get('/{id}/{name}', function($id, $name) {
        return 'User: ' . $id . ' ' . $name;
    });
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', function(){
        return 'Admin Page';
    });

    Route::get('/dashboard', function() {
        return 'Admin Dashboard 1';
    });

    Route::get('/settings', function() {
        return 'Admin Settings';
    });

    // Route::get('/profile', function(){
    //     return view('admin.adminProfile', ['name' => 'Ralph']);
    // });

    // Route::get('/profile/{id}', function($id){
    //     $name = "Ralph";
    //     return view('admin.adminProfile', compact('id', 'name'));
    // });

    Route::get('/profile', [BlogController::class, 'index']);
});

Route::get('exercise', function() {
    return view('exercise');
});

Route::fallback(function() {
    //return redirect()->route('home');
    return '<img src="https://www.elegantthemes.com/blog/wp-content/uploads/2020/02/000-404.png">';
});

Route::get('/login', [LoginController::class, 'retrieveLogin']);

Route::post('/login', [LoginController::class, 'handleLogin'])->name('login.submit');

Route::get('categories', [CategoryController::class, 'index']);

Route::group(['prefix' => 'blog'], function() {
    Route::get('/', [BlogController::class, 'createBlogIndex'])->name('blog.index');
    Route::post('/create', [BlogController::class, 'createBlog'])->name('blog.create');
    Route::get('/get', [BlogController::class, 'getBlog']);
    Route::get('/update', [BlogController::class, 'updateBlog']);
    Route::get('/model', [BlogController::class, 'blogModel']);
    Route::get('/hasOne', [BlogController::class, 'oneToOneRel']);
    Route::get('/hasMany', [BlogController::class, 'oneToManyRel']);
    Route::get('/many', [BlogController::class, 'manyToManyRel']);
    Route::get('/insertTags', [BlogController::class, 'insertTags']);
});

Route::get('statuses', [StatusesController::class, 'index']);

Route::group(['prefix' => 'blogs'], function() {
    Route::get('/', [BlogController::class, 'retrieveBlogs'])->name('blogs.index');
    Route::get('/{id}', [BlogController::class, 'retrieveBlogPage']); 
    Route::delete('/{id}/delete', [BlogController::class, 'softDeleteBlogPage'])->name('blogs.softDelete');
    Route::patch('/{id}/restore', [BlogController::class, 'restoreBlogPage'])->name('blogs.restore');
    Route::post('/{blog}/comment', [BlogController::class, 'postComment'])->name('blogs.comment');
});