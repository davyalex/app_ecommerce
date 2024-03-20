<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Facture-#{{ $orders['code'] }} </title>

  
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="" cellspacing="0">


            <tr class="information">
                <td colspan="5">
                    <table>
                        <tr style="display:flex; justify-content:space-between;">
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
