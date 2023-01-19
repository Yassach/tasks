<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(!isset($tasks))

                    <div
                        class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            No task available
                        </h5>
                    </div>
                @else
                    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">#</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Type</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Titre</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Status</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Priorité</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Dernière activité</th>
                            <th scope="col" class="px-6 py-4 font-medium text-gray-900">Action</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        @foreach($tasks as $task)
                            <tr class="hover:bg-gray-50">
                                <th class="flex gap-3 px-6 py-4 font-normal text-gray-900"> {{ $task->id }} </th>

                                <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                            {{ $task->type }}
                                        </span>
                                </td>

                                <td class="px-6 py-4">{{ $task->title }}</td>

                                <td class="px-6 py-4">
                                    @if($task->status === 'pending')
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-orange-50 px-2 py-1 text-xs font-semibold text-orange-600">
                                            {{ $task->status }}
                                        </span>
                                    @elseif($task->status === 'on hold')
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2 py-1 text-xs font-semibold text-indigo-600">
                                            {{ $task->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">

                                    @if($task->priority === 'urgent')
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2 py-1 text-xs font-semibold text-red-600">
                                            {{ $task->priority }}
                                        </span>
                                    @elseif($task->priority === 'moyen')
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-orange-50 px-2 py-1 text-xs font-semibold text-orange-600">
                                            {{ $task->priority }}
                                        </span>
                                    @elseif($task->priority === 'faible')
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-gray-50 px-2 py-1 text-xs font-semibold text-gray-600">
                                            {{ $task->priority }}
                                        </span>
                                    @endif

                                </td>
                                <td class="px-6 py-4">
                                    @if($task->lastActivity)
                                        <div class="flex justify-end gap-4">
                                            {{ $task->lastActivity->diffforhumans() }}
                                        </div>
                                    @else
                                        <div class="flex justify-end gap-4">
                                            No activity yet
                                        </div>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <a href="{{ route('tasks.show', $task->id) }}"
                                       class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">Show</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>
