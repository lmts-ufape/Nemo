<body >
    @include('layouts.header')
    <div class="container">
        <!--Menu de Navegação-->
        @include('layouts.navigation')
        
        @include('layouts.body')
    </div>
    @include('layouts.footer')
    
    
    
    

</body>


<!--Scripts-->
@include('layouts.scripts')
<script src="{{asset('js/app.js')}}"></script>