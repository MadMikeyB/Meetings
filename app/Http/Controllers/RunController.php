<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;

class RunController extends Controller
{
  public function choose() {
    $params = [];
    $meetings = [
      'Upcoming Meetings' => Meeting::get_for_page($params)["Upcoming Meetings"],
    ];

    return view(
      "run.choose",
      compact(["meetings", "params"])
    );
  }
}
