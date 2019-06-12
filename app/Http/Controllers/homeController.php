<?php
namespace  App\Http\Controllers;

use App\Course;
use App\Message;
use App\Saying;
use Illuminate\Http\Request;

class homeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')
            ->with('courses', Course::take(6)->get())
            ->with('sayings', Saying::all())
            ->with('messages', Message::all())
            ;
    }
}
