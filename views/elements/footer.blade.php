<div class="container">
    <div class="row text-center text-light">
        <div class="col-md-4">
            <h4>{{ trans('theme::gmod.footer.social') }}</h4>
            @foreach(['twitter', 'youtube', 'discord', 'steam', 'teamspeak', 'instagram'] as $social)
                @if($socialLink = theme_config("footer_social_{$social}"))
                    <li class="list-group">
                        <a href="{{ $socialLink }}" target="_blank" rel="noreferrer noopener"
                           title="{{ trans('theme::prism.links.'.$social) }}"><span class="icon"><i
                                    class="fab fa-{{ $social }} fa-2x"></i></span>{{ trans('theme::gmod.links.'.$social) }}
                        </a>
                    </li>
                @endif
            @endforeach
        </div>
        <div class="col-md-4 links">
            <h4>{{ trans('theme::gmod.footer.links') }}</h4>
            <ul class="list-unstyled">
                @foreach(theme_config('footer_links') ?? [] as $link)
                    <li>
                        <a href="{{ $link['value'] }}"><i class="fas fa-chevron-right"></i> {{ $link['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-4 brand d-flex align-items-center">
            <div>
                <div class="brand-footer mb-3 d-flex align-self-center justify-content-center">
                    <h4>{{ site_name() }}</h4>
                    <div class="vertical-divide"></div>
                    <img src="{{ site_logo() }}" alt="{{ site_name() }}" class="img-fluid">
                </div>
                <span class="copy-text">{{ setting('copyright') }}</span>
                <span class="copy-text">@lang('messages.copyright')</span>
            </div>
        </div>
    </div>
</div>
