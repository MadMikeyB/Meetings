<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\Day;
use App\AgendaItem;
use App\Attendee;
use App\Objective;
use App\Http\Requests\PlanMeetingRequest;
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

  public function save(Meeting $meeting, PlanMeetingRequest $request)
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
    return response()->json([], 200);
  }

  public function delete(Meeting $meeting)
  {
    $meeting->delete();
    return $this->redirect()->route('home.dashboard');
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
    $agenda_items = [
      [
        'id' => Uuid::uuid4()->toString(),
        'type' => AgendaItem::TYPE_OPEN,
        'name' => "Open: Review Objectives and Expectations",
      ],
      [
        'id' => Uuid::uuid4()->toString(),
        'type' => AgendaItem::TYPE_NORMAL_ITEM,
        'name' => "Agenda Item 1",
      ],
      [
        'id' => Uuid::uuid4()->toString(),
        'type' => AgendaItem::TYPE_NORMAL_ITEM,
        'name' => "Agenda Item 2",
      ],
      [
        'id' => Uuid::uuid4()->toString(),
        'type' => AgendaItem::TYPE_NORMAL_ITEM,
        'name' => "Agenda Item 3",
      ],
      [
        'id' => Uuid::uuid4()->toString(),
        'type' => AgendaItem::TYPE_CLOSE_1,
        'name' => "Close - Part 1: Review Objectives and Expectations",
      ],
      [
        'id' => Uuid::uuid4()->toString(),
        'type' => AgendaItem::TYPE_CLOSE_2,
        'name' => "Close - Part 2: Capture Benefits and Concerns",
      ],
      [
        'id' => Uuid::uuid4()->toString(),
        'type' => AgendaItem::TYPE_CLOSE_3,
        'name' => "Close - Part 3: Review Next Steps",
      ]
    ];

    foreach($meeting->days as $day) {
      if(count($day->agenda_items) == 0) {
        $p = 0;
        foreach($agenda_items as $item) {
          $item['leader'] = $meeting->user->name;
          $item['expected_number_of_minutes'] = 5;
          $item['day_id'] = $day->id;
          $item['position'] = $p++;
          $new_item = AgendaItem::create($item);
        }
      }
    }

    return view(
      'plan.agenda',
      compact(["meeting"])
    );
  }


  /*
   *
   *  SUMMARY
   *
   */

  public function summary(Meeting $meeting) {
    return view('plan.summary', compact(['meeting']));
  }


  /*
   *
   *  FINISH
   *
   */

  public function finish(Meeting $meeting) {
    $meeting->update(['is_draft' => 0]);
    return redirect("/");
  }
}
