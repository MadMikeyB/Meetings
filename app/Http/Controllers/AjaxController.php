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

    $params['meeting']['sort'] = $params['meeting']['sort'] ?? '';
    $params['meeting']['filter'] = $params['meeting']['filter'] ?? [];

    $meetings = array(
      'Upcoming Meetings' => Meeting::where([
        'is_complete' => false,
        'is_draft' => false,
      ]),
      'Draft Meetings' => Meeting::where([
        'is_draft' => true,
      ]),
      'Past Meetings' => Meeting::where([
        'is_complete' => true,
        'is_draft' => false,
      ]),
    );

    $sort_by = $params['meeting']['sort'];
    $filter_by = $params['meeting']['filter'];

    if(isset($sort_by)) {
      $sort_by = explode("_", $sort_by);
      foreach($meetings as $tab => $set) {
        $meetings[$tab] = $set->orderBy($sort_by[0], $sort_by[1]);
      }
    }

    if(isset($filter_by)) {
      foreach($filter_by as $key => $value) {
        foreach($meetings as $tab => $set) {
          $meetings[$tab] = $set->where($key, 'LIKE', '%'.$value.'%');
        }
      }
    }

    if(isset($params['q_limit'])) {
      foreach($meetings as $tab => $set) {
        $meetings[$tab] = $set->take($params['q_limit']);
      }
    }

    foreach($meetings as $tab => $set) {
      $meetings[$tab] = $set->get();
    }

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

    $params['meeting']['sort'] = $params['meeting']['sort'] ?? '';
    $params['meeting']['filter'] = $params['meeting']['filter'] ?? [];

    $meetings = array(
      'Upcoming Meetings' => Meeting::where([
        'is_complete' => false,
        'is_draft' => false,
      ]),
      'Draft Meetings' => Meeting::where([
        'is_draft' => true,
      ]),
      'Past Meetings' => Meeting::where([
        'is_complete' => true,
        'is_draft' => false,
      ]),
    );

    $sort_by = $params['meeting']['sort'];
    $filter_by = $params['meeting']['filter'];

    if(isset($sort_by)) {
      $sort_by = explode("_", $sort_by);
      foreach($meetings as $tab => $set) {
        $meetings[$tab] = $set->orderBy($sort_by[0], $sort_by[1]);
      }
    }

    if(isset($filter_by)) {
      foreach($filter_by as $key => $value) {
        foreach($meetings as $tab => $set) {
          $meetings[$tab] = $set->where($key, 'LIKE', '%'.$value.'%');
        }
      }
    }

    if(isset($params['q_limit'])) {
      foreach($meetings as $tab => $set) {
        $meetings[$tab] = $set->take($params['q_limit']);
      }
    }

    foreach($meetings as $tab => $set) {
      $meetings[$tab] = $set->get();
    }

    return view(
      'includes.my_meetings',
      compact([
        "meetings",
        "params",
      ])
    );

  }
}
