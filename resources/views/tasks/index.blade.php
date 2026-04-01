<x-layout>
    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6">

        {{-- Title --}}
        <h1 class="text-xl font-semibold mb-4">
            To-Do List 📋
        </h1>

        {{-- Add Task --}}
        <form action="{{ route('tasks.store') }}" method="POST" class="flex gap-2 mb-4">
            @csrf
            <input 
                type="text" 
                name="title" 
                placeholder="Add your task"
                class="flex-1 px-4 py-2 rounded-full bg-gray-100 focus:outline-none"
            >
            <button class="bg-orange-500 text-white px-4 py-2 rounded-full">
                ADD
            </button>
        </form>

        {{-- Task List --}}
        <ul class="space-y-3">
            @forelse ($tasks as $task)
                <li class="flex items-center justify-between bg-gray-50 px-4 py-2 rounded-full">

                    {{-- Toggle Complete --}}
                    <form action="{{ route('tasks.update', $task['id']) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="flex items-center gap-3">
                            <button type="submit">
                                <input type="checkbox"
                                    {{ $task['completed'] ? 'checked' : '' }}
                                    class="w-4 h-4 accent-orange-500 pointer-events-none">
                            </button>

                            <span class="{{ $task['completed'] ? 'line-through text-gray-400' : '' }}">
                                {{ $task['title'] }}
                            </span>
                        </div>
                    </form>

                    {{-- Delete --}}
                    <form action="{{ route('tasks.destroy', $task['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="text-gray-400 hover:text-red-500">
                            ✕
                        </button>
                    </form>

                </li>
            @empty
                <p class="text-gray-400 text-center">No tasks yet</p>
            @endforelse
        </ul>

    </div>
</x-layout>