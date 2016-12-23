<?php
  use Jenssegers\Mongodb\Eloquent\SoftDeletes;

  class Race extends Moloquent {
    use SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'race';
    protected $dates = ['created_at','updated_at','deleted_at'];


    public static function getList() {
      $races = Race::all();
      $race_list = [];
      foreach($races as $race) {
        $race->skills = $race->getSkills();
        $race_list[] = $race;
      }
      return $race_list;
    }

    public static function getMyName($id) {
      $race = Race::where("race_id",(int)$id)->first();
      return ( !empty($race) ) ? $race->name : "";
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
