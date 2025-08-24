<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 overflow-hidden shadow-sm sm:rounded-lg">

                <!-- Title section -->
                <section>
                    <h1 class="text-2xl mb-4">{{ $post->title }}</h1>
                </section>

                <!-- Avatar section -->
                <section class="flex items-center">
                    <div class="flex flex-1 gap-4">
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
                                {{ $post->creationDateFormat() }}
                            </div>
                        </div>
                    </div>

                    @if (Auth::user() && Auth::id() === $post->user->id)
                        <div class="flex gap-2">
                            <div>
                                <a href="{{ route('posts.edit', $post) }}">
                                    <x-primary-button>Edit</x-primary-button>
                                </a>
                            </div>

                            <div>
                                <form action="{{ route('posts.delete', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <x-danger-button>Delete</x-danger-button>
                                </form>
                            </div>
                        </div>
                    @endif

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

            </div>
        </div>
    </div>
</x-app-layout>
