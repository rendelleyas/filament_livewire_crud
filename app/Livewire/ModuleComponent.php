<?php

namespace App\Livewire;

use App\Models\Module;
use Livewire\Component;

class ModuleComponent extends Component
{
    public function render()
    {
        /** @var User $user */
        $user = auth()->user();

        $modules = $user->modules;

        if ($user->hasRole('admin')) {
            $modules = Module::all();
        }

        return view('livewire.module-component')->with([
            'modules' => $modules,
        ]);
    }
}
