<?php

function hasCompleted($subtasks)
{
    if (in_array('1', $subtasks->lists('is_complete')))
    {
        return true;
    }
    return false;
}