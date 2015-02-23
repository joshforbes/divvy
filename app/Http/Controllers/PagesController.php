<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Illuminate\Http\Request;

class PagesController extends Controller {


    /**
     * Shows the application splash page or the dashboard
     * depending on auth status
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (!Auth::check())
        {
            return view('pages.splash');
        }

        $projects = Auth::user()->projects;
        return view('pages.dashboard', compact('projects'));

    }


}
