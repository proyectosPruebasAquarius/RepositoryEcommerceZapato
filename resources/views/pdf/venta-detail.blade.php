<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Detalle de Venta </title>
    <link rel="apple-touch-icon" sizes="180x180" href="'http://3.135.184.132/backend/assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="http://3.135.184.132/backend/assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="http://3.135.184.132/backend/assets/images/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="http://3.135.184.132/backend/assets/images/favicons/favicon.ico">
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: center;
            width: 100%;
            height: 28cm;
            margin: auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 40px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: left;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: left;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="mitiendita.png">
        </div>
        <h1>Mi Tiendita</h1>

        <div id="project">


            <div><span>FECHA</span>{{ $fecha }}</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="desc">C&Oacute;DIGO</th>
                    <th class="service">PRODUCTO</th>
                    
                    <th class="unit">PRECIO</th>

                    <th class="qty">QTY</th>
                    <th class="total">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail as $p)
                <tr>
                    <td class="desc">{{ $p->codigo }}</td>
                    <td class="service">{{ $p->producto }}</td>
                   
                    
                    <td class="unit">$ {{ $p->precio_venta}}</td>
                   
                    <td class="qty">{{ $p->cantidadTotal }}</td>

                    <td class="total">
                        $ {{ $p->precio_venta  * $p->cantidadTotal}}
                    </td>


                </tr>
                @endforeach


                <tr>
                    <td colspan="4" class="grand total">TOTAL</td>
                    <td class="grand total">
                        @foreach ($sumTotal as $suma)
                        $ {{ $suma->cuentaTotal }}
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="notices">

        </div>
    </main>
    <footer>
        Información unicamente para uso Empresarial
    </footer>
</body>

</html>