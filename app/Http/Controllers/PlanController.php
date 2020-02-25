<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\Day;
use App\Attendee;
use App\Objective;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
  /*
   *
   *  CREATING
   *
   */
  public function create()
  {
    $new_meeting = new Meeting;
    $new_meeting->user_id = Auth::user()->id;
    $new_meeting->save();
    return redirect("/plan/details/".$new_meeting->id);
  }

  /*
   *
   *  SAVING
   *
   */

  public function details_put(Meeting $meeting, Request $request)
  {
    $params = $request->all();

    if(isset($params['days'])) {

      /*
       *  DAYS
       */

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
    }

    if(isset($params['attendees'])) {
      /*
      *  ATTENDEES
      */

      $attendees = [];

      foreach($params['attendees'] as $k => $a) {
        foreach($a as $i => $v) {
          $attendees[$i][$k] = $v;
        }
      }
      foreach($attendees as $attendee) {
        $attendee['meeting_id'] = $meeting->id;
        Attendee::updateOrCreate(['id' => $attendee['id']], $attendee);
      }
    }

    if(isset($params['objectives'])){
      /*
       *  OBJECTIVES
       */

      $objectives = [];

      foreach($params['objectives'] as $k => $a) {
        foreach($a as $i => $v) {
          $objectives[$i][$k] = $v;
        }
      }

      dump($objectives);

      foreach($objectives as $objective) {
        $objective['meeting_id'] = $meeting->id;
        Objective::updateOrCreate(['id' => $objective['id']], $objective);
      }
    }

    if(isset($params['agenda_items'])){
      /*
       *  AGENDA ITEMS
       */

      $agenda_items = [];

      foreach($params['agenda_items'] as $k => $a) {
        foreach($a as $i => $v) {
          $agenda_items[$i][$k] = $v;
        }
      }

      dump($agenda_items);

      foreach($agenda_items as $agenda_item) {
        $agenda_item['meeting_id'] = $meeting->id;
        AgendaItem::updateOrCreate(['id' => $agenda_item['id']], $agenda_item);
      }
    }

    $meeting->update($request->all());
  }


  /*
   *
   *  DETAILS
   *
   */

  public function details(Meeting $meeting)
  {
    $uuid = Uuid::uuid4()->toString();
    return view(
      'plan.details',
      compact(["meeting", "uuid"])
    );
  }

  /*
   *
   *  ATTENDEES
   *
   */

  public function attendees(Meeting $meeting)
  {
    $uuid = Uuid::uuid4()->toString();
    return view(
      'plan.attendees',
      compact(["meeting", "uuid"])
    );
  }

  /*
   *
   *  OBJECTIVES
   *
   */

  public function objectives(Meeting $meeting)
  {
    $uuid = Uuid::uuid4()->toString();
    return view(
      'plan.objectives',
      compact(["meeting", "uuid"])
    );
  }

  /*
   *
   *  AGENDA
   *
   */

  public function agenda(Meeting $meeting)
  {
    $uuid = Uuid::uuid4()->toString();
    return view(
      'plan.agenda',
      compact(["meeting", "uuid"])
    );
  }
}
