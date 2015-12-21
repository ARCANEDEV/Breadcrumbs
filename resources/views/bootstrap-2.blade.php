@if ($breadcrumbs)
    <ul class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            <?php
                $icon = isset($breadcrumb['icon'])
                    ? '<i class="' . $breadcrumb['icon'] . '"></i> '
                    : '';
            ?>
            @if ($breadcrumb['last'])
                <li class="active">{!! $icon !!}{{ $breadcrumb['title'] }}</li>
            @elseif ($breadcrumb->url)
                <li>
                    <a href="{{ $breadcrumb['url'] }}">{!! $icon !!}{{ $breadcrumb['title'] }}</a>
                    <span class="divider">/</span>
                </li>
            @else
                {{-- Using .active to give it the right colour (grey by default) --}}
                <li class="active">
                    {!! $icon !!}{{ $breadcrumb['title'] }}
                    <span class="divider">/</span>
                </li>
            @endif
        @endforeach
    </ul>
@endif
