<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $modules = $user->modules;

        if ($user->hasRole('admin')) {
            $modules = Module::all();
        }

        return view('modules.index')->with([
            'modules' => $modules,
        ]);
    }

    public function view(Request $request, Module $module)
    {
        return view('modules.view')->with([
            'module' => $module,
            'number' => $request->key,
        ]);
    }
}
