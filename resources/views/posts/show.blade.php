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
                        @if ($post->user->avatar)
                            <img src="{{ $post->user->avatarUrl() }}"
                                 alt="{{ $post->user->username }}"
                                 class="rounded w-12 h-12"/>
                        @else
                            <img src="https://static.everypixel.com/ep-pixabay/0329/8099/0858/84037/3298099085884037069-head.png"
                                 alt="Dummy avatar"
                                 class="rounded w-12 h-12"/>
                        @endif

                        <div>
                            <div class="flex gap-2">
                                <h3>{{ $post->user->name }}</h3>
                                &middot;
                                <a href="#" class="text-emerald-500">Follow</a>
                            </div>

                            <div class="flex gap-2 text-sm text-gray-500">
                                {{ $post->readTime() }} min read
                                &middot;
                                {{ $post->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Likes section -->
                <x-like-button/>

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

                <!-- Another likes section -->
                <x-like-button/>

            </div>
        </div>
    </div>
</x-app-layout>
