<?php

namespace App\Http\Controllers;

use App\Territory;
use Illuminate\Http\Request;

class TerritoriesController extends Controller
{
    public function index()
    {
//        $terrs = $this->regions();
        $terrs = $this->cities(80);
        foreach ($terrs as $terr) {
            echo $terr->ter_name . PHP_EOL;
        }
    }

    public function regions()
    {
        return Territory::where('ter_type_id', 0)->get();
    }

    public function cities($region_id)
    {
        $cities = Territory::where(['ter_type_id' => 1, 'reg_id' => $region_id])->get();
        if (!empty($cities)) {
            $cities = Territory::where(['ter_type_id' => 0, 'reg_id' => $region_id])->get();
        }
        return $cities;
    }

    public function areas($region_id, $ter_pid)
    {
        return Territory::where(['reg_id' => $region_id, 'ter_pid' => $ter_pid])->get();
    }
}
