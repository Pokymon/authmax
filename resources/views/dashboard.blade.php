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
                    <form action="{{ route('tweets.store') }}" method="POST">
                        @csrf
                        <textarea name="text" id="text" cols="30" rows="10" class="input input-bordered w-full" placeholder="Tweet something..."></textarea>
                        <br>
                        <button type="submit" class="btn btn-primary">Tweet</button>
                    </form>
                    <div class="my-6">
                        @foreach($tweets as $tweet)
                        <a href="{{ route('tweets.show', $tweet) }}">
                            <div class="card card-side bg-base-100 shadow-xl my-3">
                                <div class="card-body">
                                    <h1 class="card-title">{{ $tweet->user->name }}</h1>
                                    <p>{{ $tweet->text }}</p>
                                    <div class="text-end">
                                        @can('edit', $tweet)
                                        <a href="{{ route('tweets.edit', $tweet) }}" class="text-blue-500">Edit</a>
                                        @endcan
                                        @can('destroy', $tweet)
                                        <form action="{{ route('tweets.destroy', $tweet) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                        @endcan
                                        <span class="text-gray-500">{{ $tweet->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
