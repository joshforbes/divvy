<?php

/**
 * Checks a collection of subtasks has any subtasks that are complete
 *
 * @param $subtasks
 * @return bool
 */
function hasCompleted($subtasks)
{
    if (in_array('1', $subtasks->lists('is_complete')))
    {
        return true;
    }
    return false;
}