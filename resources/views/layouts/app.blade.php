<body >
    @include('layouts.header')
    <div class="container">
        <!--Menu de Navegação-->
        @include('layouts.navigation')
        
    </div>
    @include('layouts.body')
    @include('layouts.footer')
    
    
    
    

</body>


<!--Scripts-->
@include('layouts.scripts')
<script src="{{asset('js/app.js')}}"></script>