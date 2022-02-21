<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedido Proveedor</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        #invoice {
            padding: 30px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #334257
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #334257
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #334257
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #334257;
            font-size: 1.2em
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #334257
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #334257;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #334257;
            font-size: 1.4em;
            border-top: 1px solid #334257
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }
    </style>
</head>

<body>


    <div id="invoice" >


        <div class="invoice overflow-auto">
            <div style="min-width: 600px">

                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">Pedido de :</div>
                            <h2 class="to">Mi Tiendita</h2>

                        </div>
                        <div class="col invoice-details">
                            <h1 class="invoice-id">Pedidos a Proveedores</h1>
                            @if ($fecha_fin == null)
                            <div class="date">Fecha: {{ $fecha_inicio }}</div>

                            @else
                            <div class="date">Fecha Inicio: {{ $fecha_inicio }}</div>
                            <div class="date">Fecha Fin: {{ $fecha_fin }}</div>
                            @endif

                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th class="text-center">Cod</th>
                                <th class="text-center">Producto</th>
                                <th class="text-center">Precio U</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Proveedor</th>
                                <th class="text-center">Tel Proveedor</th>
                                <th class="text-center">Ubicación</th>
                                <th class="text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                            <tr>
                                <td class="text-center">{{ $pedido->cod_prod }}</td>
                                <td class="text-center">{{ $pedido->producto }} </td>
                                <td class="text-center">$ {{ $pedido->precio_unitario }}</td>
                                <td class="text-center">{{ $pedido->cantidad }}</td>
                                <td class="text-center">${{ $pedido->total_unitario }}</td>
                                <td class="text-center">{{ $pedido->proveedor }}</td>
                                <td class="text-center">{{ $pedido->tel_proveedor }}</td>
                                <td class="text-center">{{ $pedido->direccion }}</td>
                                <td class="text-center">
                                    @switch($pedido->estado_pedido)
                                    @case(0)
                                    Pendiente de Pedido
                                    @break
                                    @case(1)
                                    Pedido Realizado
                                    @break
                                    @case(2)
                                    Producto no Fabricado
                                    @break
                                    @case(3)
                                    Proveedor no Activo
                                    @break

                                    @endswitch
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>

                            <tr>
                                <td colspan="4"></td>
                                <td colspan="4">TOTAL PREVISTO</td>
                                <td>{{ $total_previsto[0]->total_previsto }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="notices">
                        <div>NOTA IMPORTANTE:</div>
                        <div class="notice">Los Precio que se muestran en este informe, pueden variar al final de la
                            compra.
                        </div>
                    </div>
                </main>
                <footer>
                    Información unicamente para uso Empresarial.
                </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>
</body>

</html>