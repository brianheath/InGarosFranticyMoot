<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index()
    {
        return view('home', ['options' => $this->options]);
    }
}
