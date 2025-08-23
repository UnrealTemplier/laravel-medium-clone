@props(['user', 'size' => 'w-12 h12'])

@if ($user->avatar)
    <img src="{{ $user->avatarUrl() }}"
         alt="{{ $user->username }}"
         class="rounded {{ $size }}"/>
@else
    <img src="https://static.everypixel.com/ep-pixabay/0329/8099/0858/84037/3298099085884037069-head.png"
         alt="Dummy avatar"
         class="rounded {{ $size }}"/>
@endif
