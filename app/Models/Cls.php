<?php

  class Cls extends Moloquent {
    protected $connection = 'mongodb';
    protected $collection = 'class';


    public static function getList() {
      return Cls::all();
    }

    public static function getMyName($id) {
      $cls = Cls::where("class_id",(int)$id)->first();
      return ( !empty($cls) ) ? $cls->name : "";
    }
  }
?>
