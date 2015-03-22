<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param ActivityRepository $activityRepository
	 * @param $projectId
	 * @return Response
	 */
	public function index(ActivityRepository $activityRepository, $projectId)
	{
		$activity = $activityRepository->findByProjectId($projectId);

		return view('activity.index', compact('activity'));
	}

}
