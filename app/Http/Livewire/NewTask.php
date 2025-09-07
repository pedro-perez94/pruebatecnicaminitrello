<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Validation\Rule;

class NewTask extends Component
{

    public array $task = [];

    /**
     * Guarda la tarea
     */
    public function save () {

        $validator = Validator::make($this->task, [
            'title' => 'required|string|min:3|max:254',
            'description' => 'required|string',
            'state' => ['required', Rule::in(['todo', 'doing', 'done'])]
        ]);

        if ( $validator->fails() ) {
            $this->dispatchBrowserEvent('notify', ['message' => $validator->errors()->first()]);
            return;
        }

        $task = new Task([
            'user_id' => Auth::user()->id,
            'title' => trim($this->task['title']),
            'description' => trim($this->task['description']),
            'state' => $this->task['state']
        ]);

        $task->save();

        $this->emit('update_task_list');

        $this->dispatchBrowserEvent('notify', ['message' => 'Tarea guardada.']);

        $this->task = [];

    }

    public function render()
    {
        return view('livewire.new-task');
    }
}
