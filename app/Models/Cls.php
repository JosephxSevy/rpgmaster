<?php
  use Jenssegers\Mongodb\Eloquent\SoftDeletes;
  
  class Cls extends Moloquent {
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'class';

    protected $dates = ['created_at','updated_at','deleted_at'];


    public static function getList() {
      return Cls::all();
    }

    public static function getMyName($id) {
      $cls = Cls::where("class_id",(int)$id)->first();
      return ( !empty($cls) ) ? $cls->name : "";
    }
  }
?>
