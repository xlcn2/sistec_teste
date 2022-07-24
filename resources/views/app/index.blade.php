<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template" />
    <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
    <meta name="robots" content="noindex,nofollow" />
    <title>SISTEC</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo-text.png" />
    <!-- Custom CSS -->
    <link href="https://cdn.oesmith.co.uk/morris-0.5.1.css" rel="stylesheet" />

    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

        body {
            font-family: "Open Sans", Arial;
            background: #ededed;
        }

        main {
            width: auto;
            margin: 10px auto;
            padding: 10px;
            background: #fff;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
            margin: 5px;
        }

        p {
            margin-top: 2rem;
            font-size: 13px;
        }

        .mr-1 {
            margin-bottom: 3px !important;
        }
        .cards{
              transition: transform .2s;
            float: left;
            margin:10px;
            width:150px;
        }
        .cards:hover {
  transform: scale(1.2); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
    </style>
</head>

<body>
   @include('../app.navbar')
    @include('../app.sidebar')
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <p style="font-size:25px; border-bottom: 2px solid grey; width:100%">TESTE SISTEC</p>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Início</a></li>

                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Painel de informações-->
        
        <div class="container">
            
            <center st>
                    @php
                     $valor = 0;
                    @endphp
                    @foreach($clientes as $cliente)
                     @php
                      $valor =  $valor + 1;
                     @endphp  
                    @endforeach
                <div class="col-2 mt-3 cards">
                    <div class="bg-info p-10 text-white text-center">
                        <i class=" fas fa-user-plus fs-3 mb-1 font-16"></i>
                     
                        <h5 class="mb-0 mt-1">{{$valor}}</h5>
                        <small class="font-light">Clientes</small>
                    </div>
                </div>
                 @php
                     $valor = 0;
                    @endphp
                    @foreach($produtos as $produto)
                     @php
                      $valor =  $valor + 1;
                     @endphp  
                    @endforeach
                <div class="col-2 mt-3 cards">
                    <div class="bg-info p-10 text-white text-center">
                        <i class="far fa-calendar-alt fs-3 mb-1 font-16"></i>
                        <h5 class="mb-0 mt-1">{{$valor}}</h5>
                        <small class="font-light">Produtos</small>
                    </div>
                </div>
                
                
               
            </center>
            <!-- column -->
            <br><br><br><br><br><br>
       
            <div class="row" style="float:left">
                 <hr>
                <div class="col" >
                    <div class="card text-white bg-info mb-3" style="width: 400px;height:300px">
                        <div class="card-header">CADASTROS</div>
                        <div class="card-body bg-dark">
                            <h5 class="card-title">Cadastros</h5>
                            <a  href="./clientes" class="btn btn-info btn-sm mr-1"><i class="mdi mdi-account-multiple"></i> Clientes</a>
                              <a href="./produtos" class="btn btn-info btn-sm mr-1"><i class="mdi mdi-format-list-bulleted-type"></i> Produtos</a>
                            
                        
                        </div>
                    </div> <!-- Fim do DIV CARD -->
                </div>

     
                
            </div>
           
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
    
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->

        <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <!--Wave Effects -->
        <script src="../dist/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="../dist/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="../dist/js/custom.min.js"></script>
        <!--This page JavaScript -->
        <!-- <script src="../dist/js/pages/dashboards/dashboard1.js"></script> -->
        <!-- Charts js Files -->
        <script src="../assets/libs/flot/excanvas.js"></script>
        <script src="../assets/libs/flot/jquery.flot.js"></script>
        <script src="../assets/libs/flot/jquery.flot.pie.js"></script>
        <script src="../assets/libs/flot/jquery.flot.time.js"></script>
        <script src="../assets/libs/flot/jquery.flot.stack.js"></script>
        <script src="../assets/libs/flot/jquery.flot.crosshair.js"></script>
        <script src="../assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
        <script src="../dist/js/pages/chart/chart-page-init.js"></script>
    </div>

</body>

</html>
