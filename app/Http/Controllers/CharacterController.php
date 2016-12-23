<?php

namespace App\Http\Controllers;

use Input;
use Redirect;
use Request;
use Sentry;
use URL;

use Character;
use Race;
use Cls;

class CharacterController extends Controller {

  public function anyIndex() {
    $data = [
      "characters" => Character::myCharacters()
    ];
    return view('character.index', $data);
  }

  public function anyNew() {
    if( Request::isMethod("GET") ) {
      $data = [
        "races"   => Race::getList(),
        "classes" => Cls::getList()
      ];
      return view('character.new', $data);
    }
    else if(Request::isMethod("POST")) {
      $user = Sentry::getUser();

      $errors = [];
      if(!Input::get('class')) $errors["class"] = "Class is Required";
      if(!Input::get('race')) $errors["race"] = "Race is Required";
      if(!Input::get('name')) $errors["name"] = "Name is Required";
      if(!Input::get('race_skill')) $errors["race_skill"] = "Race skill is Required";
      if(!Input::get('class_skill')) $errors["class_skill"] = "Class skill is Required";

      $stats = [
        "strength"      => Input::get("strength"),
        "dexterity"     => Input::get("dexterity"),
        "charisma"      => Input::get("charisma"),
        "intelligence"  => Input::get("intelligence"),
        "wisdom"        => Input::get("wisdom"),
        "constitution"  => Input::get("constitution")
      ];

      $total = (int)$stats["strength"] + (int)$stats["dexterity"] + (int)$stats["charisma"] + (int)$stats["intelligence"] + (int)$stats["wisdom"] + (int)$stats["constitution"];

      if( $total != 2 ) $errors["stats"] = "You must only have a net gain of 2 stat points";


      $skills = [
        (int)Input::get("race_skill"),
        (int)Input::get("class_skill"),
      ];

      if( !empty($errors) ) return Redirect::to( url('character/new') )->withErrors($errors)->withInput();
      $character = Character::generateCharacter([
        "name"    => Input::get("name"),
        "class"   => (int)Input::get("class"),
        "race"    => (int)Input::get("race"),
        "stats"   => $stats,
        "skills"  => $skills
      ]);
      $characters = $user->characters;
      $characters[] = $character->character_id;
      $user->characters = $characters;

      $user->save();
      return Redirect::to("character")->with("success_message","Character Was Successfully Created.");
    }
  }

  public function anyEdit() {
    if( Request::isMethod("GET") ) {
      $data = [
        "races"      => Race::getList(),
        "classes"    => Cls::getList(),
        "character"  => Character::where("character_id", "=", (int)Input::get("character_id"))->first()
      ];
      return view('character.edit', $data);
    }
    else if(Request::isMethod("POST")) {
      $user = Sentry::getUser();

      $errors = [];
      if(!Input::get('name')) $errors["name"] = "Name is Required";
      if(!Input::get('class')) $errors["class"] = "Class is Required";
      if(!Input::get('race')) $errors["race"] = "Race is Required";

      if( !empty($errors) ) return Redirect::to( url('character/edit?character_id=' . Input::get("character_id") ) )->withErrors($errors)->withInput();

      $character = Character::modifyCharacter(
      Input::get("character_id"),
      [
        "name"  => Input::get("name"),
        "class" => Input::get("class"),
        "race"  => Input::get("race")
      ]);

      return Redirect::to("character")->with("success_message","Character Was Successfully Created.");
    }
  }

}
