<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Facture-#{{ $orders['code'] }} </title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 10px;
            border: 1px solid #ececec;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); */
            font-size: 14px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: black;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 1px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 0px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 15px;
            line-height: 15px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.heading td {
            /* background: #eee; */
            border: 1px solid #090909;
            /* font-weight: bold; */
            font-family: 'Bell MT';
            font-size: 18px;
            text-align: center;
            padding: auto;

        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;

        }

        .invoice-box table tr.item td {
            /* border-bottom: 1px solid #eee; */
            text-align: justify;
            border: 1px solid #090909;
            /* font-weight: bold; */
            font-family: 'Bell MT';
            font-size: 18px;
            text-align: center;
            padding: auto;

        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table td.total {
            border-top: 2px solid #ffffff;
            font-weight: 500;
            font-size: 24px;
            border: 1px solid #090909;
            font-family: 'Bell MT';

        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .thanks {
            font-weight: 700;
            font-size: 18px;
            font-family: 'Bell MT';
        }

        .signature {
            display: flex;
            /* justify-content: space-around; */
            /* font-size: 18px; */
            font-family: 'Bell MT';
            /* text-decoration: underline */
        }

        .visa small {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="" cellspacing="0">


            <tr class="information">
                <td colspan="5">
                    <table>
                        <tr >
                            <td>

                                <img src="https://www.dooya.ci/logos/dooya.png" width="50" />

                            </td>


                            <td colspan="" style="">
                                <p style="border:1px solid black; text-align:justify; padding:10px; font-weight:bold">
                                    <span>CLIENT: {{ $orders['user']['name'] }} </span><br>
                                    <span>VILLE: {{ $orders['delivery_name'] }} </span><br>
                                    <span>TEL: {{ $orders['user']['phone'] }} </span><br>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>


            <tr class="heading">
                <td>Réf N°</td>
                <td>Description</td>
                <td>Quantités <br>Commandées</td>
                <td>Prix <br> unitaire</td>
                <td>PRIX TOTAL</td>

            </tr>
            @foreach ($orders['products'] as $item)
                <tr class="item">
                    <td> {{ $orders['code'] }}</td>
                    <td>{{ $item['title'] }}
                        <br><br>
                        Livraison
                    </td>
                    <td> {{ $item['pivot']['quantity'] }}
                        <br><br>
                        {{ $item['pivot']['quantity'] }}
                    </td>
                    @php
                        $total = $item['pivot']['quantity'] * $item['pivot']['unit_price'];
                    @endphp
                    <td>{{ $item['pivot']['unit_price'] }} FCFA</td>
                    <td>{{ number_format($total, 0, ',', ' ') }} </td>

                </tr>
            @endforeach


            {{-- <tr class="total" style="text-align:right;">
                <td colspan="5" style="padding-right:40px; padding-top:10px"> <b>Sous-total</b>:
                    10000 FCFA</td>
            </tr> --}}

            {{-- <tr class="total" style="text-align:right;">
                <td colspan="5" style="padding-right:40px;"> <b>Livraison</b>:
                    1000 FCFA</td>
            </tr> --}}

            <tr class="" style="text-align:right;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td colspan="" class="total" style="padding-right:40px; border:1px solid black">
                    {{ number_format($orders['total'], 0, ',', ' ') }} FR TTC

                </td>
            </tr>

        </table>
        <p class="thanks">Merci d’avoir choisi notre entreprise pour vous servir </p>
        <div class="signature">
            <h3 class="visa"><u>VISA DU CLIENT </u>
                <br><small  style="margin:8px;">(Signature, et date)</small>
            </h3>
            <h3><u>DOOYA.CI</u></h3>
        </div>
    </div>
</body>

</html>
