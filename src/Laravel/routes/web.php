<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
})->name('welcome');
Route::get('logout', function () {
    Auth::logout();
    return view('auth.login');
})->name('logout');


Route::group(['prefix' => 'admin/auth/', 'middleware' => ['guest']], function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
});




Route::get('/products', function () {
    return view('pages.products.index');
});
Route::get('/products/{id}', function () {
    return view('pages.products.view');
});
Route::get('/categories', 'CategoryController@showAll');
Route::get('/categories/{id}', 'CategoryController@showOne');
Route::get('/category', 'CategoryController@showAll');
Route::get('/category/{id}', 'CategoryController@showOne');
Route::get('/cart', 'CartController@index');
Route::get('/cart/{id}', 'CartController@show');
Route::get('/contact', function () {
    return view('pages.contact');
});
Route::get('/checkout', function () {
    return view('pages.checkout');
});
Route::get('/cart', function () {
    return view('pages.cart');
});
Route::get('/about', function () {
    return view('pages.about');
});




Route::group(['prefix' => 'admin/', 'middleware' => ['auth']], function () {
    Route::get('/home', function () {
        return view('admin.home');
    })->name('dashboard');
    Route::get('/dashboard', function () {
        return view('admin.home');
    })->name('dashboard');


    // Contents routes
    Route::get('/content', 'ContentController@getAll')->name('content');
    Route::get('/content/add', function () {
        return view('pages.content.create');
    })->name('add-content');
    Route::get('/content/create', 'ContentController@create')->name('add-content');
    Route::post('/content/newContent', 'ContentController@createContent')->name('content-upload');
    Route::get('/content/{id}/edit', 'ContentController@edit')->name('edit-content');

    // Products
    Route::resource('products', 'ProductController');

    // Users
    Route::resource('users', 'UserController');

    // CONTENT CATEGORIES
    Route::get('/category', 'CategoryController@showAll')->name('category');
    Route::get('/category/add',  'CategoryController@create')->name('add-category');
    Route::get('/category/create', 'CategoryController@create')->name('add-category');
    Route::get('/category/{id}/edit',  'CategoryController@edit')->name('edit-category');
    Route::get('/category/{id}/delete',  'CategoryController@delete')->name('delete-category');
    Route::post('/category/update/edit',  'CategoryController@edit')->name('edit-category-form');
    Route::post('/category/create',  'CategoryController@addNew')->name('new-category');



    // SUBJECTS
    Route::get('/subject', 'SubjectController@showAll')->name('subject');
    Route::get('/subject/add',  'SubjectController@create')->name('add-subject');
    Route::get('/subject/create', 'SubjectController@create')->name('add-subject');
    Route::get('/subject/{id}/edit',  'SubjectController@edit')->name('edit-subject');
    Route::get('/subject/{id}/delete',  'SubjectController@delete')->name('delete-subject');
    Route::post('/subject/update/edit',  'SubjectController@edit')->name('edit-subject-form');
    Route::post('/subject/create',  'SubjectController@addNew')->name('new-subject');

    // TAGS
    Route::get('/tag', 'TagController@showAll')->name('tag');
    Route::get('/tag/add',  'TagController@create')->name('add-tag');
    Route::get('/tag/create', 'TagController@create')->name('add-tag');
    Route::get('/tag/{id}/edit',  'TagController@edit')->name('edit-tag');
    Route::get('/tag/{id}/delete',  'TagController@delete')->name('delete-tag');
    Route::post('/tag/update/edit',  'TagController@edit')->name('edit-tag-form');
    Route::post('/tag/create',  'TagController@addNew')->name('new-tag');


    Route::get('/profile', function () {
        return view('pages.profile.index');
    })->name('profile');

    Route::get('/profile/{id}/', function () {
        return view('pages.profile.index');
    })->name('view-profile');

    Route::get('/profile/{id}/edit', function () {
        return view('pages.profile.edit');
    })->name('edit-profile');
});



Auth::routes();

Route::get('/home', function(){
    if (Auth::user()->type == "admin") {
        return view('pages/admin/home');
    }else if (Auth::user()->type == "user"){
        return view('home');
    }else{
        return view('home');
    }

})->name('home');
