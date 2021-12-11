<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $var = "HR Venture";
        return view('backend.dashboard',compact('var'));
    }
}
