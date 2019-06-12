<?php

use App\Events\NotificationEvent;


//===========================================================================================//
//=====================================Admin Routes==========================================//
//===========================================================================================//

Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/reset', 'Admin\ResetPasswordController@reset');
Route::get('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

Route::get('admin/logout',  function ()
    {
        Auth::guard('admin')->logout();
        return redirect()->guest(route( 'admin.login' ));
    })->name('admin.logout');


Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function (){
    Route::get('/home', 'AdminController@index');
    Route::resource('/profile', 'AdminProfileController');
    //========================================================//
    Route::get('trainers/active/{id}', 'AdminTrainersController@active')->name('trainer.active');
    Route::get('trainers/deActive/{id}', 'AdminTrainersController@deActive')->name('trainer.deActive');
    Route::resource('/trainers', 'AdminTrainersController');
    //========================================================//
    Route::get('coaches/active/{id}', 'AdminCoachesController@active')->name('coach.active');
    Route::get('coaches/deActive/{id}', 'AdminCoachesController@deActive')->name('coach.deActive');
    Route::resource('/coaches', 'AdminCoachesController');
    //========================================================//
    Route::get('admin-courses/active/{id}', 'AdminCoursesController@active')->name('admin-course.active');
    Route::get('admin-courses/deActive/{id}', 'AdminCoursesController@deActive')->name('admin-course.deActive');
    Route::get('admin-courses/publish/{id}', 'AdminCoursesController@publish')->name('admin-course.publish');
    Route::get('admin-courses/unPublish/{id}', 'AdminCoursesController@unPublish')->name('admin-course.unPublish');
    Route::resource('/admin-courses', 'AdminCoursesController');
    //========================================================//
    Route::get('admin-lectures/active/{id}', 'AdminLecturesController@active')->name('admin-lecture.active');
    Route::get('admin-lectures/deActive/{id}', 'AdminLecturesController@deActive')->name('admin-lecture.deActive');
    Route::get('admin-lectures/publish/{id}', 'AdminLecturesController@publish')->name('admin-lecture.publish');
    Route::get('admin-lectures/unPublish/{id}', 'AdminLecturesController@unPublish')->name('admin-lecture.unPublish');
    Route::resource('/admin-lectures', 'AdminLecturesController');
    //========================================================//
    Route::get('admin-certificates/active/{id}', 'AdminCertificatesController@active')->name('admin-certificate.active');
    Route::get('admin-certificates/deActive/{id}', 'AdminCertificatesController@deActive')->name('admin-certificate.deActive');
    Route::resource('/admin-certificates', 'AdminCertificatesController');
    //========================================================//
    Route::get('admin-tests/active/{id}', 'AdminTestsController@active')->name('admin-test.active');
    Route::get('admin-tests/deActive/{id}', 'AdminTestsController@deActive')->name('admin-test.deActive');
    Route::resource('/admin-tests', 'AdminTestsController');
    //========================================================//
    Route::get('admin-alerts/active/{id}', 'AdminAlertsController@active')->name('admin-alert.active');
    Route::get('admin-alerts/deActive/{id}', 'AdminAlertsController@deActive')->name('admin-alert.deActive');
    Route::resource('/admin-alerts', 'AdminAlertsController');
    //========================================================//
    Route::get('admin-messages/active/{id}', 'AdminMessagesController@active')->name('admin-message.active');
    Route::get('admin-messages/deActive/{id}', 'AdminMessagesController@deActive')->name('admin-message.deActive');
    Route::resource('/admin-messages', 'AdminMessagesController');
    //========================================================//
    Route::get('admin-comments/active/{id}', 'AdminCommentsController@active')->name('admin-comment.active');
    Route::get('admin-comments/deActive/{id}', 'AdminCommentsController@deActive')->name('admin-comment.deActive');
    Route::resource('/admin-comments', 'AdminCommentsController');
    //========================================================//
    Route::get('admin-replies/active/{id}', 'AdminRepliesController@active')->name('admin-reply.active');
    Route::get('admin-replies/deActive/{id}', 'AdminRepliesController@deActive')->name('admin-reply.deActive');
    Route::resource('/admin-replies', 'AdminRepliesController');
    //========================================================//
    Route::resource('/countries', 'AdminCountriesController');
    Route::resource('/interests', 'AdminInterestsController');
    Route::resource('/admin-categories', 'AdminCategoriesController');
    Route::resource('/questions', 'AdminCommonQuestionsController');
    Route::resource('/sayings', 'AdminSayingsController');
    Route::resource('/contacts', 'AdminContactsController');
    Route::resource('/settings', 'AdminSettingsController');
    //========================================================//
    //Send email route
    Route::get('/contacts/send/{id}', [
        'uses' => 'AdminContactsController@send',
        'as' => 'send.email'
    ]);

});


//===========================================================================================//
//===================================={Website Routes}=======================================//
//===========================================================================================//
Auth::routes();

Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendVerifyEmailDone')->name('sendVerifyEmailDone');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', 'homeController@index')->name('home');
Route::get('/home', 'homeController@index')->name('home');
//==========================================================//
Route::post('/courses/join/{id}', 'WebsiteCoursesController@join')->name('courses.join');
Route::get('/courses/out/{id}', 'WebsiteCoursesController@out')->name('courses.out');
Route::get('/courses/publish/{id}', 'WebsiteCoursesController@publish')->name('course.publish');
Route::get('/courses/unPublish/{id}', 'WebsiteCoursesController@unPublish')->name('course.unPublish');
Route::get('/courses/complete/{id}', 'WebsiteCoursesController@complete')->name('course.complete');
Route::get('/courses/unComplete/{id}', 'WebsiteCoursesController@unComplete')->name('course.unComplete');
Route::post('/courses/rate', 'WebsiteCoursesController@rateCourse')->name('rate.course');
Route::resource('/courses', 'WebsiteCoursesController');
Route::resource('/categories', 'WebsiteCategoriesController');
Route::resource('/about-us', 'WebsiteAboutController');
Route::resource('/contact-us', 'WebsiteContactsController');




Route::group(['middleware' => 'auth'], function (){

    Route::resource('/password', 'WebsitePasswordsController');
    Route::resource('/my_profile', 'WebsiteProfilesController');
    Route::get('/deleteInterest/{id}', 'WebsiteProfilesController@deleteInterest')->name('deleteInterest');
    Route::post('/deleteInterests', 'WebsiteProfilesController@addInterests')->name('addInterests');
    Route::resource('/cv', 'WebsiteCvController');
    //==========================================================//
    Route::get('lectures/publish/{id}', 'AdminLecturesController@publish')->name('lectures.publish');
    Route::get('lectures/unPublish/{id}', 'AdminLecturesController@unPublish')->name('lectures.unPublish');
    //==========================================================//
    Route::resource('/lectures', 'WebsiteLecturesController');
    Route::resource('/certificates', 'WebsiteCertificatesController');
    Route::resource('/course-tests', 'WebsiteTestsController');
    Route::resource('/comments', 'WebsiteCommentsController');
    Route::resource('/replies', 'WebsiteRepliesController');
    Route::resource('/alerts', 'WebsiteAlertsController');

    //Paypall routes
    Route::get('pay/with/paypal/{id}', 'WebsiteCoursesController@payNow');
    Route::get('/paypal/done', 'WebsiteCoursesController@getDone');
    Route::get('/paypal/cancel', 'WebsiteCoursesController@getCancel');
    Route::get('finally', 'WebsiteCoursesController@finally_payment')->name('finally');
    Route::get('payout/create', 'WebsiteCoursesController@payout_create')->name('payout.create');
    Route::get('payout/submit', 'WebsiteCoursesController@payout_submit')->name('payout.submit');

});

Route::get('event', function (){
    event(new NotificationEvent('مرحبا بك معنا فى العلوم المصرية للتدريب'));
});

Route::get('listen', function (){
    return view('listenBroadcast');
});


//Search Route
Route::get('/results', function (){
    if (!empty(request('query')))
    {
        $courses = \App\Course::where('name', 'like', '%' . request('query') . '%')->get();

        return view('results')->with('courses', $courses)->with('sayings', \App\Saying::all())->with('messages', \App\Message::all());
    }
    elseif (empty(request('query')) and empty(request('coach_name')) and empty(request('course_name')) and empty(request('price')) )
    {
        \Illuminate\Support\Facades\Session::flash('info', 'من فضلك ادخل بعض البيانات للبحث عنها');
        return redirect()->back();
    }
    else
    {
        //coach only
        if (!empty(request('coach_name')) and empty(request('course_name')) and empty(request('price')))
        {
            $coach = \App\User::where('name', 'like', '%' . request('coach_name') . '%')->first();
            $courses = \App\Course::where('coach_id', 'like', '%' . $coach->id . '%')->get();
            return view('results')->with('courses', $courses)->with('sayings', \App\Saying::all())->with('messages', \App\Message::all());
        }

        //course name only
        if (!empty(request('course_name')) and empty(request('coach_name')) and empty(request('price')))
        {
            $courses = \App\Course::where('name', 'like', '%' . request('course_name') . '%')->get();
            return view('results')->with('courses', $courses)->with('sayings', \App\Saying::all())->with('messages', \App\Message::all());
        }

        //price only
        if (!empty(request('price')) and empty(request('course_name')) and empty(request('coach_name')))
        {
            $courses = \App\Course::where('price', 'like', '%' . request('price') . '%')->get();
            return view('results')->with('courses', $courses)->with('sayings', \App\Saying::all())->with('messages', \App\Message::all());
        }

        //All
        if (!empty(request('coach_name')) and !empty(request('course_name')) and !empty(request('price')))
        {
            $coach = \App\User::where('name', 'like', '%' . request('coach_name') . '%')->first();
            $courses = \App\Course::where('coach_id', 'like', '%' . $coach->id . '%')
                ->where('name', 'like', '%' . request('course_name') . '%')
                ->where('price', 'like', '%' . request('price') . '%')
                ->get();
            return view('results')->with('courses', $courses)->with('sayings', \App\Saying::all())->with('messages', \App\Message::all());
        }

        //coach & course name only
        if (!empty(request('coach_name')) and !empty(request('course_name')) and empty(request('price')))
        {
            $coach = \App\User::where('name', 'like', '%' . request('coach_name') . '%')->first();
            $courses = \App\Course::where('coach_id', 'like', '%' . $coach->id . '%')
                ->where('name', 'like', '%' . request('course_name') . '%')
                ->get();
            return view('results')->with('courses', $courses)->with('sayings', \App\Saying::all())->with('messages', \App\Message::all());
        }

        //coach & price only
        if (!empty(request('coach_name')) and empty(request('course_name')) and !empty(request('price')))
        {
            $coach = \App\User::where('name', 'like', '%' . request('coach_name') . '%')->first();
            $courses = \App\Course::where('coach_id', 'like', '%' . $coach->id . '%')
                ->where('price', 'like', '%' . request('price') . '%')
                ->get();
            return view('results')->with('courses', $courses)->with('sayings', \App\Saying::all())->with('messages', \App\Message::all());
        }

        //course name & price only
        if (empty(request('coach_name')) and !empty(request('course_name')) and !empty(request('price')))
        {
            $courses = \App\Course::where('name', 'like', '%' . request('course_name') . '%')
                ->where('price', 'like', '%' . request('price') . '%')
                ->get();
            return view('results')->with('courses', $courses)->with('sayings', \App\Saying::all())->with('messages', \App\Message::all());
        }

    }

});
   
    