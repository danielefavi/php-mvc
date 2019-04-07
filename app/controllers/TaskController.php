<?php

namespace App\Controllers;

use \Core\App;
use \Core\Request;

use \App\Models\Task;



class TaskController
{

    /**
     * Show the list of tasks and the form to create a new one.
     *
     * @param Request $request|null
     * @param array $errors|[]
     * @return void
     */
    public function index(Request $request=null, $errors=[])
    {
        $tasks = Task::select();

        return view('tasks/index', compact('tasks', 'errors'));
    }



    /**
     * Store a new task.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $task = trim($request->post('task'));

        if (empty($task)) {
            return $this->index($request, ['The task title is mandatory!']);
        }

        Task::create(compact('task'));

        return redirect('admin/tasks');
    }



    /**
     * Update the task list.
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        if ($task = Task::find($request->routes('taskId'))) {
            if ($request->post('is_completed')) {
                $task->setAsCompleted();
            } else {
                $task->setAsNotCompleted();
            }
        } else {
            return view('404');
        }

        return redirect('admin/tasks');
    }

}
