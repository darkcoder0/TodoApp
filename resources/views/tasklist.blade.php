    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo App</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl text-center font-bold mb-4">Todo List</h1>

            @if (session()->has('success'))
                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    <span class="font-medium"> {{ session()->get('success') }}</span>
                </div>
            @endif

            @if (session()->has('delete'))
                <div class="p-4 mb-4 text-sm text-red-600 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <span class="font-medium"> {{ session()->get('delete') }}</span>
                </div>
            @endif

            <div class="mb-4 flex justify-center ">
                <form method="post"
                    @if (isset($edittask)) action="{{ route('update', $edittask->id) }}" @else action="{{ route('addtask') }}" @endif>
                    @csrf
                    <input type="text"
                        class="w-half px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Add a new todo" name="task"
                        @if (isset($edittask)) value="{{ $edittask->task_name }}" @endif>

                    @error('task')
                        <span class="text-red-700">{{ $errors->first('task') }}</span>
                    @enderror
                    <input type="textarea"
                        class="w-half ml-2 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Description" name="desc"
                        @if (isset($edittask)) value="{{ $edittask->description }}" @endif>
                    @error('desc')
                        <span class="text-red-700">{{ $errors->first('desc') }}</span>
                    @enderror
                    <input type="date"
                        class="w-half ml-2 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Add a new todo" name="due_date" min="{{ date('Y-m-d') }}"
                        @if (isset($edittask)) value="{{ $edittask->due_date }}" @endif>
                    @error('due_date')
                        <span class="text-red-700">{{ $errors->first('due_date') }}</span>
                    @enderror

                    <button class="ml-2 px-4 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-700">
                        @if (isset($edittask))
                            Update
                        @else
                            AddTask
                        @endif

                    </button>
                </form>
            </div>

            <div class="text-center">
                <ul class="list-none">
                    @forelse ($tasklist as $task)
                        <li class="py-1">
                            <div class="w-50 h-50 bg-white rounded-md shadow-md overflow-hidden">
                                <div class="flex justify-between px-4 py-2">
                                    @if ($task->status == 'pending')
                                        <span class="text-red-500">{{ Str::upper($task->status) }}</span>
                                    @else
                                        <span class="text-green-500">{{ Str::upper($task->status) }}</span>
                                    @endif
                                    {{-- <button class="focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 17a1 1 0 0 1-1-1v-4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H3zm12-2a1 1 0 0 1-1-1v-4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1h-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button> --}}
                                </div>
                                <div class="px-4 py-1">
                                    <p class="text-gray-700 text-xl font-bold">{{ $task->task_name }}</p>
                                    <p class="text-gray-700">{{ $task->description }}</p>
                                    <p class="text-gray-700">{{ $task->due_date }}</p>
                                </div>
                                <div class="px-4 py-2 flex">
                                    <a href="{{ route('taskdone', $task->id) }}"
                                        class="ml-2 px-4 py-2 rounded-md @if ($task->status == 'pending') border-solid border-2 border-sky-500 text-black @else border-solid border-2 bg-sky-600 text-white @endif   hover:bg-sky-500">
                                        Task Done </a>
                                    <form method="POST" action="{{ route('deletetask', $task->id) }}">
                                        @csrf
                                        <button type="submit"
                                            class="ml-2 px-4 py-2 rounded-md bg-red-500 text-white hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                    <a href="{{ route('edit', $task->id) }}"
                                        class="ml-2 px-4 py-2 rounded-md bg-green-500 text-white hover:bg-green-700">
                                        Update </a>
                                </div>
                            </div>
                        </li>
                    @empty
                        <p>I have no Task .......</p>
                    @endforelse
                </ul>
                {{ $tasklist->links() }}
            </div>
        </div>
    </body>

    </html>
