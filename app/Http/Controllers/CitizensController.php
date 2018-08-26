<?php

namespace App\Http\Controllers;

use App\Territory;
use Illuminate\Http\Request;

class CitizensController extends Controller
{
        public function create(Request $request)
    {
        return $request->post();
    }
}
