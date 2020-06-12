@php $locale = LaravelLocalization::setLocale() ?: App::getLocale(); @endphp

<ul class="list-group list-group-horizontal">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <li class="list-group-item {{$locale==$localeCode?"list-group-item-primary":"list-group-item-secondary"}}">
            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
            </a>
        </li>
    @endforeach
</ul>
