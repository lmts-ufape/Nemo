<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <!--<title>{{ config('app.name', 'Laravel') }}</title> -->
        <title>@yield('titulo')Nemo</title>
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet">
    
        <script type="text/javascript">
            /* Máscaras ER */
            function mascara(o,f){
                v_obj=o
                v_fun=f
                setTimeout("execmascara()",1)
            }
            function execmascara(){
                v_obj.value=v_fun(v_obj.value)
            }
            function mtel(v){
                v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
                v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
                v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
                return v;
            }
            function id( el ){
                return document.getElementById( el );
            }
            window.onload = function(){
                id('telefone').onkeypress = function(){
                    mascara( this, mtel );
                }
            }
        </script>
    
        <style type="text/css">
            .panel-default > .panel-heading {
                color: #fff;
                background-color: #1B2E4F;
                border-color: #d3e0e9;
            }
            /* Select2 Selects CSS - Start */
            .select2-container--bootstrap .select2-selection--single .select2-selection__placeholder  {
                color: #555;
            }
            .select2-container--bootstrap .select2-results__option {
                color: #555;
                background-color: #fff;
            }
            .select2-container--bootstrap .select2-results__option--highlighted[aria-selected] {
                color: #fff;
                background-color: #bbb;
            }
            .select2-container--bootstrap .select2-selection--single {
                height: 36px;
                padding: 6px 18px;
                margin-left: 0px;
            }
            /* Select2 Selects CSS - End */
            #termo {
              width: 100%;
              font-size: 16px;
              padding: 12px 20px 12px 40px;
              border: 1px solid #ddd;
              margin-bottom: 12px;
            }
            .navbar-default .navbar-nav > .dropdown > a:focus, .navbar-default .navbar-nav > .dropdown > a:hover {
                color: #fff;
                background-color: #1B2E4F;
                max-width: 10px
            }
            .navbar-default .navbar-nav > .open > a:focus, .navbar-default .navbar-nav > .open > a:hover {
                color: #000;
                background-color: #fff;
            }
            .navbar-default .navbar-nav > a, .navbar-default .navbar-nav > li > a {
                color: #fff;
            }
            .navbar-default .navbar-nav > li > a:hover, {
                color: #fff;
                background-color: #fff;
            }
            .dropdown-menu > li > a:hover {
                background-color: #cccccc;
            }
            .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-text {
                color: #000;
                background-color: #fff;
            }
            @media (max-width: 1024px) {
              #barra-logos{display: none;}
              .btn-toggle{display: block;}
            }
            @media only screen and (max-width: 1024px) {
                /* Force table to not be like tables anymore */
                #tabela table,
                #tabela thead,
                #tabela tbody,
              #tabela tfoot,
                #tabela th,
                #tabela td,
                #tabela tr {
                    display: block;
                }
                /* Hide table headers (but not display: none;, for accessibility) */
                #tabela thead tr {
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }
                #tabela tr { border: 1px solid #ccc; }
                #tabela td {
                    /* Behave  like a "row" */
                    border: none;
                    border-bottom: 1px solid #eee;
                    position: relative;
                    padding-left: 50%;
                    white-space: normal;
                    text-align:left;
                }
                #tabela td:before {
                    /* Now like a table header */
                    position: absolute;
                    /* Top/left values mimic padding */
                    top: 6px;
                    left: 6px;
                    width: 45%;
                    padding-right: 10px;
                    white-space: nowrap;
                    text-align:left;
                    font-weight: bold;
                }
                /*
                Label the data
                */
                #tabela td:before { content: attr(data-title); }
            }
            .dropbtn {
              background-color: #3097D1;
              color: white;
              padding: 16px;
              font-size: 16px;
              border: none;
              cursor: pointer;
            }
            .dropbtndisabled {
              background-color: #8eb4cb;;
              color: white;
              padding: 16px;
              font-size: 16px;
              border: none;
              cursor: pointer;
            }
            /* The container <div> - needed to position the dropdown content */
            .dropdown {
              position: relative;
              display: inline-block;
            }
            /* Dropdown Content (Hidden by Default) */
            .dropdown-content {
              display: none;
              position: absolute;
              background-color: #8eb4cb;
              min-width: 160px;
              box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
              z-index: 1;
            }
            /* Links inside the dropdown */
            .dropdown-content a {
              color: black;
              padding: 12px 16px;
              text-decoration: none;
              display: block;
            }
            /* Change color of dropdown links on hover */
            .dropdown-content a:hover {background-color: #f1f1f1}
            /* Show the dropdown menu on hover */
            .dropdown:hover .dropdown-content {
              display: block;
            }
            /* Change the background color of the dropdown button when the dropdown content is shown */
            .dropdown:hover .dropbtn {
              background-color: #3097D1;
            }
        </style>
    
    </head>