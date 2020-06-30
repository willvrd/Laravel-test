@php $locale = LaravelLocalization::setLocale() ?: App::getLocale(); @endphp

<div id="cardLocale" class="position-fixed mt-5 pt-5">
    <ul class="list-group">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li class="list-group-item {{$locale==$localeCode?"list-group-item-primary":"list-group-item-secondary"}}">
                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

