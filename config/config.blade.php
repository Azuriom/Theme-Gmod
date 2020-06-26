@extends('admin.layouts.admin')

@section('footer_description', 'Theme config')

@push('footer-scripts')
    <script>
        function addLinkListener(el) {
            el.addEventListener('click', function () {
                const element = el.parentNode.parentNode.parentNode.parentNode;

                element.parentNode.removeChild(element);
            });
        }

        document.querySelectorAll('.link-remove').forEach(function (el) {
            addLinkListener(el);
        });

        document.getElementById('addLinkButton').addEventListener('click', function () {
            let input = '<div class="form-row"><div class="form-group col-md-6">';
            input += '<input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div>';
            input += '<div class="form-group col-md-6"><div class="input-group">';
            input += '<input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}">';
            input += '<div class="input-group-append"><button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="fas fa-times"></i></button></div></div></div></div>';

            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('links').appendChild(newElement);
        });

        document.getElementById('configForm').addEventListener('submit', function () {
            let i = 0;

            document.getElementById('links').querySelectorAll('.form-row').forEach(function (el) {
                el.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace('{index}', i.toString());
                });

                i++;
            });
        });
    </script>
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST" id="configForm">
                @csrf

                <div class="form-group">
                    <label for="titleInput">{{ trans('theme::gmod.config.home_title') }}</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleInput" name="title" value="{{ old('title', theme_config('title')) }}">

                    @error('title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="DescriptionInput">{{ trans('theme::gmod.config.home_description') }}</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="DescriptionInput" name="description" rows="3">{{ old('description', theme_config('description')) }}</textarea>

                    @error('description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                @php $showServer = old('show_server', theme_config('show_server')) === 'on' @endphp

                <div class="form-group custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="showServerSwitch" name="show_server" data-toggle="collapse" data-target="#showServerGroup" @if($showServer) checked @endif>
                    <label class="custom-control-label" for="showServerSwitch">{{ trans('theme::gmod.config.show_server') }}</label>
                </div>

                <div id="showServerGroup" class="{{ $showServer ? 'show' : 'collapse' }}">
                    @php $button = old('button', theme_config('button')) === 'on' @endphp

                    <div class="form-group custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="buttonSwitch" name="button" data-toggle="collapse" data-target="#buttonGroup" @if($button) checked @endif>
                        <label class="custom-control-label" for="buttonSwitch">{{ trans('theme::gmod.config.use_button') }}</label>
                    </div>

                    <div id="buttonGroup" class="{{ $button ? 'show' : 'collapse' }}">
                        <div class="card card-body mb-2">
                            <div class="form-group">
                                <label for="titleButtonInput">{{ trans('theme::gmod.config.button_title') }}</label>
                                <input type="text" class="form-control @error('title_button') is-invalid @enderror" id="titleButton" name="title_button" value="{{ old('title_button', theme_config('title_button')) }}">

                                @error('title_button')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="buttonLink">{{ trans('theme::gmod.config.button_link') }}</label>
                                <input type="text" class="form-control @error('button_link') is-invalid @enderror" id="buttonLink" name="button_link" value="{{ old('button_link', theme_config('button_link')) }}">

                                @error('button_link')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                @foreach(['twitter', 'youtube', 'discord', 'steam', 'teamspeak', 'instagram'] as $social)
                    <div class="form-group">
                        <label for="{{ $social }}Input">{{ trans('theme::gmod.links.'.$social) }}</label>
                        <input type="text" class="form-control @error('footer_social_'.$social) is-invalid @enderror" id="{{ $social }}Input" name="footer_social_{{ $social }}" value="{{ old('footer_social_'.$social, theme_config('footer_social_'.$social)) }}">

                        @error('footer_social_'.$social)
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                @endforeach

                <label>{{ trans('theme::gmod.config.footer_links') }}</label>

                <div id="links">

                    @foreach(theme_config('footer_links') ?? [] as $link)
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}" value="{{ $link['name'] }}">
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}" value="{{ $link['value'] }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger link-remove" type="button">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-2">
                    <button type="button" id="addLinkButton" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i> {{ trans('messages.actions.add') }}
                    </button>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection
