<?php
  use Jenssegers\Mongodb\Eloquent\SoftDeletes;

  class Skill extends Moloquent {
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'skill';

    protected $dates = ['created_at','updated_at','deleted_at'];


  }
?>
