<ul class="list-group list-group-horizontal">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <li class="list-group-item list-group-item-secondary">
            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
            </a>
        </li>
    @endforeach
</ul>
