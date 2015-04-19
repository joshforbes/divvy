<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Illuminate\Http\Request;
use JavaScript;

class PagesController extends Controller {


    /**
     * Shows the application splash page or the dashboard
     * depending on auth status
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (!$this->signedIn)
        {
            return view('pages.splash');
        }

        $projects = $this->user->projects;

        JavaScript::put([
            'currentUser' => $this->user->username,
            'channel' => 'u' . $this->user->id
        ]);

        return view('pages.dashboard', compact('projects'));

    }


}
