@can("blog.posts.index")
<li class="nav-item dropdown">

    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ __('blog::common.module') }}
    </a>

    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

        @can("blog.posts.index")
        <a class="dropdown-item" href="{{route(app()->getLocale().'.admin.blog.posts.index')}}">
            {{ __('blog::posts.title.posts') }}
        </a>
        @endcan

        @can("blog.categories.index")
        <a class="dropdown-item" href="{{route(app()->getLocale().'.admin.blog.categories.index')}}">
            {{ __('blog::categories.title.categories') }}
        </a>
        @endcan

    </div>

</li>
@endcan
