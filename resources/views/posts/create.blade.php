<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <!-- Image -->
                    <div>
                        <x-input-label for="image" :value="__('Image')"/>
                        <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required/>
                        <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                    </div>

                    <!-- Title -->
                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Title')"/>
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus/>
                        <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                    </div>

                    <!-- Category -->
                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Category')"/>
                        <select id="category_id" name="category_id"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Select a Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    @selected(old('category_id') == $category->id)
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
                    </div>

                    <!-- Content -->
                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Content')"/>
                        <x-text-area id="content" class="block mt-1 w-full" type="text" name="content" required>
                            {{ old('content') }}
                        </x-text-area>
                        <x-input-error :messages="$errors->get('content')" class="mt-2"/>
                    </div>

                    <!-- Submit -->
                    <x-primary-button class="mt-4">
                        Submit
                    </x-primary-button>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
