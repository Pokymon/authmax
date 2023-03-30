<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit a tweet
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('tweets.update', $tweets) }}" method="POST">
                        @csrf
                        @method('put')
                        <textarea name="text" id="text" cols="30" rows="10" class="input input-bordered w-full" placeholder="Tweet something..."></textarea>
                        <br>
                        <button type="submit" class="btn btn-primary">Tweet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
