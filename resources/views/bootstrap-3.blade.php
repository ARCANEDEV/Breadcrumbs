@if ($breadcrumbs)
    <ul class="breadcrumb breadcrumb-top">
        @foreach ($breadcrumbs as $breadcrumb)
            <?php
                $icon = isset($breadcrumb['icon'])
                    ? '<i class="' . $breadcrumb['icon'] . '"></i> '
                    : '';
            ?>
            @if ($breadcrumb['url'] && ! $breadcrumb['last'])
                <li>
                    <a href="{{ $breadcrumb['url'] }}">{!! $icon !!}{{ $breadcrumb['title'] }}</a>
                </li>
            @else
                <li class="active">{!! $icon !!}{{ $breadcrumb['title'] }}</li>
            @endif
        @endforeach
    </ul>
@endif
