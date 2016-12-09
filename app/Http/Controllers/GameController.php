<?php

namespace App\Http\Controllers;

use Input;
use Redirect;
use Request;

use Game;
use User;
use Sentry;

class GameController extends Controller {

  public function __construct() {
    $this->middleware('auth');
  }

  public function anyIndex() {
    $data = [
      "games" => Game::myGames(),
    ];
    return view('game.index',$data);
  }

  public function anyPlay() {
    if( Request::isMethod("GET") ) {
      $slug = Input::get("slug");
      $data = [
        "game" => Game::where("slug","=",$slug)->first()
      ];
      return view("game.play", $data);
    }
    else if( Request::isMethod("POST") ) {
      if(!Input::get('action')) $errors["class"] = "Action is Required";

      if( !empty($errors) ) return Redirect::to( url('game/play?slug=' . Input::get("slug") ) )->withErrors($errors)->withInput();
      $game = Game::where("slug", "=", Input::get("slug") )->first();
      $user = Sentry::getUser();
      $game->addAction($user->user_id, Input::get("action") );
      return Redirect::to('game/play?slug=' . Input::get("slug") )->with("success_message", "Move Add succesfully");
    }
  }

  public function anyNew() {
    if( Request::isMethod("GET") ) {
        $data = [
          "users" => User::getAll()
        ];
        return view('game.new', $data);
    }
    else if( Request::isMethod("POST") ) {

      $errors = [];
      if(!Input::get('name')) $errors["name"] = "Name is Required";

      if( !empty($errors) ) return Redirect::to( url('game/new') )->withErrors($errors)->withInput();

      $players = array_unique( Input::get("players") );
      foreach ($players as $index => $player) {
        $players[$index] = (int)$player;
      }

      $user = Sentry::getUser();

      $game = Game::generateGame([
        "name"    => Input::get("name"),
        "gm"      => $user->user_id,
        "players" => $players
      ]);

      return Redirect::to('game')->with("success_message", "Game was created success");
    }
  }

  public function anyEdit() {
    if( Request::isMethod("GET") ) {
        return view('game.new');
    }
    else if( Request::isMethod("POST") ) {

      $errors = [];
      if(!Input::get('class')) $errors["class"] = "Class is Required";
      if(!Input::get('race')) $errors["race"] = "Race is Required";
      if(!Input::get('name')) $errors["name"] = "Name is Required";

      if( !empty($errors) ) return Redirect::to( url('character/new') )->withErrors($errors)->withInput();


      return Redirect::to('game')->with("success_message","Game was created success");
    }
  }

}
