<?php
  use Jenssegers\Mongodb\Eloquent\SoftDeletes;

  class Cls extends Moloquent {
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'class';

    protected $dates = ['created_at','updated_at','deleted_at'];


    public static function getList() {
      $classes = Cls::all();
      $class_list = [];
      foreach($classes as $class) {
        $class->skills = $class->getSkills();
        $class_list[] = $class;
      }
      return $class_list;
    }

    public static function getMyName($id) {
      $cls = Cls::where("class_id",(int)$id)->first();
      return ( !empty($cls) ) ? $cls['name'] : "";
    }

    public function getSkills() {
      $skills = [];
      foreach($this->skills as $skill) {
        $skills[] = Skill::where("skill_id", "=", (int)$skill)->first();
      }
      return array_filter( $skills );
    }
  }
?>
