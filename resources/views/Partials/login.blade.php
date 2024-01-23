<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets') }}/" data-template="vertical-menu-template-free">

    @include('Partials.headAuth')
    <body>
        @yield('content')                
        @include('Partials.script')
    </body>
