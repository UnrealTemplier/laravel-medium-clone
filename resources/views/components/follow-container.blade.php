@props(['user'])

<div x-data="{
        following: {{ $user->isFollowedBy(Auth::user()) ? 'true' : 'false' }},
        followersCount: {{ $user->followers()->count() }},
        followersLabel: 'followers',
        updateFollowersLabel() {
            this.followersLabel = this.followersCount == 1
                ? '1 follower'
                : this.followersCount + ' followers'
        },
        toggleFollow() {
            this.following = !this.following
            axios.post('/follow/{{ $user->id }}')
                .then(res => {
                    this.followersCount = res.data.followersCount
                    this.updateFollowersLabel()
                })
                .catch(err => {
                    console.error(err)
                })
        }
     }"
     x-init="updateFollowersLabel()"
     {{ $attributes }}
>
    {{ $slot }}
</div>
