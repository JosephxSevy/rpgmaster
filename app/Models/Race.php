<?php
  class Race extends Moloquent {
    protected $connection = 'mongodb';
    protected $collection = 'race';

    public static function getList() {
      return Race::all();
    }

    public static function getMyName($id) {
      $race = Race::where("race_id",(int)$id)->first();
      return ( !empty($race) ) ? $race->name : "";
    }

  }
?>
