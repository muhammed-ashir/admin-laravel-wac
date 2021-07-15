<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

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
    public function index()
    {
        $count_active = Employee::all()->count();
        $count_blocked  = Employee::where('status',0)->count();
        $count = [
            'count_active'=>$count_active,
            'count_blocked'=>$count_blocked
        ];
        return view('home',compact('count'));
    }


}
