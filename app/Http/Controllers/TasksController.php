<?php namespace App\Http\Controllers;

use App\Commands\AddTaskToProjectCommand;
use App\Commands\CompleteTaskCommand;
use App\Commands\ModifyTaskCommand;
use App\Commands\RemoveTaskCommand;
use App\Commands\ReopenTaskCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\TaskRequest;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use Request;
use Illuminate\Http\Response;
use JavaScript;

/**
 * Class TasksController
 * @package App\Http\Controllers
 */
class TasksController extends Controller {

    protected $projectRepository;
    protected $taskRepository;

    public function __construct(ProjectRepository $projectRepository, TaskRepository $taskRepository)
    {
        parent::__construct();

        $this->projectRepository = $projectRepository;
        $this->taskRepository = $taskRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $projectId
     * @return Response
     */
    public function create($projectId)
    {
        $project = $this->projectRepository->findById($projectId);

        $members = $this->projectRepository->usersInProjectArray($project);

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
        $this->dispatch(
            new AddTaskToProjectCommand($request, $projectId, $this->user)
        );

        if (Request::ajax())
        {
            return response('success', 200);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param $projectId
     * @param $taskId
     * @return Response
     */
    public function show($projectId, $taskId)
    {
        $task = $this->taskRepository->findByIdInProject($projectId, $taskId);
        $project = $task->project;
        $subtasks = $task->subtasks;

        JavaScript::put([
            'currentUser' => $this->user->username,
            'admins' => $project->admins,
            'channel' => 't' . $task->id
        ]);

        return view('tasks.show', compact('task', 'project', 'subtasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $projectId
     * @param $taskId
     * @return Response
     */
    public function edit($projectId, $taskId)
    {
        $task = $this->taskRepository->findByIdInProject($projectId, $taskId);

        $project = $task->project;

        $members = $this->projectRepository->usersInProjectArray($project);

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
            new ModifyTaskCommand($request, $taskId, $this->user)
        );

        if (Request::ajax())
        {
            return response('success', 200);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @internal param int $id
     * @param $projectId
     * @param $taskId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($projectId, $taskId)
    {
        $this->dispatch(
            new RemoveTaskCommand($taskId, $this->user)
        );

        if (Request::ajax())
        {
            return response('success', 200);
        }
        return redirect()->back();
    }

    /**
     * Complete the task
     *
     * @param $projectId
     * @param $taskId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete($projectId, $taskId)
    {
        $this->dispatch(
            new CompleteTaskCommand($taskId, $this->user)
        );

        return redirect()->back();
    }

    /**
     * The task was incomplete
     *
     * @param $projectId
     * @param $taskId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function incomplete($projectId, $taskId)
    {
        $this->dispatch(
            new ReopenTaskCommand($taskId, $this->user)
        );

        return redirect()->back();
    }

}
