<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    public static function store($citizen)
    {
        $new_citizen = new Citizen();
        $new_citizen->name = $citizen['name'];
        $new_citizen->email = $citizen['email'];
        $new_citizen->region_ter_id = $citizen['region'];
        $new_citizen->city_ter_id = $citizen['city'];
        $new_citizen->area_ter_id = $citizen['area'];
        return $new_citizen->save();
    }

    public static function getByEmail($email)
    {
        $citizen = self::where('email', $email)->first();
        return $citizen;
    }

    public function region()
    {
//        return var_dump($this->hasOne('App\Territory', 'ter_id','region_ter_id'));
        return Territory::where('ter_id', $this->region_ter_id)->first();
    }

    public function city()
    {
        //        return var_dump($this->hasOne('App\Territory', 'ter_id','city_ter_id'));
        return Territory::where('ter_id', $this->city_ter_id)->first();
    }

    public function area()
    {
        //        return var_dump($this->hasOne('App\Territory', 'ter_id','area_ter_id'));
        return Territory::where('ter_id', $this->area_ter_id)->first();
    }
}
