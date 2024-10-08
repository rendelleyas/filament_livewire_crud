<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modules') }}
        </h2>
    </x-slot>

    <div class="py-12 m-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-2 text-gray-600 dark:text-gray-400">
                        Module {{ $number }}
                    </div>
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ $module->name }}
                    </h2>
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-2 text-gray-600 dark:text-gray-400">
                        Description
                    </div>
                    <div class="mt-2 text-gray-600 dark:text-gray-400">
                        {{ $module->description }}
                    </div>
                </div>

                <div class="mt-6 bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg m-5">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mt-2 text-gray-600 dark:text-gray-400">
                            Card
                        </div>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In et ipsum sit amet tellus laoreet ullamcorper. Vivamus sit amet nulla auctor, vestibulum magna sed, convallis ex.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
