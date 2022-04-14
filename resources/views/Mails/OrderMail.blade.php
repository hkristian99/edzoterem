<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
        /* Base */
        body,
        body *:not(html):not(style):not(br):not(tr):not(code) {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
                'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            position: relative;
        }

        body {
            -webkit-text-size-adjust: none;
            background-color: #151515;
            color: #000;
            height: 100%;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            width: 100% !important;
        }

        .header {
            padding: 25px 0;
            text-align: center;
        }
        .inner-body {
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 570px;
            background-color: #ffffff;
            border-color: #e8e5ef;
            border-radius: 2px;
            border-width: 1px;
            box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015);
            margin: 0 auto;
            padding: 0;
            width: 570px;
        }
        /* Tables */

        .table {
            margin: 15px auto;
            width: 100%;
            background-color: #151515;
            color: #fff;
            border-radius: 20px;
            padding: 10px;
            margin-top: 0px;    
        }
        ul{
            list-style-type: none;
        }
        li{
            color:#a9a9a9;
        }
        li p{
         color:#fff; 
         font-size: 14px;
        }

        th{
            width:35%;
            font-size:19px !important;
        }
        td h4{
            font-size: 19px !important;
            color:#fff;
            text-align: center;
        }

        .table th {
            border-bottom: 1px solid #edeff2;
            border-top: 1px solid #edeff2;
            margin: 0;
            padding-bottom: 8px;
            color:#fff;
        }
        .footer p{
            color: #000000 !important; 
            font-size: 19px !important; 
            text-align: left !important;
        }
        .table td {
            color: #fff;
            font-size: 15px;
            line-height: 18px;
            margin: 0;
            padding: 10px 0;
        }

        .content-cell {
            max-width: 100vw;
            padding: 32px;
        }
        .justify{
            text-align: justify;
        }
        .utalas{
            background-color: #000;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
        }
        .utalas p{
            text-align:left; 
            color: #fff !important; 
            font-size: 16px !important;
        }
        p{
            text-align: justify; 
            color: #fff !important; 
            font-size: 16px !important;
        }
        h1{
            text-align:center; 
            color: #000 !important; 
            font-size: 30px !important;
        }
        h2{
            text-align:center; 
            color: #000 !important; 
            font-size: 19px !important;
        }
    </style>
    <div class="col-6">
        <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td text-align="center">
                    <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                        <!-- Email Body -->
                        <tr>
                            <td class="body" width="100%" cellpadding="0" cellspacing="0" style="background-color: #a9a9a9">
                                <table class="inner-body" text-align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                                    <!-- Body content -->
                                    <tr>
                                        <td class="content-cell" style="background-color: #04040457;">
                                            <h1>Kedves Vásárlónk!</h1>
                                            <h2>Megrendelését sikeresen rögzítettük az alábbi részletekkel.</h2>
                                            <table class="table">
                                                <tbody>
                                                    <tr class="text-center caption">
                                                        <th colspan="2">Terméklista:</th>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <ul class="products">
                                                                @foreach($order["items"] as $order_item)
                                                                <li>
                                                                    <table>
                                                                        <tr>
                                                                            <td style="width: 30%"><img src="{{ env("APP_URL") }}{{ $order_item->getFirstImage($order_item->product_id) }}" width="50" height="50" class="img-responsive"/></td>
                                                                            <td tyle="width: 70%">
                                                                                <p>{{ $order_item->product->name }}</p>
                                                                                <p>{{ number_format($order_item->price, 0, ',', ' ' ) }} Ft x {{ $order_item->quantity }}<b> = {{ number_format( $order_item->amount, 0, ',', ' ' ) }} Ft</b></p>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <td colspan="2"><h4>Összesen: {{ number_format($order["order"]->grandtotal, 0, ',', ' ' ) }} Ft</h4></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Számlázási adatok:</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <ul class="billingDATA">
                                                                <li>Fizetés módja:<p>{{ $order["order"]->getPaymode($order["order"]->paymode_id) }}</p>
                                                                </li>
                                                                @if ( $order["billing"]->tax_number != null )
                                                                    <li>Számlatípus: <p >Cég</p></li>
                                                                    <li>Adószám: {{ $order["billing"]->tax_number }}</li>
                                                                @else
                                                                    <li>Számlatípus: <p>Magánszemély</p></li>
                                                                @endif
                                                                <li> Név: <p>{{ $order["billing"]->name }}</p></li>
                                                                <li> Cím: <p>{{ $order["billing"]->country->name }}, {{ $order["billing"]->postcode }} {{ $order["billing"]->city }}, {{ $order["billing"]->street }}</p>
                                                                </li>
                                                                @if ($order["order"]->tranzaction_id)
                                                                    <li>SimplePay tranzakciós azonosító: <p>{{ $order["order"]->tranzaction_id }}</p></li>
                                                                @endif
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Szállítási adatok:</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <ul class="shippingDATA products">
                                                                <li> Név: <p>{{ $order["shipping"]->name }}</p></li>
                                                                <li> Cím:<p>{{ $order["shipping"]->postcode }} {{ $order["shipping"]->city }}, {{ $order["shipping"]->street }}</p></li>
                                                                <li> Telefonszám: <p>{{ $order["shipping"]->phone }} </p></li>
                                                                @if ( $order["shipping"]->note )
                                                                    <li> Megjegyzés: <p>{{ $order["shipping"]->note }}</p></li>
                                                                @endif
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            @if ( $order["order"]->paymode_id=="2" )
                                                <div>
                                                    <p style="color: #000 !important;"><b>Amennyiben utalásos fizetési módot választott kérjük az alábbi számlaszámra a rendelést követő maximum 2 napon belül átutalni az összeget:</b></p>
                                                </div>
                                                <div class="utalas">
                                                    <p><b>Kedvezményezett:</b> Szaki Gym Kft.</p>
                                                    <p><b>Bankszámlaszám:</b> xxxx-xxxxx-xxxxx</p>
                                                    <p><b>Közlemény:</b> rendelési azonosító</p>
                                                    <p><b>Összeg:</b> 5 000 Ft</p>
                                                </div>
                                                <br>
                                            @endif
                                            <div class="footer">
                                                <p style="text-align: center;"><b>Kérdés estén keress fel minket!</b></p>
                                                <p style="text-align: center; font-size:16px;">info@szakigym.com</p>
                                                <p style="text-align: center; font-size:16px;">+36 20 123 456</p>
                                                <p><b>Üdvözlettel:</b><br/> Szaki Gym csapata</p>
                                                <img src="{{ env("APP_URL") }}/assets/frontend/img/logo.png" class="img-responsive"/>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
