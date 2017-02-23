<?php

  use Jenssegers\Mongodb\Eloquent\SoftDeletes;

  class Game extends Moloquent {
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'game';
    protected $dates = ['created_at','updated_at','deleted_at'];

    public static function myGames($id = null) {
      if( !empty($id) ) $user = Sentry::findUserById($id);
      else $user = Sentry::getUser();

      $games = Game::whereIn("players",[(int)$user->user_id])->get();
      return $games;
    }

    public function getPlayers() {
      return ( !empty($this->players) ) ? $this->players : [];
    }

    public function getActions() {
      return ( !empty($this->actions) ) ? $this->actions : [];
    }

    public function getDice() {
      return ( !empty($this->dice) ) ? $this->dice : [];
    }

    public function getSlug() {
      return url( "game/play?slug=$this->slug" );
    }

    public function addAction($user_id, $action) {
      $actions = $this->actions;
      $actions[] = [
        "user_id"      => (int)$user_id,
        "action"       => $action,
        "roll_dice"    => false,
        "allowed_user" => "",
        "dice"         => "",
      ];
      $this->actions = $actions;
      $this->save();
    }

    public function addActionRoll($user_id, $player, $dice) {
      $actions = $this->actions;
      $actions[] = [
        "user_id"       => (int)$user_id,
        "action"        => "",
        "allowed_user"  => (int)$player,
        "roll_dice"     => true,
        "dice"          => $dice
      ];
      $this->actions = $actions;
      $this->save();
    }

    public function replaceActionRoll($user_id, $move, $actionNumber) {
      $actions = $this->actions;
      foreach ($actions as $index => $action) {
        if($index == $actionNumber) {
          $actions[$index] = [
            "user_id"      => (int)$user_id,
            "action"       => $move,
            "roll_dice"    => false,
            "allowed_user" => "",
            "dice"         => ""
          ];
        }
      }
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
