<?php

  use Jenssegers\Mongodb\Eloquent\SoftDeletes;

  class Character extends Moloquent {
    use SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'character';
    protected $dates = ['created_at','updated_at','deleted_at'];

    public static function myCharacters($id = null) {
      if( !empty($id) ) $user = Sentry::findUserById($id);
      else $user = Sentry::getUser();

      $characters = [];
      if ( !empty($user) ) {
      foreach($user->characters as $character) {
        $char = Character::where("character_id", "=" ,(int)$character)->first();
        $char->race = Race::getMyName($char->race);
        $char->class = Cls::getMyName($char->class);
        $characters[] = $char;
      }
    }
    return $characters;
    }

    public static function generateCharacter( $params ) {
      $count = (int)Character::all()->count();
      $count++;
      $character = new Character;
      foreach($params as $key => $param) {
        $character->{$key} = $param;
      }
      $character->character_id = $count;
      $character->save();
      return $character;
    }

    public static function modifyCharacter( $id, $params ) {
      try {
        $character = Character::where("character_id", "=", (int)$id)->first();
        if( empty($character) ) throw new Exception("Character doesn't exist");
        foreach($params as $key => $param) {
          $character->{$key} = $param;
        }
        $character->save();
        return $character;
      }
      catch(Exception $e) {
        throw $e;
      }
    }
  }
?>
