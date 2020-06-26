@extends('layouts.app')

@section('content')
    <div class="container content-parent pt-5">
        <h1 class="text-center text-uppercase"><span class="text-center page-title">{{ trans('errors.error') }}</span></h1>

        <div class="content">

            <div class="card-body text-center text-primary">
                <h1>@yield('code')</h1>
                <h2>@yield('title')</h2>
                <p>@yield('message')</p>

                <a href="{{ route('home') }}" class="btn btn-primary"><i class="fas fa-home pr-2"></i>{{ trans('errors.home') }}</a>
                <p class="pt-2">Or take a coffee <i class="fas fa-coffee"></i></p>
            </div>
        </div>
    </div>
@endsection
