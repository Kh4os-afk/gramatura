<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('bdc.png') }}">
    {{-- Data Tables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/datatables.min.css" rel="stylesheet">
    {{-- Select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- Hamster --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="app sidebar-mini rtl pace-done sidenav-toggled">
<div id="preloader">
    <div aria-label="Orange and tan hamster running in a metal wheel" role="img" class="wheel-and-hamster">
        <div class="wheel"></div>
        <div class="hamster">
            <div class="hamster__body">
                <div class="hamster__head">
                    <div class="hamster__ear"></div>
                    <div class="hamster__eye"></div>
                    <div class="hamster__nose"></div>
                </div>
                <div class="hamster__limb hamster__limb--fr"></div>
                <div class="hamster__limb hamster__limb--fl"></div>
                <div class="hamster__limb hamster__limb--br"></div>
                <div class="hamster__limb hamster__limb--bl"></div>
                <div class="hamster__tail"></div>
            </div>
        </div>
        <div class="spoke"></div>
    </div>
</div>
<div id="conteudo_body">
<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" href="{{ route('index') }}">Produtos</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item" href="{{ route('index') }}"><i class="app-menu__icon fa fa-search-minus"></i><span class="app-menu__label">Produtos Por Gramatura</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="{{ route('descricao.index') }}"><i class="app-menu__icon fa fa-search-plus"></i><span class="app-menu__label">Produtos Por Descrição</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="{{ route('devolucao.index') }}"><i class="app-menu__icon fa fa-exchange"></i><span class="app-menu__label">Devolução</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="{{ route('itens.index') }}"><i class="app-menu__icon fa fa-cart-plus"></i><span class="app-menu__label">Buscar Itens de Nota</span></a>
        </li>
    </ul>
</aside>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-search"></i> Produtos</h1>
            <p>Buscar Produtos Por Peso</p>
        </div>
    </div>
    @yield('content')
</main>
<!-- Essential javascripts for application to work-->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<!-- Google analytics script-->
<script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }
</script>

<script>
    $(document).ready(function () {
        let table = $('#table').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
            },
            dom: 'Bfrtip',
            paging: false,
            buttons: [
                'copyHtml5',
                'excelHtml5',
                {
                    extend: 'pdfHtml5',
                    orientation: 'portrait',
                    customize: function (doc) {
                        /*doc.content[1].alignment = 'center'*/
                        doc.content[1].margin = [0, 0, 0, 0] //left, top, right, bottom
                    }
                },
                'csvHtml5',
            ],
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();

        // Adiciona o estilo diretamente ao elemento Select2
        $('.select2-selection').css({
            'border': '2px solid #ced4da',
            'padding': '6px 12px',
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var preloader = document.getElementById("preloader");
        var conteudo_body = document.getElementById("conteudo_body");

        // Função para controlar a exibição do preloader
        function hidePreloader() {
            preloader.style.display = "none";
            conteudo_body.style.display = "block";
        }

        // Esconde o pré-carregador e mostra o conteúdo quando a página é totalmente carregada
        window.addEventListener("load", hidePreloader);

        // Certifica-se de que o preloader é escondido ao retornar para a página via histórico do navegador
        window.addEventListener("pageshow", hidePreloader);
    });

    $(document).ready(function() {
        // Mostra o pré-carregador no envio do formulário
        $('form').on('submit', function() {
            $('#preloader').show();
        });
    });
</script>

</div>
</body>
</html>
