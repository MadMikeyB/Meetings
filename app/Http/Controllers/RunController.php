<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\AgendaItem;
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

  public function run(Meeting $meeting, AgendaItem $item = null) {
    $ais = $meeting->agenda_items;

    if($item == null) {
      $item = $ais->first();
    }

    $item_index = $ais->where('id', $item->id)->keys()->first();
    $next = $ais[$item_index + 1] ?? null;
    $prev = $ais[$item_index - 1] ?? null;

    return view(
      "run.run",
      compact(["meeting","item", "next", "prev"])
    );
  }
}
