<?php

namespace App\Http\Controllers;

use Cart;
use Exception;
use Input;
use Order;
use Redirect;
use Request;
use Sentry;

class AccountController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function anyIndex() {
		$data = ["user" => Sentry::getUser()];
		return view("account.dashboard",$data);
	}

	public function anyEdit() {
		if( Request::isMethod("GET") ) {

			$data = ["user" => Sentry::getUser()];
			return view("account.edit",$data);
		}
		else if( Request::isMethod("POST") ) {
			$user = Sentry::getUser();
			$errors = [];

			if(!Input::has("email")) $errors["email"] = "Email is Required";
			if(Input::get("password") !== Input::get("confirm_password")) $errors["confirm_password"] = "Passwords Must Match";

			if(!empty($errors)) {
				return Redirect::to( url("account/edit") )->withErrors($errors)->withInput();
			}
			$user = Sentry::getUser();

			$user->email = Input::get("email");
			$user->first_name = Input::get("first_name");
			$user->last_name = Input::get("last_name");

			if(Input::has("password")) {
				$user->password = Input::get("password");
			}

			$user->save();

			return Redirect::to( url("account") )->with("success_message","Your account information was successfully updated.");
		}
	}


}
