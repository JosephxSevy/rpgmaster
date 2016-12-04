<?php

namespace App\Http\Controllers;

use AddressBook;
use Cart;
use Config;
use Exception;
use Input;
use Mail;
use Redirect;
use Response;
use Request;
use Sentry;
use Session;
use Stripe;

class AuthController extends Controller {

	public function anyIndex() {
		return Redirect::to( url("auth/register") );
	}

	public function anyLogout() {
		if(Sentry::check()){
			Sentry::logout();
		}
		Session::forget("cart_id");
		return Redirect::to( url("/") );
	}

	public function anyForgot() {
		if( Request::isMethod("GET") ) {
			$data = [];
			return view("auth.forgot",$data);
		}
		else if( Request::isMethod("POST") ) {
			$errors = [];
			if( !Input::has("email") ) $errors["email"] = "Email is Required";
			if( !empty($errors) )  return Redirect::to( url("auth/register") )->withInput()->withErrors($errors);

			$user = Sentry::findUserByLogin( Input::get("email") );
			$reset_code = $user->getResetPasswordCode();

			$info=["email" => $user->email,"name" => $user->first_name." ".$user->last_name];

			Mail::send('emails.reset', ["token" => $reset_code,"info" => $info], function($message) use($info) {
			    $message->to($info["email"], $info["name"])->subject('Password Reset');
			});

			return Redirect::to( url("auth/login") )->with("success_message","Reminder Email Sent. Please Check Your Email.");

		}
	}

	public function anyReset() {
		if( Request::isMethod("GET") ) {
			$data = [];
			return view("auth.reset",$data);
		}
		else if( Request::isMethod("POST") ) {
			$code = Input::get("token");
			$user = Sentry::findUserByLogin( Input::get("email") );
			if( $user->attemptResetPassword($code, Input::get("password")) ) {
				return Redirect::to( url("auth/login") )->with("success_message","Password was Successfully Reset. Please Login to Continue.");
			}
				return Redirect::to( url("auth/login") )->with("success_message","Your Token has Expired. Please Try Again.");
		}
	}

	// public function anyRegister() {
	//
	// 	if( Request::isMethod("GET") ) {
	// 		$data = [];
	// 		return view("auth.register",$data);
	// 	}
	//
	// 	else if( Request::isMethod("POST") ) {
	//
	//
	// 		$errors = [];
	//
	// 		if(!Input::has("first_name")) $errors["first_name"] = "First Name is Required";
	// 		if(!Input::has("last_name")) $errors["last_name"] = "Last Name is Required";
	// 		if(!Input::has("email")) $errors["email"] = "Email is Required";
	// 		if(!Input::has("password")) $errors["email"] = "Password is Required";
	// 		if(Input::get("email") !== Input::get("confirm_email")) $errors["confirm_email"] = "Emails Must Match";
	// 		if(Input::get("password") !== Input::get("confirm_password")) $errors["confirm_password"] = "Passwords Must Match";
	//
	// 		if( !empty($errors) )  return Redirect::to( url("auth/register") )->withInput()->withErrors($errors);
	//
	//
	// 		$user = Sentry::register([
	// 			'email' => Input::get('email'),
	// 			'first_name' => Input::get('first_name'),
	// 			'last_name'  => Input::get('last_name'),
	// 			'phone'  => Input::get('phone'),
	// 			'password'   => Input::get('password'),
	// 			"stripe_id"  => $customer["id"],
	// 			],
	// 			true);
	//
	// 			AddressBook::createMe([
	// 				"user_id"  => $user->id,
	// 				"addresses" => [
	// 					[
	// 						"first_name" => Input::get("first_name"),
	// 						"last_name" => Input::get("last_name"),
	// 						"address_1" => Input::get("address_1"),
	// 						"address_2" => Input::get("address_2"),
	// 						"city" => Input::get("city"),
	// 						"state" => Input::get("state"),
	// 						"country" => Input::get("country"),
	// 						"phone" => Input::get("phone"),
	// 						"zip" => Input::get("zip"),
	// 					]
	// 				]
	// 			]);
	//
	// 			Mail::send('emails.welcome', ['key' => 'value'], function($message)use($user) {
	// 		    $message->to($user->email, "$user->first_name $user->last_name")->subject('Welcome!');
	// 		});
	//
	// 		return Redirect::to( url("auth/login") )->with("success_message","Account Created Login to Continue.");
	// 	}
	// }

	public function anyLogin() {
		if ( Sentry::check() ) return Redirect::to('account');

		if( Request::isMethod("GET") ) {
			$data = [];
			return view("auth.login",$data);
		}
		else if( Request::isMethod("POST") ) {
	    try {

	      $credentials = [
	        'email' => Input::get('email'),
	        'password' => Input::get('password')
	      ];

	      $user = Sentry::authenticate($credentials, Input::has('remember_me'));

	      return Redirect::intended( url("game") );

	    }
	    catch (\Cartalyst\Sentry\Users\LoginRequiredException $e) {
	      return Redirect::to('auth/login')->withInput()->withErrors(['email' => 'Email field is required.']);
	    }
	    catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e) {
	      return Redirect::to('auth/login')->withInput()->withErrors(['password' => 'Password field is required.']);
	    }
	    catch (\Cartalyst\Sentry\Users\WrongPasswordException $e) {
	      return Redirect::to('auth/login')->withInput()->with('error_message', 'Wrong username or password.');
	    }
	    catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
	      return Redirect::to('auth/login')->withInput()->with('error_message', 'Wrong username or password.');
	    }
	    catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e) {
	      return Redirect::to('auth/login')->withInput()->with('warning_message', 'Your account has not been activated yet.');
	    }
	    catch (Exception $e) {
	      return Redirect::to('auth/login')->with('warning_message', "Sorry There has been an Unknown Error. Please Try again later.");
	    }
		}
	}


}
