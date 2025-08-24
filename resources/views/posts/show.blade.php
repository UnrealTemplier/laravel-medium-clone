<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 overflow-hidden shadow-sm sm:rounded-lg">

                <!-- Title section -->
                <section>
                    <h1 class="text-2xl mb-4">{{ $post->title }}</h1>
                </section>

                <!-- Avatar section -->
                <section>
                    <div class="flex gap-4">
                        <x-user-avatar :user="$post->user"/>

                        <div>

                            <x-follow-container :user="$post->user" class="flex gap-2">
                                <a href="{{ route('profile.show', $post->user) }}" class="hover:underline">{{ $post->user->name }}</a>
                                @auth
                                    &middot;
                                <button x-text="following ? 'Unfollow' : 'Follow'"
                                        :class="following ? 'text-red-500' : 'text-emerald-500'"
                                        @click="toggleFollow()">
                                </button>
                                @endauth
                            </x-follow-container>

                            <div class="flex gap-2 text-sm text-gray-500">
                                {{ $post->readTime() }} min read
                                &middot;
                                {{ $post->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </section>

                @auth
                    <!-- Likes section -->
                    <x-like-button :post="$post"/>
                @endauth

                <!-- Content section -->
                <section class="mt-8">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="w-full"/>

                    <div class="mt-4">
                        {{ $post->content }}
                    </div>
                </section>

                <!-- Category section -->
                <section class="mt-8">
                    <span class="px-4 py-2 rounded-2xl dark:text-gray-400 dark:bg-gray-700">{{ $post->category->name }}</span>
                </section>

                @auth
                    <!-- Another likes section -->
                    <x-like-button :post="$post"/>
                @endauth

            </div>
        </div>
    </div>
</x-app-layout>
