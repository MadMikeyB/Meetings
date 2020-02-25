<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
use App\NextStep;
use Ramsey\Uuid\Uuid;

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

  /*
   *
   *  ADDING BITS TO THE PLAN
   *
   */

  public function plan_add_day()
  {
    return view(
      'includes.plan.day',
      ['uuid' => Uuid::uuid4()->toString()]
    );
  }

  public function plan_add_attendee()
  {
    return view(
      'includes.plan.attendee',
      ['uuid' => Uuid::uuid4()->toString()]
    );
  }

  public function plan_add_objective()
  {
    return view(
      'includes.plan.objective',
      ['uuid' => Uuid::uuid4()->toString()]
    );
  }

  public function plan_add_agenda_item(Meeting $meeting)
  {
    //dump($meeting);
    $uuid = Uuid::uuid4()->toString();
    return view(
      'includes.plan.agenda_item',
      compact(['uuid','meeting'])
    );
  }





  /*
   *
   *  RUN
   *
   */


  public function run_choose_meetings(Request $request)
  {
    $params = $request->all() ?? [];

    $meetings = [
      "Upcoming Meetings" => Meeting::get_for_page($params)["Upcoming Meetings"],
    ];

    return view(
      'includes.my_meetings',
      compact([
        "meetings",
        "params",
      ])
    );
  }
}
