<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\AddTaskToProjectRequest;
use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddTaskToProjectRequest $request
     * @param TaskRepository $taskRepository
     * @param $projectId
     * @return Response
     */
    public function store(AddTaskToProjectRequest $request, TaskRepository $taskRepository, $projectId)
    {
        $task = Task::assign([
            'name'        => $request->name,
            'description' => $request->description,
            'project_id'  => $projectId,
        ]);

        $taskRepository->save($task);

        if ($request->members)
        {
            $taskRepository->assignTo($request->members, $task);
        }

        return redirect()->route('project.show', $projectId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
