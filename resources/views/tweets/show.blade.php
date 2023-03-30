<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Home
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('dashboard') }}" class="text-gray-500 ml-3">< Back</a>
                    <div class="card-body">
                        <h1 class="card-title">{{ $tweets->user->name }}</h1>
                        <p>{{ $tweets->text }}</p>
                        <div class="text-end">
                            @can('edit', $tweets)
                            <a href="{{ route('tweets.edit', $tweets) }}" class="text-blue-500">Edit</a>
                            @endcan
                            @can('destroy', $tweets)
                            <form action="{{ route('tweets.destroy', $tweets) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                            @endcan
                            <span class="text-gray-500">{{ $tweets->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="my-6">
                            <h1 class="mt-6 mb-3 text-lg font-semibold">Comments</h1>
                            <form action="{{ route('comments.store', $tweets->id) }}" method="POST">
                                @csrf
                                <textarea name="text" id="text" cols="30" rows="10" class="input input-bordered w-full" placeholder="Tweet something..."></textarea>
                                <br>
                                <input type="submit" class="btn btn-primary">
                            </form>
                            @foreach($tweets->comments as $comment)
                            <div class="card card-side bg-base-100 shadow-xl my-3">
                                <div class="card-body">
                                    <h1 class="card-title">{{ $comment->user->name }}</h1>
                                    <p>{{ $comment->text }}</p>
                                    <div class="text-end">
                                        @can('edit', $comment)
                                        <a href="{{ route('comments.edit', [$tweets->id, $comment->id]) }}" class="text-blue-500">Edit</a>
                                        @endcan
                                        @can('destroy', $comment)
                                        <form action="{{ route('comments.destroy', [$tweets->id, $comment->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                        @endcan
                                        <span class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
