<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\NextStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function dashboard(Request $request)
    {
      $user = Auth::user();
      $params = $request->all();

      $params['q_limit'] = 3;

      $meetings = Meeting::get_for_page($params, $user);
      $next_steps = NextStep::get_for_page($params, $user);

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
    public function meetings(Request $request)
    {
      $params = $request->all();

      $meetings = Meeting::get_for_page($params, Auth::user());

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
    public function next_steps(Request $request)
    {
      $params = $request->all();

      $next_steps = NextStep::get_for_page($params, Auth::user());

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

    public function account()
    {
      $user = Auth::user();
      return view(
        'dashboard.account',
        compact(['user'])
      );
    }


}
