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

  public function run(Meeting $meeting, int $item_index = 0) {
    return view(
      "run.run",
      compact(["meeting","item_index"])
    );
  }
}
