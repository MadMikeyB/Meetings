<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
use App\NextStep;

class AjaxController extends Controller
{
  public function meetings(Request $request)
  {
    $params = $request->all() ?? [];

    $meetings = Meeting::get_for_page($params);

    return view(
      'includes.my_meetings',
      compact([
        "meetings",
        "params",
      ])
    );

  }
  public function next_steps(Request $request)
  {
    $params = $request->all() ?? [];

    $next_steps = NextStep::get_for_page($params);

    return view(
      'includes.my_next_steps',
      compact([
        "next_steps",
        "params",
      ])
    );

  }
}
