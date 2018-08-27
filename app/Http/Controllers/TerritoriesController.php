<?php

namespace App\Http\Controllers;

use App\Territory;
use Illuminate\Http\Request;

class TerritoriesController extends Controller
{
    private $territory;

    public function __construct()
    {
        $this->territory = new Territory();
    }

    public function index()
    {
        $territories = $this->territory->regions();
        return view('idea', [
            'territories' => $territories,
        ]);
    }

    /**
     * @param string $type city|area
     * @param string|int $region_id
     * @param null $ter_pid
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nextSelect($type, $region_id, $ter_pid = null)
    {
        $territories = [];
        if ($type == 'city') {
            $territories = $this->territory->cities($region_id);
        } elseif ($type == 'area') {
            $territories = $this->territory->areas($region_id, $ter_pid);
        }
        return view('select', [
            'territories' => $territories,
        ]);
    }
}
