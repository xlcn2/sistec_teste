<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="stylesheet" type="text/css" href="../assets/extra-libs/multicheck/multicheck.css" />
    <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" />
    <meta name="robots" content="noindex,nofollow" />
    <title>SISTEC</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo-text.png" />
    <!-- Custom CSS -->
    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    @include('app.navbar')
    @include('app.sidebar')

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
                    <h4 class="page-title">produtos</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    produtos
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="container">
                       <center>
              @if(session()->has('message'))
            <p class="btn btn-success btn-block btn-sm custom_message text-left"  id="mensagem" style="color:white; border-radius:6px"><b><i class="fas fa-check"></i> {{ session()->get('message') }}</b></p>
            @endif
            
            </center>
            <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class=" fas fa-plus"></i> Adicionar
                </a>
            </p>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">

                    <form action="{{ route('produtos.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <b>Nome:</b>
                                <input type="text" name="nome" id="nome" value="" autofocus class="form-control" required />
                            </div>
                            <div class="col-md-3">
                                <b>Valor:</b>
                                <input type="text" name="valor" id="valor" onKeyPress="return(moeda(this,'.',',',event))"  class="form-control" required />
                            </div>
                            <div class="col-md-3">
                                <b>detalhes:</b>
                                <input name="detalhes" id="detalhes" value="" class="form-control" id="detalhes" type="text"  required />
                                <span id="detalhesResponse"></span>
                            </div>

                            <div class="col-md-2">
                                <br>
                                <button class="btn btn-primary" type="submit" name="cadastrar" value="save">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>


            <div class="table-responsive">
                <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th><b>Nome</b></th>
                            <th><b>Valor</b></th>
                            <th><b>detalhes</b></th>
                            <th><b>Ações</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                        <tr>
                            <td>{{ $produto->nome }}</td>
                            <td>R$ {{number_format($produto->valor,2,",","")}}</td>
                            <td>{{ $produto->detalhes }}</td>

                            <td class="text-center">
                               
                                <button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#editar{{ $produto->id }}">
                                    Editar
                                </button>
                                <a data-toggle="modal" data-target="#excluir{{ $produto->id }}">
                                    <button class="btn  btn-danger btn-sm" type="button">Excluir</button>
                                </a>

                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="editar{{ $produto->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('produto.update',$produto->id) }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <b>Nome:</b>
                                                    <input type="text" name="nome" id="nome" value="{{ $produto->nome }}" class="form-control" required />
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <b>detalhes:</b>
                                                    <input type="text" name="detalhes" id="detalhes" value="{{ $produto->detalhes }}" class="form-control" required />
                                                </div>
                                                <div class="col-md-5">
                                                    <b>Valor:</b>
                                                    <input type="text" name="valor" id="valor" value="{{ $produto->valor }}" onKeyPress="return(moeda(this,'.',',',event))"  class="form-control" required />
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <br>
                                                    <input type="hidden" name="id" value="" />
                                                    <button class="btn btn-primary" type="submit" name="editar">Atualizar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="excluir{{ $produto->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Excluir produto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <center>Deseja excluir esse {{ $produto->nome }} do sistema?</center>
                                        <br>
                                        <center>

                                            <form id="delete-{{$produto->id}}" method="post" action="{{route('produto.delete',$produto->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn  btn-danger btn-sm" style=" background: red; " data-toggle="modal" data-target="#excluir" type="submit">Excluir</button>
                                            </form>


                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">Cancelar</span>
                                            </button>
                                        </center>
                                    </div>

                                </div>

                            </div>
                        </div>


                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>

                            <th><b>Nome</b></th>
                            <th><b>Valor</b></th>
                            <th><b>detalhes</b></th>

                            <th><b>Ações</b></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>

        @include('app.footer')
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
    <script>
        function mask(o, f) {
            setTimeout(function() {
                var v = mphone(o.value);
                if (v != o.value) {
                    o.value = v;
                }
            }, 1);
        }

        function mphone(v) {
            var r = v.replace(/\D/g, "");
            r = r.replace(/^0/, "");
            if (r.length > 10) {
                r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
            } else if (r.length > 5) {
                r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
            } else if (r.length > 2) {
                r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
            } else {
                r = r.replace(/^(\d*)/, "($1");
            }
            return r;
        }

    </script>


    <script>
        function is_detalhes(c) {

            if ((c = c.replace(/[^\d]/g, "")).length != 11)
                return false

            if (c == "00000000000")
                return false;
            if (c == "11111111111")
                return false;
            if (c == "22222222222")
                return false;
            if (c == "33333333333")
                return false;
            if (c == "44444444444")
                return false;
            if (c == "55555555555")
                return false;
            if (c == "66666666666")
                return false;
            if (c == "77777777777")
                return false;
            if (c == "88888888888")
                return false;
            if (c == "99999999999")
                return false;

            var r;
            var s = 0;

            for (i = 1; i <= 9; i++)
                s = s + parseInt(c[i - 1]) * (11 - i);

            r = (s * 10) % 11;

            if ((r == 10) || (r == 11))
                r = 0;

            if (r != parseInt(c[9]))
                return false;

            s = 0;

            for (i = 1; i <= 10; i++)
                s = s + parseInt(c[i - 1]) * (12 - i);

            r = (s * 10) % 11;

            if ((r == 10) || (r == 11))
                r = 0;

            if (r != parseInt(c[10]))
                return false;

            return true;
        }


        function fMasc(objeto, mascara) {
            obj = objeto
            masc = mascara
            setTimeout("fMascEx()", 1)
        }

        function fMascEx() {
            obj.value = masc(obj.value)
        }

        function mdetalhes(detalhes) {
            detalhes = detalhes.replace(/\D/g, "")
            detalhes = detalhes.replace(/(\d{3})(\d)/, "$1.$2")
            detalhes = detalhes.replace(/(\d{3})(\d)/, "$1.$2")
            detalhes = detalhes.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
            return detalhes
        }

        detalhesCheck = function(el) {
            document.getElementById('detalhesResponse').innerHTML = is_detalhes(el.value) ? '<span style="color:green">válido</span>' : '<span style="color:red">inválido</span>';
            if (el.value == '') document.getElementById('detalhesResponse').innerHTML = '';
        }

    </script>
    
     <script language="javascript">
        function moeda(a, e, r, t) {
            let n = "",
                h = j = 0,
                u = tamanho2 = 0,
                l = ajd2 = "",
                o = window.Event ? t.which : t.keyCode;
            if (13 == o || 8 == o)
                return !0;
            if (n = String.fromCharCode(o),
                -1 == "0123456789".indexOf(n))
                return !1;
            for (u = a.value.length,
                h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
            ;
            for (l = ""; h < u; h++)
                -
                1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
            if (l += n,
                0 == (u = l.length) && (a.value = ""),
                1 == u && (a.value = "0" + r + "0" + l),
                2 == u && (a.value = "0" + r + l),
                u > 2) {
                for (ajd2 = "",
                    j = 0,
                    h = u - 3; h >= 0; h--)
                    3 == j && (ajd2 += e,
                        j = 0),
                    ajd2 += l.charAt(h),
                    j++;
                for (a.value = "",
                    tamanho2 = ajd2.length,
                    h = tamanho2 - 1; h >= 0; h--)
                    a.value += ajd2.charAt(h);
                a.value += r + l.substr(u - 2, u)
            }
            return !1
        }

    </script>





    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->


    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>

    <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>

    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $("#zero_config").DataTable();
        $("#mensagem").fadeTo(3000,1).fadeOut(1000);

    </script>
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
</body>

</html>
