<div id="navigation">
    @if(Auth::check())
        <hr>
        @yield('path')
        <hr>
    @else
        <br>
    @endif
</div>