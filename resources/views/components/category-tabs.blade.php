@php
    $activeCategoryClasses = 'inline-block px-4 py-2
                              text-white dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700
                              dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300
                              focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                              transition ease-in-out duration-150
                              bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md active';

    $inactiveCategoryClasses = 'inline-block px-4 py-2 rounded-lg
                                hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white';
@endphp

<ul class="flex flex-wrap justify-center text-sm font-medium text-center text-gray-500 dark:text-gray-400">
    <li class="me-2">
        <a href="{{ route('dashboard') }}"
           class="{{ Route::currentRouteNamed('dashboard') ? $activeCategoryClasses : $inactiveCategoryClasses }}"
           aria-current="page">
            All
        </a>
    </li>

    @foreach($categories as $category)
        <li class="me-2">
            <a href="{{ route('posts.byCategory', $category) }}"
               class="{{ Route::currentRouteNamed('posts.byCategory') && request('category')->id == $category->id
                        ? $activeCategoryClasses
                        : $inactiveCategoryClasses }}"
            >
                {{ $category->name }}
            </a>
        </li>
    @endforeach

</ul>

