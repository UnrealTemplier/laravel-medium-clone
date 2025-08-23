<x-app-layout>
    <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 text-gray-800 dark:text-gray-200 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg border-gray">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex">

                <!-- Posts section -->
                <section class="flex-1 pr-8">
                    <h1 class="text-5xl">{{ $user->name }}</h1>

                    <div class="mt-8">
                        @forelse($posts as $post)
                            <x-post-item :post="$post"/>
                        @empty
                            <div class="text-center text-gray-400 py-16">No Posts Found</div>
                        @endforelse
                    </div>

                </section>

                <!-- Sidebar section -->
                <section class="w-[320px] border-l dark:border-gray-500 px-8">

                    <x-follow-container :user="$user">
                        <x-user-avatar :user="$user" size="w-24 h-24"/>
                        <h3>{{ $user->name }}</h3>
                        <p class="text-gray-500">
                            <span x-text="followersLabel"></span>
                        </p>
                        <p>{{ $user->bio }}</p>

                        @if (Auth::user() && Auth::id() !== $user->id)
                            <div class="mt-4">
                                <button class="rounded-full px-4 py-2 text-white"
                                        x-text="following ? 'Unfollow' : 'Follow'"
                                        :class="following ? 'bg-red-500' : 'bg-emerald-500'"
                                        @click="toggleFollow()">
                                </button>
                            </div>
                        @endif
                    </x-follow-container>

                </section>

            </div>

        </div>
    </div>
</x-app-layout>
