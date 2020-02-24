<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
use App\NextStep;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
      $params = $request->all();

      $params['q_limit'] = 3;

      $meetings = Meeting::get_for_page($params);
      $next_steps = NextStep::get_for_page($params);

      return view(
        'dashboard.home',
        compact([
          "meetings",
          "next_steps",
          "params",
        ])
      );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexMeetings(Request $request)
    {
      $params = $request->all();

      $meetings = Meeting::get_for_page($params);

      return view(
        'dashboard.meetings',
        compact([
          "meetings",
          "params",
        ])
      );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexNextSteps(Request $request)
    {
      $params = $request->all();

      $next_steps = NextStep::get_for_page($params);

      return view(
        'dashboard.next_steps',
        compact([
          "next_steps",
          "params",
        ])
      );
    }

    public function planNewMeeting()
    {
      $meeting = Meeting::create();
    
      return redirect()->route('edit_meeting', ["meeting" => $meeting->id]);
    
    }

    public function editMeeting(Meeting $meeting)
    {
    
      return view('plan.details', compact(["meeting"]));
    
    }



}
