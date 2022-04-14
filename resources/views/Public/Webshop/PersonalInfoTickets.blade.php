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
                            <a href="{{route("cart")}}">Webshop</a>
                            <a href="{{route("cart")}}">Bérletek</a>
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
                <div class="col-12 col-sm-10 payTable">
                    <h3 style="margin-bottom: 20px; color:#fff;">Rendelés részletei:</h3>
                    <table id="cart" class="table cartTable">
                        <thead>
                            <tr class="text-center">
                                <th style="width:70%">Termék</th>
                                <th style="width:30%">Ár</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-id="" class="text-center">
                                <td data-th="Product" style="width:70%">{{$ticket->name}}</td>
                                @if ($ticket->discount_price)
                                    <td data-th="Price" style="width:30%" style="margin:auto;">
                                        <p class="productListPriceIfDiscount2 text-center">{{$ticket->list_price}} Ft</p> 
                                        {{$ticket->discount_price}} Ft
                                    </td>
                                @else
                                    <td data-th="Price" style="margin:auto;">{{$ticket->list_price}} Ft</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-12 text-right mb-5 ticketTotal">
                        @if ($ticket->discount_price)
                            <h4><strong>Összesen: {{ number_format($ticket->discount_price, 0, ',', ' ' ) }} Ft</strong></h4>
                        @else
                            <h4><strong>Összesen: {{ number_format($ticket->list_price, 0, ',', ' ' ) }} Ft</strong></h4>
                        @endif
                    </div>
                </div>
            </div>
            <form action="{{route("orderStore")}}" method="post" class="login">
                @csrf
                <input type="hidden" name="grandTotal" value="{{$total}}">
                <div class="row">
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
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="d-none d-sm-block col-2 counter">
                        <h1 style="color:#fff;"> 3. </h1>
                    </div>
                    <div class="col-12 col-sm-10 orderCol">
                        <h3 style="margin-bottom: 20px; color:#fff;">Számlázási cím:</h3>
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
                                    <input type="text" class="cartInputText" id="billing_name"  name="billing_name" placeholder="Név" value="{{old("billing_name")}}" {{(old() && !old('billingAddressID')) ? '' : 'disabled'}}>
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="cartInputText" name="billing_country" id="billing_country" {{(!old('billingAddressID')) ? '' : 'disabled="disabled"'}}>
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}" style="color:#000;">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="cartInputText" id="billing_postcode" name="billing_postcode" placeholder="Irányítószám" value="{{old("billing_postcode")}}" {{(old() && !old('billingAddressID')) ? '' : 'disabled'}}>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="cartInputText" id="billing_city" name="billing_city" placeholder="Város" value="{{old("billing_city")}}" {{(old() && !old('billingAddressID')) ? '' : 'disabled'}}>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="cartInputText" id="billing_street" name="billing_street" placeholder="Utca, házszám" value="{{old("billing_street")}}" {{(old() && !old('billingAddressID')) ? '' : 'disabled'}}>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-center text-sm-right" style="color:#fff; padding-top: 30px;">
                    <div class="col form-check" style="margin-left: 20px;">
                        <input class="form-check-input" type="checkbox" name="accept" id="accept" value="1">
                        <label class="form-check-label" for="accept"> Megrendelésemmel kijelentem, hogy elolvastam a <a href="#">Vásárlási feltételeket</a>, az <a href="{{route("DataProtection")}}">Adatvédelmi tájékoztatót</a><br> és elfogadom az <a href="#">Adattovábbítási nyilatkozatot</a>.</label>
                    </div>
                </div>
                <br><br>
                <div class="text-right">
                    <a href="{{ route('tickets') }}" class="btn btn-orange"><i class="fa fa-angle-left"></i> Vissza a vásárláshoz</a>
                    <button type="submit" class="btn btn-white">Fizetés</a></button>
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

    </script>
@endsection