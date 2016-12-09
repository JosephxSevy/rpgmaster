<?php
  use Jenssegers\Mongodb\Eloquent\SoftDeletes;

  class Race extends Moloquent {
    use SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'race';
    protected $dates = ['created_at','updated_at','deleted_at'];

    public static function getList() {
      return Race::all();
    }

    public static function getMyName($id) {
      $race = Race::where("race_id",(int)$id)->first();
      return ( !empty($race) ) ? $race->name : "";
    }

  }
?>
