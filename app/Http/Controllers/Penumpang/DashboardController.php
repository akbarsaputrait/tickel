<?php

namespace App\Http\Controllers\Penumpang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  public function index() {
		return view('layouts.penumpang.dashboard');
	}
}
