<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Notifications
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex text-right">
                        <form action="{{ route('notifications.read-all') }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-primary btn-sm">Mark as read</button>
                        </form>
                    </div>
                    @forelse($notifications as $notification)
                        <a href="{{ route('tweets.show', $notification->data['tweet']['id']) }}">
                            <div class="card card-side shadow-xl my-3 @if ($notification->read_at == null)
                                bg-gray-700
                            @endif">
                                <div class="card-body">
                                    <p><a href="{{ route('tweets.show', $notification->data['tweet']['id']) }}" class="font-bold">{{ $notification->data['user']['name'] }}</a> commented on your tweet.</p>
                                        <div class="card card-side bg-base-100 shadow-xl my-3">
                                            <div class="card-body">
                                                <p>{{ Str::limit($notification->data['text'], 100) }}</p>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="alert shadow-lg">
                            <span>There's no notification.</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
