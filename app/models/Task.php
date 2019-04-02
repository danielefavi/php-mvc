<?php

namespace App\Models;

use Core\Model;



class Task extends Model
{
    /**
     * Name of the database table that the Taks class is related to.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * List of fields that will be autamatically be filled when using
     * the function Task::create or Task::update
     *
     * @var array
     */
    protected $fillable = [
        'task',
    ];



    /**
     * Check if the task is completed.
     *
     * @return mixed
     */
    public function isCompleted($retVal=true)
    {
        return ($this->data->completed > 0) ? $retVal : false;
    }



    /**
     * Mark a task as completed.
     *
     * @return boolean
     */
    public function setAsCompleted()
    {
        $this->data->completed = true;

        return $this->save();
    }



    /**
     * Mark a task as not completed.
     *
     * @return boolean
     */
    public function setAsNotCompleted()
    {
        $this->data->completed = false;

        return $this->save();
    }



    /**
     * Return the path of the task resource.
     *
     * @param string $suffix|null
     * @return string
     */
    public function path($suffix=null)
    {
        $path = 'admin/tasks/' . $this->getId();

        if ($suffix) {
            $path .= "/{$suffix}";
        }

        return get_uri($path);
    }
}
