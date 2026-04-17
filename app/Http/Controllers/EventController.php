<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        return view("event-detail");
    }

    public function show(){
        return view("chekout");
    }
}
