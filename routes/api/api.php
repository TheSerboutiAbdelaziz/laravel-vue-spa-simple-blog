<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/



Route::group(['prefix' => 'v1',], function(){

	Route::group(['namespace' => 'Api\V1'], function(){
		//Api Web Stories
		Route::apiResource('/stories', 'StoryController', ['only' => ['index', 'show']]);
		//Api Web Contact Us 
		Route::post('/contact-us', 'ContactUsController@send');

		Route::group(['namespace' => 'Auth'], function(){
			//Api Web Auth SignUp
			Route::post('/signup', 'SignUpController@register');
			//Api Web Auth SignIn
			Route::post('/signin', 'SignInController@login');

			Route::group(['prefix' => 'admin','middleware' => 'auth:api'], function(){
				//Api Web Auth SignOut
				Route::get('/signout', 'SignOutController@logout');				
			});

		});

	});

	Route::group([	'prefix' => 'admin',  
					'middleware' => 'auth:api'], function(){
		
		// The Current Authenticated User
		Route::get('/user', function (Request $request) {
    		return $request->user(); 
		});

		Route::group(['namespace' => 'Api\V1\Admin'], function(){
			//Api Admin Stories
			Route::apiResource('/stories', 'StoryController');
			//Api Admin Comments
			Route::apiResource('/comments', 'CommentController', ['except' => ['update', 'show']]);
			//Api Admin Users
			Route::apiResource('/users', 'UserController', ['except' => ['store', 'update', 'destroy']]);		
		});				
	
	});

});

