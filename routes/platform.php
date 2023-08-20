<?php

declare(strict_types=1);

use App\Orchid\Screens\Author\AuthorEditScreen;
use App\Orchid\Screens\Author\AuthorListScreen;
use App\Orchid\Screens\Book\BookEditScreen;
use App\Orchid\Screens\Book\BookListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\Section\SectionEditScreen;
use App\Orchid\Screens\Section\SectionListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

Route::middleware('access_to_admin_panel')->group(function () {
// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

Route::screen('book', BookListScreen::class)
    ->name('platform.book')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->push(__('Books'), route('platform.book')));

Route::screen('book/{book}/edit', BookEditScreen::class)
    ->name('platform.book.edit')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.book')
        ->push(__('Book Edit'), route('platform.book')));

Route::screen('book/create', BookEditScreen::class)
    ->name('platform.book.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.book')
        ->push(__('Book Create'), route('platform.book')));

Route::screen('author', AuthorListScreen::class)
    ->name('platform.author')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->push(__('Authors'), route('platform.author')));

Route::screen('author/{author}/edit', AuthorEditScreen::class)
    ->name('platform.author.edit')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.author')
        ->push(__('Author Edit'), route('platform.author')));

Route::screen('author/create', AuthorEditScreen::class)
    ->name('platform.author.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.author')
        ->push(__('Author Create'), route('platform.author')));

Route::screen('section', SectionListScreen::class)
    ->name('platform.section')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->push(__('Sections'), route('platform.section')));

Route::screen('section/{section}/edit', SectionEditScreen::class)
    ->name('platform.section.edit')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.section')
        ->push(__('Section Create'), route('platform.section')));

Route::screen('section/create', SectionEditScreen::class)
    ->name('platform.section.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.section')
        ->push(__('Section Create'), route('platform.section')));
});
