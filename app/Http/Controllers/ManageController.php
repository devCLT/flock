<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaraFlash;

class ManageController extends Controller
{
    public function index()
    {
      LaraFlash::danger('Opps something went wrong');
      LaraFlash::keep();

      return redirect()->route('manage.dashboard');
    }

    public function dashboard()
    {
      //LaraFlash::add()->content("Hellow World")->priority(6)->type("Info");
      LaraFlash::success("Yay it worked");
      return view('manage.dashboard');
    }
}
