<meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <style type="text/css">
                body{
            padding-bottom:4.2rem;
            }
            a{
             text-decoration:none !important;
             }
             h1,h2,h3{
             font-family: 'Kaushan Script', cursive;
             }
              .myform{
            position: relative;
            display: -ms-flexbox;
            display: flex;
            padding: 1rem;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0,0,0,0.2);
            border-radius: 1.1rem;
            outline: 0;
            max-width: 500px;
             }
             .tx-tfm{
             text-transform:uppercase;
             }
             .mybtn{
             border-radius:50px;
             }
            
             .login-or {
             position: relative;
             color: #aaa;
             margin-top: 10px;
             margin-bottom: 10px;
             padding-top: 10px;
             padding-bottom: 10px;
             }
             .span-or {
             display: block;
             position: absolute;
             left: 50%;
             top: -2px;
             margin-left: -25px;
             background-color: #fff;
             width: 50px;
             text-align: center;
             }
             .hr-or {
             height: 1px;
             margin-top: 0px !important;
             margin-bottom: 0px !important;
             }
             .google {
             color:#666;
             width:100%;
             height:40px;
             text-align:center;
             outline:none;
             border: 1px solid lightgrey;
             }
              form .error {
             color: #ff0000;
             }
             #second{display:none;}    </style>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            window.alert = function(){};
            var defaultCSS = document.getElementById('bootstrap-css');
            function changeCSS(css){
                if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
                else $('head > link').filter(':first').replaceWith(defaultCSS); 
            }
            $( document ).ready(function() {
              var iframe_height = parseInt($('html').height()); 
              window.parent.postMessage( iframe_height, 'https://bootsnipp.com');
            });
        </script>
    </head>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">