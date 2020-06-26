@extends('layouts.app')

@section('title', trans('messages.home'))

@section('content')
    <div class="welcome p-5">
        <div class="container">
            <div class="row justify-content-center align-items-center text-center text-white">
                <div class="col-md-8">
                    @if(theme_config('title'))
                        <h1>{{ theme_config('title') }}</h1>
                    @endif
                    @if(theme_config('description'))
                        <p>{{ theme_config('description') }}</p>
                    @endif
                    @if(theme_config('show_server'))
                        <div class="server p-3">
                            @if($server)
                                @if($server->isOnline())
                                    <h1 class="mb-1">{{ $server->name }}</h1>
                                    <h2 class="mb-1">IP: {{ $server->fullAddress() }}</h2>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success font-weight-bold" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{ trans_choice('theme::gmod.header.online', $server->getOnlinePlayers()) }}</div>
                                    </div>
                                @else
                                    <h1 class="mb-1">{{ $server->name }}</h1>
                                    <h2 class="mb-1">IP: {{ $server->fullAddress() }}</h2>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger font-weight-bold" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{ trans('theme::gmod.header.offline') }}
                                        </div>
                                    </div>
                                @endif
                                @else
                                <h1>{{ trans('theme::gmod.header.unknow') }}</h1>
                            @endif
                            @if(theme_config('button'))
                                <a href="{{ theme_config('button_link') }}"
                                   class="btn btn-lg btn-success mt-4">{{ theme_config('title_button') }}</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(! $posts->isEmpty())
    <div class="container post">
        <h1 class="mt-3 mb-4">{{ trans('theme::gmod.post.post') }}</h1>
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="post-preview">
                        <a href="{{ route('posts.show', $post->slug) }}" class="link-unstyled">
                            @if($post->hasImage())
                                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="img-fluid rounded">

                                <div class="h4 pt-3 pl-3">{{ $post->title }}</div>
                                <div class="h6 pl-3"><i class="far fa-clock pr-2"></i>{{ trans('messages.posts.posted', ['date' => format_date($post->published_at), 'user' => $post->author->name]) }}
                                </div>

                            @else
                                <div class="preview-content p-4">
                                    <h2 class="pl-3">{{ $post->title }}</h2>
                                    <p>{{ Str::limit(strip_tags($post->content), 300, '...') }}</p>
                                    <div class="h6 pl-3"><i class="far fa-clock pr-2"></i>{{ trans('messages.posts.posted', ['date' => format_date($post->published_at), 'user' => $post->author->name]) }}
                                    </div>
                                </div>
                            @endif
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
@endsection
