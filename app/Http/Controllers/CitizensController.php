<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitizensController extends Controller
{
    public function index()
    {
        return view('idea');
    }

    public function create(Request $request)
    {
        return $request->post();
    }
}
