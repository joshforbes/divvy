<?php namespace App\Http\Controllers;

use App\Commands\AddTaskToProjectCommand;
use App\Commands\ModifyTaskCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\TaskRequest;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Http\Request;

/**
 * Class TasksController
 * @package App\Http\Controllers
 */
class TasksController extends Controller {

    /**
     * Show the form for creating a new resource.
     *
     * @param ProjectRepository $projectRepository
     * @param $projectId
     * @return Response
     */
    public function create(ProjectRepository $projectRepository, $projectId)
    {
        $project = $projectRepository->findById($projectId);

        $members = $projectRepository->usersInProjectArray($project);

        return view('tasks.create', compact('project', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @param $projectId
     * @return Response
     */
    public function store(TaskRequest $request, $projectId)
    {
        $task = $this->dispatch(
            new AddTaskToProjectCommand($request, $projectId)
        );

        return redirect()->route('project.show', [$projectId]);
    }

    /**
     * Display the specified resource.
     *
     * @param TaskRepository $taskRepository
     * @param $projectId
     * @param $taskId
     * @return Response
     */
    public function show(TaskRepository $taskRepository, $projectId, $taskId)
    {
        $task = $taskRepository->findByIdInProject($projectId, $taskId);
        $project = $task->project;
        $subtasks = $task->subtasks;

        return view('tasks.show', compact('task', 'project', 'subtasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProjectRepository $projectRepository
     * @param TaskRepository $taskRepository
     * @param $projectId
     * @param $taskId
     * @return Response
     */
    public function edit(ProjectRepository $projectRepository, TaskRepository $taskRepository, $projectId, $taskId)
    {
        $task = $taskRepository->findByIdInProject($projectId, $taskId);

        $project = $task->project;

        $members = $projectRepository->usersInProjectArray($project);

        return view('tasks.edit', compact('task', 'project', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskRequest $request
     * @param $projectId
     * @param $taskId
     * @return Response
     */
    public function update(TaskRequest $request, $projectId, $taskId)
    {
        $this->dispatch(
            new ModifyTaskCommand($request, $taskId)
        );

        //Flash::message('Profile updated');
        return redirect()->route('task.show', [$projectId, $taskId]);
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
