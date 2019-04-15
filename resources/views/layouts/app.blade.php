<body style="min-height:500px">
    @include('layouts.header')
    <div class="container">
        <!--Menu de Navegação-->
        @include('layouts.navigation')
        
        @include('layouts.body')
    </div>
    <br>
    
    
    

</body>
@include('layouts.footer')


<!--Scripts-->
@include('layouts.scripts')
<script src="{{asset('js/app.js')}}"></script>