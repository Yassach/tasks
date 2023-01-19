<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task detail') }}
        </h2>
    </x-slot>
    <div class="flex min-h-screen items-center justify-center p-10 bg-white">
        <div class="container grid max-w-screen-xl gap-8 lg:grid-cols-2 lg:grid-rows-2">
            @if(isset($task->comments) && count($task->comments) > 0)
                <div class="row-span-2 flex flex-col rounded-md border border-slate-200">
                    <section class="bg-white dark:bg-gray-900 py-8 lg:py-16">
                        <div class="max-w-2xl mx-auto px-4">
                            @foreach($task->comments as $comment)
                                <article class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900">
                                    <footer class="flex justify-between items-center mb-2">
                                        <div class="flex items-center">
                                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                                                {{ $comment->user->name }}
                                            </p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                <time pubdate datetime="2022-03-12"
                                                      title="March 12th, 2022"> {{ $comment->created_at->diffforhumans() }}
                                                </time>
                                            </p>
                                        </div>
                                    </footer>
                                    <p class="text-gray-500 dark:text-gray-400">{{ $comment->comment }}</p>
                                </article>
                            @endforeach
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion
                                    ({{count($task->comments)}})</h2>
                            </div>
                            <form class="mb-6" method="POST" action="{{ route('comments.store') }}">
                                @csrf
                                <div
                                    class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <textarea name="comment" rows="2"
                                          class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                          placeholder="Write a comment..." required></textarea>
                                </div>
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Post comment
                                </button>
                            </form>
                        </div>
                    </section>
                </div>
            @else
                <div class="row-span-2 flex flex-col rounded-md border border-slate-200">
                    <section class="bg-white dark:bg-gray-900 py-8 lg:py-16">
                        <div class="max-w-2xl mx-auto px-4">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Premier
                                    commentaire</h2>
                            </div>
                            <form class="mb-6" method="POST" action="{{ route('comments.store') }}">
                                @csrf
                                <div
                                    class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <textarea name="comment" rows="2"
                                          class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                          placeholder="Write a comment..." required></textarea>
                                </div>
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Post comment
                                </button>
                            </form>
                        </div>
                    </section>
                </div>
            @endif
            <div class="flex rounded-md border border-slate-200">
                <div class="flex-1 p-10">
                    <h3 class="text-xl font-medium text-gray-700">{{ $task->title }}</h3>
                    <p class="mt-2 text-slate-500">Description : {{ $task->description }}</p>
                    <p class="mt-2 text-slate-500">Contexte : {{ $task->context }}</p>
                    <p class="mt-2 text-slate-500">Page concernée : <a target="_blank" href="{{ $task->url }}">{{ $task->url }}</a></p>

                    <div class="mt-4 flex gap-2">
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

                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-orange-50 px-2 py-1 text-xs font-semibold text-orange-600">
                            {{ $task->type }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
