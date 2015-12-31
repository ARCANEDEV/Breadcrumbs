@if ($breadcrumbs)
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $crumb)
            <?php
                $icon = isset($crumb['icon']) ? '<i class="' . $crumb['icon'] . '"></i> ' : '';
            ?>

            @if ($crumb['url'] && ! $crumb['last'])
                <li>
                    <a href="{{ $crumb['url'] }}">{!! $icon !!}{{ $crumb['title'] }}</a>
                </li>
            @else
                <li class="active">{!! $icon !!}{{ $crumb['title'] }}</li>
            @endif
        @endforeach
    </ol>
@endif
