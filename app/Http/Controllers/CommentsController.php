<?php namespace App\Http\Controllers;

use App\Commands\ModifyCommentCommand;
use App\Commands\RemoveCommentCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ModifyCommentRequest;
use Request;

class CommentsController extends Controller {


    /**
     * Update the specified resource in storage.
     * @param ModifyCommentRequest $request
     * @param $projectId
     * @param $taskId
     * @param $commentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ModifyCommentRequest $request, $projectId, $taskId, $commentId)
    {
        $this->dispatch(
            new ModifyCommentCommand($request, $commentId, $this->user)
        );

        if (Request::ajax())
        {
            return response('success', 200);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param $projectId
     * @param $taskId
     * @param $commentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($projectId, $taskId, $commentId)
    {
        $this->dispatch(
            new RemoveCommentCommand($commentId, $this->user)
        );

        if (Request::ajax())
        {
            return response('success', 200);
        }

        return redirect()->back();
    }
}
