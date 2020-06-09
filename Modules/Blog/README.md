# Laravel - Blog Module

## Requirements
   

## Steps


## Backend

    ### Pages
        Index: http://mysite/blog/posts

    ### Menu
        {{-- BLOG MODULE --}}
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ __('Blog) }}
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route(app()->getLocale().'.blog.posts.index')}}">
                    {{ __('Posts') }}
                </a>
            </div>
        </li>


