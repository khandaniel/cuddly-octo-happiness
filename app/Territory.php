<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
    protected $table = 't_koatuu_tree';

    public function regions()
    {
        return self::where('ter_type_id', 0)->get();
    }

    public function cities($region_id)
    {
        $cities = self::where([
            'ter_type_id' => 1,
            'reg_id' => $region_id,
            ])->get();
        if (count($cities) == 0) {
            $cities = self::where([
                'ter_type_id' => 0,
                'reg_id' => $region_id,
                ])->get();
        }
        return $cities;
    }

    public function areas($region_id, $ter_pid)
    {
        return self::where([
            'reg_id' => $region_id,
            'ter_pid' => $ter_pid,
            'ter_type_id' => 3,
        ])->get();
    }

    public function getCity($ter_id)
    {
        return self::where('ter_id', $ter_id)->first();
    }
}
