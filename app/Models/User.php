<?php

  class User extends Moloquent {

    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $dates = ['created_at','updated_at','deleted_at'];


    public static function getAll() {
      return User::all();
    }


    public static function isGM($game_id, $user_id = null) {
      if( !empty($user_id) ) $user = Sentry::findUserById($user_id);
      else $user = Sentry::getUser();

      $game = Game::where("game_id", "=", (int)$game_id)->first();

      return ($user->user_id ==  $game->gm) ;
    }

    public function getName() {
      return "$this->first_name $this->last_name";
    }

    public static function getMyName($user_id = null) {
      if( !empty($user_id) ) $user = User::where("user_id", "=", (int)$user_id)->first();
      else $user = Sentry::getUser();
      return "$user->first_name $user->last_name";
    }

  }
?>
