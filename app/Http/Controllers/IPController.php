<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class IPController extends Controller
{
    public function getUserIP()
    {
//        $user_ip = \Request::ip();

        $ip = file_get_contents('https://api.ipify.org');

        $arr_ip = geoip()->getLocation($ip);

//        dd($arr_ip);

        $location = new Location();

        $location->ip = $arr_ip->ip;
        $location->country = $arr_ip->country;
        $location->city = $arr_ip->city;
        $location->latitude = $arr_ip->lat;
        $location->longitude = $arr_ip->lon;

        $location->save();

        return view('user_ip', compact('arr_ip'));
    }
}
