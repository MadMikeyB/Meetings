<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\Day;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
  public function create()
  {
    $new_meeting = new Meeting;
    $new_meeting->user_id = Auth::user()->id;
    $new_meeting->save();
    return redirect("/plan/details/".$new_meeting->id);
  }


  public function details(Meeting $meeting)
  {
    $uuid = Uuid::uuid4()->toString();
    return view(
      'plan.details',
      compact(["meeting", "uuid"])
    );
  }

  public function details_put(Meeting $meeting, Request $request)
  {
    $params = $request->all();

    $days = [];

    foreach($params['days'] as $k => $a) {
      foreach($a as $i => $v) {
        $days[$i][$k] = $v;
      }
    }

    foreach($days as $day) {
      $day['meeting_id'] = $meeting->id;
      Day::updateOrCreate(['id' => $day['id']], $day);
    }

    $meeting->update($request->all());




  }
}
