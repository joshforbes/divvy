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
        $discussion = Discussion::with('task.project', 'author')
            ->whereHas('task', function($q) use($taskId){
                $q->whereId($taskId);
            })
            ->whereHas('task.project', function($q) use($projectId){
                $q->whereId($projectId);
            })
            ->findOrFail($discussionId);

        return $discussion;
    }


}

