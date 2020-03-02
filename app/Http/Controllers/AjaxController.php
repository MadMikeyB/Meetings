<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
use App\NextStep;
use App\Day;
use App\AgendaItem;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
  public function meetings(Request $request)
  {
    $params = $request->all() ?? [];

    $meetings = Meeting::get_for_page($params, Auth::user());

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

    $next_steps = NextStep::get_for_page($params, Auth::user());

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

  public function plan_add_agenda_item(Day $day, int $item_type)
  {
    $meeting = $day->meeting;
    $new_item = [
      "id" => Uuid::uuid4()->toString(),
      "day_id" => $day->id,
      "position" => $day->agenda_items()->where('type', '>', AgendaItem::TYPE_OPEN)->first()->position - 0.5,
      "type" => $item_type,
      "expected_number_of_minutes" => 5,
      "leader" => $meeting->user->id,
    ];
    switch($item_type) {
    case AgendaItem::TYPE_NORMAL_ITEM:
      $new_item["name"] = "New Agenda Item";
      $new_item["expected_number_of_minutes"] = 15;
      break;
    case AgendaItem::TYPE_BREAK:
      $new_item["name"] = "New Break";
      break;
    case AgendaItem::TYPE_LUNCH:
      $new_item["name"] = "New Lunch";
      break;
    case AgendaItem::TYPE_ICE_BREAKER:
      $new_item["name"] = "New Ice-Breaker";
      break;
    default:
      break;
    }

    $new_item_object = AgendaItem::create($new_item);

    $i = 0;
    foreach($day->agenda_items as $ai) {
      $ai->update(["position" => $i++]);
    }

    return view(
      'includes.agenda',
      compact(['meeting'])
    );
  }

  public function plan_delete_agenda_item(AgendaItem $item) {
    $day = $item->day;
    $meeting = $day->meeting;

    $item->delete();

    $i = 0;
    foreach($day->agenda_items as $ai) {
      $ai->update(["position" => $i++]);
    }

    return view(
      'includes.agenda',
      compact(['meeting'])
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
