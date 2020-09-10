@if ($breadcrumbs)
<nav role="navigation">
    <ul class="breadcrumbs">
        @foreach ($breadcrumbs as $crumb)
            @php($icon = isset($crumb['icon']) ? '<i class="' . $crumb['icon'] . '"></i> ' : '')

            @if ($crumb['url'] && ! $crumb['last'])
                <li>
                    <a href="{{ $crumb['url'] }}">{!! $icon !!}{{ $crumb['title'] }}</a>
                </li>
            @else
                <li>
                    <span class="show-for-sr">Current: </span> {!! $icon !!}{{ $crumb['title'] }}
                </li>
            @endif
        @endforeach
    </ul>
</nav>
@endif
