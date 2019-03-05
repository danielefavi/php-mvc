<?php

namespace App\Controllers;

use \Core\App;

use App\Models\Task;



class TaskController
{

    /**
     * Show the list of tasks and the form to create a new one.
     *
     * @return void
     */
    public function index($errors=[])
    {
        $tasks = Task::select();

        return view('tasks/index', compact('tasks', 'errors'));
    }



    /**
     * It acts like a router of actions depending wich submit button the user
     * presses in the tasks form.
     *
     * @return string
     */
    public function actions()
    {
        if (request('post', 'action') == 'add_new') return $this->store();

        return $this->update();
    }



    /**
     * Store a new task.
     *
     * @return void
     */
    public function store()
    {
        $task = trim(request('post', 'task'));

        if (empty($task)) {
            return $this->index(['The task title is mandatory!']);
        }

        Task::create([
            'task' => $task
        ]);

        return redirect('admin/tasks');
    }



    /**
     * Update the task list.
     *
     * @return void
     */
    public function update()
    {
        $tasksCompleted = request('post', 'tasks', []);

        foreach(Task::select() as $task) {
            if (isset($tasksCompleted[$task->getId()]) and !$task->isCompleted()) {
                $task->setAsCompleted();
            }
            else if (!isset($tasksCompleted[$task->getId()]) and $task->isCompleted()) {
                $task->setAsNotCompleted();
            }
        }

        return redirect('admin/tasks');
    }

}