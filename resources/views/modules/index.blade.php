<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modules') }}
        </h2>
    </x-slot>

    <div class="py-12 m-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 ">
                @foreach ($modules as $key => $module)
                    <a href="{{ route('module.view', ['module' => $module->id, 'key' => $key + 1]) }}"
                        class="block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
                            {{ $module->name }}
                        </h2>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">
                            {{ $module->description }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
