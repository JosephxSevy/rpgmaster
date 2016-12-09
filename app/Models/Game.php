<?php

  use Jenssegers\Mongodb\Eloquent\SoftDeletes;

  class Game extends Moloquent {

    protected $connection = 'mongodb';
    protected $collection = 'game';
    protected $dates = ['created_at','updated_at','deleted_at'];

    public static function myGames($id = null) {
      if( !empty($id) ) $user = Sentry::findUserById($id);
      else $user = Sentry::getUser();

      $games = Game::whereIn("players",[(int)$user->user_id])->get();
      return $games;
    }


    public function getSlug() {
      return url( "game/play?slug=$this->slug" );
    }

    public function addAction($user_id, $action) {
      $actions = $this->actions;
      $actions[] = [
        "user_id" => (int)$user_id,
        "action"  => $action
      ];
      $this->actions = $actions;
      $this->save();
    }

    public static function generateGame( $params ) {
      $count = (int)Game::all()->count();
      $count++;
      $game = new Game;
      foreach($params as $key => $param) {
        $game->{$key} = $param;
      }
      $game->game_id = $count;

      $name = str_replace(" ", "-", $game->name);
      $game->slug = trim("$count-$name");
      $game->actions = [];
      $game->save();
      return $game;
    }
  }

?>
