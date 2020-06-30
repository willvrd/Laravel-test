@can("user.users.index")
<li class="nav-item dropdown">

    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ __('user::common.module') }}
    </a>

    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

        @can("user.users.index")
        <a class="dropdown-item" href="{{route(app()->getLocale().'.admin.user.users.index')}}">
            {{ __('user::users.title.users') }}
        </a>
        <div class="dropdown-divider"></div>
        @endcan

        <a class="dropdown-item" href="{{route(app()->getLocale().'.admin.user.passport.index')}}">
            {{ __('user::passport.title.passport') }}
        </a>

    </div>

</li>
@endcan
