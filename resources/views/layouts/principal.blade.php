<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('definitions.head')

<body>
    <div type="container" id="site">
        @include('layouts.header')
        <div class="container">
            @include('layouts.body')
        </div>
        @include('layouts.footer')
    </div>
</body>
@include('layouts.scripts')

</html>