@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <input type="hidden" id="isAuth" value="{{Auth::check()}}">
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Személyes adatok</h2>
                        <div class="bt-option">
                            <a href="{{route("home")}}">Kezdőlap</a>
                            <a href="{{route("cart")}}">Kosár</a>
                            <span>Személyes adatok</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- All Section Begin -->
    <section class="pricing-section spad" id="webshop">
        <div class="container">
            @if (count($errors->personalDataError) > 0 )
                <div id="dangerShippingMsg" class="alert alert-danger">   
                    @foreach ($errors->personalDataError->all() as $error)
                    {{ $error }}<br>
                    @endforeach 
                </div>
            @endif
            <div class="row">
                <div class="d-none d-sm-block col-2 counter">
                    <h1 style="color:#fff;" > 1. </h1>
                </div>
                <div class="col-12 col-sm-10">
                    <h3 style="margin-bottom: 20px; color:#fff;">Rendelés részletei:</h3>
                    <table id="cart" class="table cartTable table-responsive">
                        <thead>
                            <tr class="text-center">
                                <th style="width:50%">Termék</th>
                                <th style="width:20%">Ár</th>
                                <th style="width:8%">Mennyiség</th>
                                <th style="width:22%" class="text-center">Részösszeg</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session('cart') as $id => $details)
                                @if ($details["discount_price"] > 0)
                                    <input type="hidden" name="total" value="{{$total += $details['discount_price'] * $details['quantity']}}">
                                @else
                                    <input type="hidden" name="total" value="{{$total += $details['list_price'] * $details['quantity']}}">
                                @endif
                                <tr data-id="{{$id}}">
                                    <td data-th="Product" style="width:50%">
                                        <div class="row">
                                            <div class="col-sm-3 d-none d-md-block"><img src="{{ $details['image'] }}" width="100" height="100" class="img-responsive productImageCart"/></div>
                                            <div class="col-sm-9 productName">
                                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                                            </div>
                                        </div>
                                    </td>
                                    @if ($details["discount_price"] > 0)
                                        <td data-th="Price">
                                            <p class="productListPriceIfDiscount">{{ number_format($details['list_price'], 0, ',', ' ' ) }} Ft</p> 
                                            {{ number_format($details['discount_price'], 0, ',', ' ' ) }} Ft
                                        </td>
                                    @else
                                        <td data-th="Price">{{ number_format($details['list_price'], 0, ',', ' ' ) }} Ft</td>
                                    @endif
                                    <td data-th="Quantity" style="width:8%"class="text-center">x {{ $details['quantity'] }}</td>
                                    @if ($details["discount_price"] > 0)
                                        <td data-th="Subtotal" class="text-center">{{ number_format( $details['discount_price'] * $details['quantity'], 0, ',', ' ' )}} Ft</td>
                                    @else
                                        <td data-th="Subtotal" class="text-center">{{ number_format( $details['list_price'] * $details['quantity'], 0, ',', ' ' )}} Ft</td>
                                    @endif
                                </tr>
                            @endforeach
                            @if ($total < 18000)
                            <input type="hidden" name="total" value="{{$total += 750}}">
                            <tr style="background-color:#f3610045">
                                <td>Házhozszállítási díj*</td>
                                <td colspan="4" class="Subtotal text-right">+ 750 Ft</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="text-right ticketTotal mb-5">
                        <h4><strong>Összesen: {{ number_format($total, 0, ',', ' ' ) }} Ft</strong></h4>
                    </div>
                    <br>
                </div>
            </div>
            <form action="{{route("orderStore")}}" method="post" class="login">
                @csrf
                <div class="row" style="margin-right: 0px; margin-left:5px;">
                    <div class="d-none d-sm-block col-2 counter">
                        <h1 style="color:#fff;"> 2. </h1>
                    </div>
                    <div class="col-12 col-sm-10 orderCol">
                        <h3 style="margin-bottom: 20px; color:#fff;">Fizetés módja:</h3>
                        <div class="col leave-comment paymode">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymode" id="online" value="1" {{old("paymode") && old("paymode") == "1" ? "checked" : ""}}>
                                <label class="form-check-label" for="online"> On-line bankkártyás fizetés
                                <img class="d-none d-sm-block" src="/assets/frontend/img/simplepay_w140.png" title=" SimplePay - Online bankkártyás fizetés" alt="">
                                </label>
                            </div>
                            <div class="form-check ">
                                <input class="form-check-input" type="radio" name="paymode" id="bank" value="2" {{old("paymode") && old("paymode") == "2" ? "checked" : ""}}>
                                <label class="form-check-label" for="bank"> Banki utalással</label>
                            </div>
                            <div class="form-check ">
                                <input class="form-check-input" type="radio" name="paymode" id="cashOrCredit" value="3" {{old("paymode") && old("paymode") == "3" ? "checked" : ""}}>
                                <label class="form-check-label" for="cashOrCredit"> Készpénzzel vagy bankkártyával átvételkor</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row" style="margin-right: 0px; margin-left:5px;">
                    <div class="d-none d-sm-block col-2 counter">
                        <h1 style="color:#fff;"> 3. </h1>
                    </div>
                    <div class="col-12 col-sm-10 orderCol">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h3 style="margin-bottom: 20px; color:#fff;">Számlázási cím:</h3>
                            </div>
                            <div class="col-12 col-md-6 mb-4 mb-md-0 text-left text-md-right text-white">
                                <span>
                                    <input type="checkbox" class="" id="same_as_billing" name="same_as_billing" value="1" onclick="same()">
                                    <label class="form-check-label" for="same_as_billing"> Megegyezik a <strong>szállítási</strong> címmel.</label>
                                </span>
                            </div>
                        </div>
                        @if ( !Auth::user() )
                            <p>Van fiókod? <a href="{{route("login")}}">Jelentkezz be!</a></p>
                        @else
                            <div class="row">
                                <div class="col">
                                    <a id="newBillingAddressBtn" href="javascript:void(0)">{{(old() && !old('billingAddressID')) ? 'Mégse' : '+ Új felvétele'}}</a><br><br>
                                    <select class="cartInputText" name="billingAddressID" id="billingSelect" {{(old() && !old('billingAddressID')) ? 'disabled="disabled"' : ''}}>
                                        @foreach ($billing_addresses as $billing_address)
                                            <option value="{{$billing_address->id}}" style="color:#000;">
                                                {{$billing_address->name}} - {{$billing_address->postcode}} {{$billing_address->city}} {{$billing_address->street}} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="leave-comment newBillingAddress {{(old() && !old('billingAddressID')) ? '' : 'd-none'}}">
                            <div class="row">
                                <div  id="billingTypePay" class="table-controls form-group col-md-4">
                                    <input type="hidden" id="billingTypeID" name="billingTypeID" value="1" disabled>
                                    <ul id="billingTypePay" >
                                        <li id="person" class={{old("billingTypeID") ? " " : "active"}}>Magánszemély</li>
                                        <li id="company" class={{old("billingTypeID") ? "active" : ""}}>Cég</li>
                                    </ul>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="cartInputText taxNumber {{old("billingTypeID") ? "" : "d-none"}}" id="taxNumber" name="taxNumber" placeholder="Adószám" value="{{old("taxNumber")}}" {{old("billingTypeID") ? "" : "disabled"}}>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="cartInputText"  onkeyup="same()" id="billing_name" name="billing_name" placeholder="Név" value="{{old("billing_name")}}" {{(old() && !old('billingAddressID')) ? '' : 'disabled'}}>
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="cartInputText" name="billing_country" id="billing_country" {{(!old('billingAddressID')) ? '' : 'disabled'}}>
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}" style="color:#000;">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="cartInputText" onkeyup="same()" id="billing_postcode" name="billing_postcode" placeholder="Irányítószám" value="{{old("billing_postcode")}}" {{(old() && !old('billingAddressID')) ? '' : 'disabled'}}>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="cartInputText" onkeyup="same()" id="billing_city" name="billing_city" placeholder="Város" value="{{old("billing_city")}}" {{(old() && !old('billingAddressID')) ? '' : 'disabled'}}>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="cartInputText" onkeyup="same()" id="billing_street" name="billing_street" placeholder="Utca, házszám" value="{{old("billing_street")}}" {{(old() && !old('billingAddressID')) ? '' : 'disabled'}}>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row" style="margin-right: 0px; margin-left:5px;">
                    <div class="d-none d-sm-block col-2 counter">
                        <h1 style="color:#fff;"> 4. </h1>
                    </div>
                    <div class="col-12 col-sm-10 orderCol">
                        <h3 style="margin-bottom: 20px; color:#fff;">Szállítási cím:</h3>
                        @if ( !Auth::user() )
                            <p>Van fiókod? <a href="{{route("login")}}">Jelentkezz be!</a></p>
                        @else
                        <div class="row">
                            <div class="col">
                                <a id="newShippingAddressBtn" href="javascript:void(0)">{{(old() && !old('shippingAddressID')) ? 'Mégse' : '+ Új felvétele'}}</a><br><br>
                                <select class="cartInputText" name="shippingAddressID" id="shippingSelect" {{(old() && !old('shippingAddressID')) ? 'disabled="disabled"' : ''}}>
                                    @foreach ($shipping_addresses as $shipping_address)
                                        <option value="{{$shipping_address->id}}" style="color:#000;">
                                            {{$shipping_address->name}} - {{$shipping_address->postcode}} {{$shipping_address->city}} {{$shipping_address->street}} : "{{$shipping_address->note}}"
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                        <div class="leave-comment newShippingAddress {{(old() && !old('shippingAddressID')) ? '' : 'd-none'}}">
                            <div class="row">
                                @if (!Auth::check())
                                    <div class="form-group col-md-12">
                                        <input type="email" class="cartInputText" name="shipping_email" id="shipping_email" placeholder="E-mail cím" value="{{old("shipping_email")}}">
                                    </div>
                                @endif
                                <div class="form-group col-md-12">
                                    <input type="text" class="cartInputText" id="shipping_name"  name="shipping_name" placeholder="Név" value="{{old("shipping_name")}}" {{(old() && !old('shippingAddressID')) ? '' : 'disabled'}}>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="cartInputText" id="shipping_postcode" name="shipping_postcode" placeholder="Irányítószám" value="{{old("shipping_postcode")}}" {{(old() && !old('shippingAddressID')) ? '' : 'disabled'}}>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="cartInputText" id="shipping_city" name="shipping_city" placeholder="Város" value="{{old("shipping_city")}}" {{(old() && !old('shippingAddressID')) ? '' : 'disabled'}}>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="cartInputText" id="shipping_street" name="shipping_street" placeholder="Utca, házszám" value="{{old("shipping_street")}}" {{(old() && !old('shippingAddressID')) ? '' : 'disabled'}}>
                                </div>
                                <div class="form-group col-md-12">
                                    <input id="shipping_phone" class="cartInputText" name="shipping_phone" id="shipping_phone" placeholder="Telefonszám" maxlength="16" value="{{old("shipping_phone")}}" {{(old() && !old('shippingAddressID')) ? '' : 'disabled'}}>
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea  id="shipping_note" name="shipping_note" class="cartInputTextarea" placeholder="Megjegyzés a futárnak" {{(old() && !old('shippingAddressID')) ? '' : 'disabled'}}>{{ old('shipping_note') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row" style="margin-right: 0px; margin-left:5px;">
                    <div class="d-none d-sm-block col-2 counter">
                        <h1 style="color:#fff;"> 5. </h1>
                    </div>
                    <div class="col-12 col-sm-10 orderCol">
                        <h3 style="margin-bottom: 20px; color:#fff;">Megjegyzés:</h3>
                        <br>
                        <div class="leave-comment">
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea name="noteForGym" class="cartInputTextarea" placeholder="Megjegyzés az eladónak">{{ old('noteForGym') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center text-sm-right" style="color:#fff; padding-top: 30px;">
                    <div class="col form-check" style="margin-left: 20px;">
                        <input class="form-check-input" type="checkbox" name="accept" id="accept" value="1">
                        <label class="form-check-label" for="accept"> Megrendelésemmel kijelentem, hogy elolvastam a <a href="#">Vásárlási feltételeket</a>, az <a href="{{route("DataProtection")}}">Adatvédelmi tájékoztatót</a><br> és elfogadom az <a href="/assets/frontend/pdf/adattovabbitasi_nyilatkozat_magyar.pdf" target="_blank">Adattovábbítási nyilatkozatot</a>.</label>
                    </div>
                </div>
                <br><br>
                <div class="text-center text-sm-right">
                    <a href="{{ route('cart') }}" class="btn btn-orange"><i class="fa fa-angle-left"></i> Vissza a kosárhoz</a>
                    <button type="submit" class="btn btn-white">Fizetés</a>
                </div>
            </form>
        </div>
    </section>
    <!-- All Section End -->
@endsection
@section('scripts')
    <script>
        $("#shipping_phone").inputmask("(99) 99 999-999[9]",{ "placeholder": "_" });
        $("#newShippingAddressBtn").on("click", function() {
            if($(this).text() == "+ Új felvétele" ){
                $(this).text("Mégse");
                $(".newShippingAddress").removeClass("d-none");
                $("#shippingSelect").attr("disabled", "disabled");
                $("#shipping_name").removeAttr("disabled", "disabled");
                $("#shipping_postcode").removeAttr("disabled", "disabled");
                $("#shipping_city").removeAttr("disabled", "disabled");
                $("#shipping_street").removeAttr("disabled", "disabled");
                $("#shipping_phone").removeAttr("disabled", "disabled");
                $("#shipping_note").removeAttr("disabled", "disabled");
            }
            else{
                $(this).text("+ Új felvétele");
                $(".newShippingAddress").addClass("d-none");
                $("#shippingSelect").removeAttr("disabled", "disabled");
                $("#shipping_name").attr("disabled", "disabled");
                $("#shipping_postcode").attr("disabled", "disabled");
                $("#shipping_city").attr("disabled", "disabled");
                $("#shipping_street").attr("disabled", "disabled");
                $("#shipping_phone").attr("disabled", "disabled");
                $("#shipping_note").attr("disabled", "disabled");
            }
        });
        $("#newBillingAddressBtn").on("click", function() {
            if($(this).text() == "+ Új felvétele" ){
                $(this).text("Mégse");
                $(".newBillingAddress").removeClass("d-none");
                $("#billingSelect").attr("disabled", "disabled");
                $("#billing_name").removeAttr("disabled", "disabled");
                $("#billing_postcode").removeAttr("disabled", "disabled");
                $("#billing_city").removeAttr("disabled", "disabled");
                $("#billing_street").removeAttr("disabled", "disabled");
                $("#billing_phone").removeAttr("disabled", "disabled");
                $("#billing_note").removeAttr("disabled", "disabled");
            }
            else{
                $(this).text("+ Új felvétele");
                $(".newBillingAddress").addClass("d-none");
                $("#billingSelect").removeAttr("disabled", "disabled");
                $("#billing_name").attr("disabled", "disabled");
                $("#billing_postcode").attr("disabled", "disabled");
                $("#billing_city").attr("disabled", "disabled");
                $("#billing_street").attr("disabled", "disabled");
                $("#billing_phone").attr("disabled", "disabled");
                $("#billing_note").attr("disabled", "disabled");
            }
        });

        document.querySelectorAll("input").forEach(item => {
            item.addEventListener("change", () => {
                console.log(item.id + " érték: " + item.value);
            });
        });

        $("#person").on("click", function() {
            $(".taxNumber").addClass("d-none");
            $(".taxNumber").attr("disabled", "disabled");
            $("#billingTypeID").attr("disabled", "disabled");
        });

        $("#company").on("click", function() {
            $(".taxNumber").removeClass("d-none");
            $(".taxNumber").removeAttr("disabled", "disabled");
            $("#billingTypeID").removeAttr("disabled", "disabled");
        });

        let isAuth = $("#isAuth").val();
        $(document).ready(function() {
            if( !isAuth ){
                $(".newBillingAddress").removeClass("d-none");
                $("#billingSelect").attr("disabled", "disabled");
                $("#billing_name").removeAttr("disabled", "disabled");
                $("#billing_postcode").removeAttr("disabled", "disabled");
                $("#billing_city").removeAttr("disabled", "disabled");
                $("#billing_street").removeAttr("disabled", "disabled");
                $("#billing_phone").removeAttr("disabled", "disabled");
                $("#billing_note").removeAttr("disabled", "disabled");

                $(".newShippingAddress").removeClass("d-none");
                $("#shippingSelect").attr("disabled", "disabled");
                $("#shipping_name").removeAttr("disabled", "disabled");
                $("#shipping_postcode").removeAttr("disabled", "disabled");
                $("#shipping_city").removeAttr("disabled", "disabled");
                $("#shipping_street").removeAttr("disabled", "disabled");
                $("#shipping_phone").removeAttr("disabled", "disabled");
                $("#shipping_note").removeAttr("disabled", "disabled");
            }
        });
        function same() {
            if ($("#same_as_billing").is(":checked") == true){
                $("#shipping_name").attr("value", $("#billing_name").val());
                $("#shipping_name").attr("readonly", "readonly");

                $("#shipping_city").attr("value", $("#billing_city").val());
                $("#shipping_city").attr("readonly", "readonly");

                $("#shipping_street").attr("value", $("#billing_street").val());
                $("#shipping_street").attr("readonly", "readonly");

                $("#shipping_postcode").attr("value", $("#billing_postcode").val());
                $("#shipping_postcode").attr("readonly", "readonly");
            }
            else{
                $("#shipping_name").removeAttr("value");
                $("#shipping_name").removeAttr("disabled");

                $("#shipping_city").removeAttr("value");
                $("#shipping_city").removeAttr("disabled");

                $("#shipping_street").removeAttr("value");
                $("#shipping_street").removeAttr("disabled");

                $("#shipping_postcode").removeAttr("value");
                $("#shipping_postcode").removeAttr("disabled");
            }
        };

    </script>
@endsection