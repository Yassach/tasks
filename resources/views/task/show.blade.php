<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task detail') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-white border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    #
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Type
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Title
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Status
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Priority
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Last activity
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Description
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $task->id }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $task->type }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $task->title }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $task->status }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $task->priority }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $task->updated_at->diffforhumans() }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $task->description }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div
                        class="w-full max-w-md p-4 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Activities</h5>
                        </div>
                        <div class="flow-root">
                            @if(isset($task->comments))
                                @foreach($task->comments as $comment)
                                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <li class="py-3 sm:py-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                        user : {{ $comment->user_id }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                        {{ $comment->comment }}
                                                    </p>
                                                </div>
                                                <div
                                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                    {{ $comment->created_at->diffforhumans() }}
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                @endforeach
                            @endif

                            <form class="mb-6" method="POST" action="{{ route('comments.store') }}">
                                @csrf
                                <div
                                    class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                    <label class="sr-only">Your comment</label>
                                    <textarea name="comment" rows="6"
                                              class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                              placeholder="Write a comment..." required></textarea>
                                </div>
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                <button type="submit" class="btn btn-blue">
                                    Post comment
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
