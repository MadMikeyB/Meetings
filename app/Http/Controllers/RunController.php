<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RunController extends Controller
{
  public function choose() {
    $params = [];
    $meetings = [
      'Upcoming Meetings' => Meeting::get_for_page($params, Auth::user())["Upcoming Meetings"],
    ];

    return view(
      "run.choose",
      compact(["meetings", "params"])
    );
  }
}
