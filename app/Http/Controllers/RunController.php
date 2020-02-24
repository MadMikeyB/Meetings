<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;

class RunController extends Controller
{
  public function choose() {
    $meetings = [
      "All" => Meeting::all(),
    ];
    $params = [];

    return view(
      "run.choose",
      compact(["meetings", "params"])
    
    
    );
  }
}
