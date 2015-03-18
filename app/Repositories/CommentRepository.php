<?php namespace App\Repositories;


use App\Comment;

class CommentRepository {

    /**
     * Find a Discussion by the specified ID
     *
     * @param $commentId
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findById($commentId)
    {
        return Comment::find($commentId);
    }

    /**
     * Delete by model
     *
     * @param Comment $comment
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Comment $comment)
    {
        return $comment->delete();
    }

    /**
     * Updates the Comment with the given id
     *
     * @param $commentId
     * @param $updatedData
     * @return mixed
     */
    public function update($commentId, $updatedData)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->fill($updatedData)->save();
        return $comment;
    }
}