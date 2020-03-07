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


Route::prefix('{lang?}/admin')->attribute('namespace', 'Admin')->group(function () {
    Route::post('/attempt', ['uses' => 'AuthController@attempt', 'as' => 'admin.auth.attempt']);
    Route::get('/logout', ['uses' => 'AuthController@logout', 'as' => 'admin.auth.logout']);
    Route::get('/login', ['uses' => 'AuthController@login', 'as' => 'admin.auth.login']);
});

Route::prefix('{lang?}/admin')->attribute('namespace', 'Admin')->middleware('auth:web')->group(function () {
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'admin.home.index']);
    Route::resource('locations', 'LocationsController', ['as' => "admin"]);
    Route::resource('cities', 'CitiesController', ['as' => "admin"]);
    Route::resource('blog', 'BlogController', ['as' => 'admin']);
    Route::resource('industries', 'IndustryController', ['as' => 'admin']);
    Route::resource('jobs', 'HomeJobsController', ['as' => 'admin']);
    Route::get('seekers/import', ['uses' => 'SeekerController@import', 'as' => 'admin.seekers.import']);
    Route::post('seekers/import', ['uses' => 'SeekerController@storeImport', 'as' => 'admin.seekers.store.import']);
    Route::get('seeker/{user}/logs', ['uses' => 'SeekerController@logs', 'as' => 'admin.seeker.logs']);
    Route::resource('seekers', 'SeekerController', ['as' => 'admin']);
    Route::prefix("/seeker/{seeker}")->group(function () {
        Route::resource("details", "SeekerDetailsController", ['as' => "admin.seeker"])
            ->parameter('details', 'seekerDetails');

        Route::resource("experiences", "SeekerExperiencesController", ['as' => "admin.seeker"])
            ->parameter('experiences', 'seekerExperiences');
    });

    Route::resource('logs', 'LogsController', ['as' => 'admin']);
    Route::resource('agencies', 'AgenciesController', ['as' => 'admin']);
    Route::prefix("/industry/{industry}")->group(function () {
        Route::resource("roles", "RoleController", ['as' => "admin.industry"]);
    });
    Route::get('employer/{employer}/logs', ['uses' => 'EmployerController@logs', 'as' => 'admin.employer.logs']);
    Route::resource('employers', 'EmployerController', ['as' => 'admin']);
    Route::prefix("/employer/{employer}")->group(function () {
        Route::resource("details", "EmployerDetailsController", ['as' => "admin.employer"])
            ->parameter('details', 'employerDetails');
    });
    Route::resource('groups', 'GroupController', ['as' => 'admin']);
    Route::resource('permissions', 'PermissionController', ['as' => 'admin']);
    Route::resource('users', 'UserController', ['as' => 'admin']);

    Route::prefix("/users/{user}")->group(function () {
        Route::resource("groups", "UserGroupsController", ['as' => "admin.users"]);
    });

    Route::prefix('/group/{group}')->group(function () {
        Route::resource('permissions', 'GroupPermissionController', ['as' => "admin.group"])
            ->parameter('permissions', 'groupPermission');
    });
});


Route::prefix('{lang?}')->attribute('namespace', 'Web')->group(function () {
    Route::get('/', function () {
        return redirect(route('web.home.index'));
    });
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'web.home.index']);
    Route::post('/attempt', ['uses' => 'AuthController@attempt', 'as' => 'web.auth.attempt']);
    Route::get('/logout', ['uses' => 'AuthController@logout', 'as' => 'web.auth.logout']);
    Route::get('/login', ['uses' => 'AuthController@login', 'as' => 'web.auth.login']);
    Route::get('/register', ['uses' => 'AuthController@register', 'as' => 'web.auth.register']);

//    Route::get('/password/reset', ['uses' => 'AuthController@reset', 'as' => 'password.reset']);
    Route::post('/register', ['uses' => 'AuthController@registerAction', 'as' => 'web.auth.register']);
    Route::get('/password/reset', ['uses' => 'AuthController@reset', 'as' => 'password.reset']);
    Route::get('/type', ['uses' => 'AuthController@type', 'as' => 'web.type']);
    Route::get('/emailValidation', 'AuthController@emailValidation')->name('web.validation');

    Route::resource('seekers', 'SeekerController', ['as' => 'web']);

//    Route::post('/password/reset', ['uses' => 'AuthController@sendReset', 'as' => 'web.auth.reset.send']);
//    Route::post('/password/reset/confirm', ['uses' => 'AuthController@resetPassword', 'as' => 'web.auth.reset.confirm']);


    Route::get('/messages_user', ['uses' => 'ChatsController@messagesUser', 'as' => 'web.chat.messages_user']);

    Route::get('/add_message', ['uses' => 'ChatsController@addMessage', 'as' => 'web.chat.add_message']);

    Route::get('/sent_messages', ['uses' => 'ChatsController@sent_messages', 'as' => 'web.chat.sent_messages']);

    Route::get('/message', ['uses' => 'ChatsController@message', 'as' => 'web.chat.message']);


    Route::get('/register/personal-info', ['uses' => 'SeekerController@personalInfo', 'as' => 'web.seeker.personal.info']);
    Route::post('/personal-info/store', ['uses' => 'SeekerController@storePersonalData', 'as' => 'web.seeker.store.personal.info']);
    Route::get('/register/job-info', ['uses' => 'SeekerController@jobInfo', 'as' => 'web.seeker.register.job.info']);
    Route::post('/job-info/store', ['uses' => 'SeekerController@storeJobData', 'as' => 'web.seeker.store.job.info']);
    Route::get('/register/experiences-info', ['uses' => 'SeekerController@experiencesInfo', 'as' => 'web.seeker.experiences.info']);

    Route::get('/my-profile', 'UserController@myProfile')->name('web.users.myProfile');
    Route::get('/profile/edit', 'UserController@myProfile')->name('profile.edit');

});

Route::prefix('{lang?}/owner')->attribute('namespace', 'Owner')->middleware('owner:web')->group(function () {
//Route::prefix('{lang?}/owner')->attribute('namespace', 'Owner')->group(function () {
    Route::post('addSeekerToJob', 'JobController@addSeekerToJob')->name('owner.addSeekerToJob');

    Route::prefix("/users/{user}")->group(function () {
        Route::get('search/{job}', 'JobController@SeekerSearch')->name('owner.users.jobs.SeekerSearch');
        Route::resource('jobs', 'JobController', ['as' => 'owner.users']);
        Route::resource('companies', 'EmployerDetailsController', ['as' => "owner.users"])
            ->parameter('companies', 'employerDetails');
    });

//    Route::prefix('/users/{employer}')->attribute('namespace', 'Owner')->group(function () {
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'owner.home.index']);


//    });
});







