<?php

namespace App\Http\Controllers;

use App\Citizen;
use App\Territory;
use Illuminate\Http\Request;

class CitizensController extends Controller
{
    public function create(Request $request)
    {
//        $request->validate([
//            'name' => 'min:2',
//            'email' => 'email|required',
//            'region' => 'numeric|required',
//            'city' => 'numeric|required',
//            'area' => 'numeric|required',
//        ]);
        $citizen = [];
        $citizen['name'] = $request->post('name');
        $citizen['email'] = $request->post('email');
        $citizen['region'] = $request->post('region');
        $citizen['city'] = $request->post('city');
        $citizen['area'] = $request->post('area');
        return (Citizen::store($citizen)) ? 'success' : 'fail';
    }

    public function checkEmail($email)
    {
        $citizen = Citizen::getByEmail($email);
        return ($citizen) ? view('user-card', [
            'citizen' => $citizen,
        ]) :
            null;
    }
}
