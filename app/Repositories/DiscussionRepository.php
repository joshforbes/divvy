<?php namespace App\Repositories;


use App\Discussion;

class DiscussionRepository {

    /**
     * Persist a discussion
     *
     * @param Discussion $discussion
     */
    public function save(Discussion $discussion)
    {
        $discussion->save();
    }

    /**
     * Find a Discussion by the specified Id
     *
     * @param $discussionId
     * @param $taskId
     * @param $projectId
     * @return mixed
     */
    public function findByIdInTaskAndProject($discussionId, $taskId, $projectId)
    {
        $discussion = Discussion::with('task.project', 'author', 'comments.author')
            ->whereHas('task', function($q) use($taskId){
                $q->whereId($taskId);
            })
            ->whereHas('task.project', function($q) use($projectId){
                $q->whereId($projectId);
            })
            ->findOrFail($discussionId);

        return $discussion;
    }


    /**
     * Find a Discussion by the specified ID
     *
     * @param $discussionId
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findById($discussionId)
    {
        return Discussion::find($discussionId);
    }


}

