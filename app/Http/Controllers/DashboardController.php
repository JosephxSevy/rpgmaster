<?php

namespace App\Http\Controllers;

class DashboardController extends Controller {

  public function anyIndex() {
    $data = [];
    return view('dashboard', $data);
  }
}
