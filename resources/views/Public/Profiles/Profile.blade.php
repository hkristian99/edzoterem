@extends('Public.Layouts.Master')
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg set-bgprofile" data-setbg="/assets/frontend/img/profile-bg.jpg">
    <div class="container" style="margin-bottom:70px;">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-text">
                    <h2>Profilom</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container profileContainer spad pageProfile">

        <!-- Menü -->
        <div class="row">
            <div class="form-group col-md-4">
                <h2 id="selectedMenu" class="text-white">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h2>
            </div>
            <div class="form-group col-md-8">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                    <a id="nav_item_personal" class="nav-link profilMenuBtn active-profilMenuBtn" href="#">Személyes adataim</a>
                    </li>
                    <li class="nav-item">
                    <a id="nav_item_password" class="nav-link profilMenuBtn" href="#">Jelszó módosítás</a>
                    </li>
                    <li class="nav-item">
                    <a id="nav_item_address" class="nav-link profilMenuBtn" href="#">Címeim</a>
                    </li>
                </ul>
                <div class="row justify-content-center">
            </div>
        </div>
        <hr style="border:rgb(156, 156, 156) solid 2px; width:100%; margin-bottom:70px;">
        <!-- Menü vége -->

        <!-- Személyes adatok -->
        <div id="personalDiv" class="leave-comment profileformDiv">
            <h2 class="text-white">Személyes adatok: </h2><br>
            <div id="alapadatokDIV" class="d-none">{{ Auth::user() }}</div>
            @if (count($errors->personalError) > 0 )
                <div id="dangerPersonalMsg" class="alert alert-danger">   
                    @foreach ($errors->personalError->all() as $error)
                    {{ $error }}<br>
                    @endforeach 
                </div>
            @endif
            @if( session()->has('successPersonal') )
                <div id="successPersonalMsg" class="alert alert-success">
                    {{ session()->get('successPersonal') }}
                </div>
            @endif
            <form  id="profile-form" name="profile" class="login" action="{{route("profileUpdate")}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="form_azonosito" value="alapadatok">
                <div class="col text-right {{ old() && old("form_azonosito")=="alapadatok" ? "d-none" : "" }}" id="modify-button-div" style="padding:0px;">
                    <button type="button" id="modify-button" class="primary-btn modify-btn">Módosítás</button>
                </div>
                <div class="form-row">
                <div class="col text-right {{ old("form_azonosito") && old("form_azonosito")=="alapadatok" ? "" : "d-none" }}" id="save-button-div">
                        <button type="submit" id="personal-save-btn" class="primary-btn modify-btn save-btn" style="margin-bottom: 16px;">Módosítások mentése</button>
                        <button type="button" id="cancel-button" class="primary-btn appoinment-btn cancel-btn">Mégse</button>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="text-white">Vezetéknév:</label>
                        <input class="input" id="firstname" name="firstname" value="{{ old() && old("form_azonosito")=="alapadatok" ? old("firstname") : Auth::user()->firstname }}" type="text" {{ old() && old("form_azonosito")=="alapadatok" ? "" : "disabled" }}>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="text-white">Keresztnév:</label>
                        <input class="input" id="lastname" name="lastname" value="{{ old() && old("form_azonosito")=="alapadatok" ? old("lastname") : Auth::user()->lastname }}" type="text" {{ old() && old("form_azonosito")=="alapadatok" ? "" : "disabled" }}>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="text-white">E-mail:</label>
                        <input class="input" id="email" name="email" value="{{ old() && old("form_azonosito")=="alapadatok" ? old("email") : Auth::user()->email }}" type="email" {{ old() && old("form_azonosito")=="alapadatok" ? "" : "disabled" }}>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="text-white">Diákgazolványszám: <small>*</small></label>
                        <input class="input" id="student_card_number" name="student_card_number" value="{{ old() && old("form_azonosito")=="alapadatok" ? old("student_card_number") : Auth::user()->student_card_number }}" type="text" {{ old() && old("form_azonosito")=="alapadatok" ? "" : "disabled" }}>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="text-white">Diákgazolványkép - előlap: <small>*</small></label><br>
                        @if (Auth::user()->student_card_front != null)
                            <img src="images/student_cards/{{Auth::user()->student_card_front}}"  class="student_card">
                        @endif
                        <input type="file" class="file " id="student_card_front" name="student_card_front" {{ old() && old("form_azonosito")=="alapadatok" ? "" : "disabled" }}>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="text-white">Diákgazolványkép - hátlap: <small>*</small></label><br>
                        @if (Auth::user()->student_card_front != null)  
                            <img src="images/student_cards/{{Auth::user()->student_card_back}}" class="student_card">
                        @endif
                        <input type="file" class="file" name="student_card_back" {{ old() && old("form_azonosito")=="alapadatok" ? "" : "disabled" }}>
                    </div>
                    <div class="form-group col-md-12 text-left">
                        <label style="color: #fff;"><small>*A kedvezményes bérlet igénybevételéhez szükséges az érvényes diákigazolvány feltöltése</small></label>
                    </div>
                </div>
            </form>
        </div>
        <!-- Személyes adatok vége -->
    

        <!--Jelszó változtatás -->
        <div  id="passwordDiv" class="leave-comment d-none profileformDiv" style="width:1150px;">
            <div class="form-group col-md-12" style="padding:0px;">
                <h2 class="text-white">Jelszó megváltoztatása:</h2><br>
                <div id="jelszoDIV" class="d-none"></div>
                <div class="form-row">
                    <div id="password-form" class="col-12 col-md-12" style="padding-top: 20px;">
                        <form  name="profile" class="login" action="{{route("ChangePassword")}}" method="POST">
                            @csrf
                            <input type="hidden" name="form_azonosito" value="password">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    @if (count($errors->passwordError) > 0 )
                                        <div id="dangerPasswordMsg" class="alert alert-danger">   
                                            @foreach ($errors->passwordError->all() as $error)
                                            {{ $error }}<br>
                                            @endforeach 
                                        </div>
                                    @endif
                                    @if( session()->has('successPassword') )
                                        <div id="successPasswordMsg" class="alert alert-success">
                                        {{ session()->get('successPassword') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-white">Jelszó:</label><br>
                                    <input type="password" class="input" id="password" name="password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-white">Jelszó mégegyszer:</label><br>
                                    <input type="password" class="input" id="password_confirmation" name="password_confirmation">
                                </div>
                                <div class="col-md-12 text-right" style="padding-left:15px;">
                                    <button type="submit" id="password-change-btn" class="primary-btn modify-btn save-btn" >Módosítás</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Jelszó változtatás vége -->

        <!-- Számlázási adatok -->
        <div id="billingDiv" class="leave-comment d-none profileformDiv" >
            <div class="form-group col-md-12" style="padding:0px;">
                <h2 class="text-white">Számlázási cím: <small> (kötelező rendelés esetén)</small></h2><br>
                <div id="szamlazasiadatokDIV" class="d-none"></div>
                <div class="form-row">
                    <div id="billing-address-form" class="col-12 col-md-7" style="padding-top: 20px;">
                        <form  name="profile"  class="login" action="{{ route("billingAddressNew") }}" method="POST">
                            @csrf
                            <input type="hidden" name="form_azonosito" value="szamlazasi">
                            <input type="hidden" id="billing-type" class="input" name="billing_type" value="1" >
                            <input type="hidden" id="billingAddressId" name="billingAddressId" value="">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    @if (count($errors->billingError) > 0 )
                                        <div id="dangerBillingMsg" class="alert alert-danger">   
                                            @foreach ($errors->billingError->all() as $error)
                                            {{ $error }}<br>
                                            @endforeach 
                                        </div>
                                    @endif
                                    @if( session()->has('successBilling') )
                                        <div id="successBillingMsg" class="alert alert-success">
                                        {{ session()->get('successBilling') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div  id="billing-types" class="col-md-6 table-controls text-left">
                                            <ul id="billing-types-ul" >
                                                <li id="person" class="{{ !old() || (old() && old("billing_type") == 1) ? "active" : "" }}" >Magánszemély</li>
                                                <li id="company" class="{{ old() &&  old("billing_type") == 2 ? "active" : "" }}">Cég</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <input  type="text" class="input" id="billing_name" name="billing_name" placeholder="Név" value="{{ old() && old("form_azonosito")=="szamlazasi" ? old("billing_name") : "" }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <select class="input form-control" id="billing_country_id" name="billing_country_id">
                                        @foreach ($countries as $country)
                                            <option  value="{{$country["id"]}}" {{ old() && old("billing_country_id")==$country["id"] ? "SELECTED" : "" }}> {{$country["name"]}}</label></option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="input" id="billing_postcode" name="billing_postcode" placeholder="Irányítószám"  value="{{ old() && old("form_azonosito")=="szamlazasi" ? old("billing_postcode") : "" }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="input" id="billing_city" name="billing_city" placeholder="Város" value="{{ old() && old("form_azonosito")=="szamlazasi" ? old("billing_city") : "" }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="input"id="billing_street" name="billing_street" placeholder="Utca, házszám" value="{{ old() && old("form_azonosito")=="szamlazasi" ? old("billing_street") : "" }}">
                                </div>
                                <div class="form-group col-md-12 taxNumber {{ !old() || (old("billing_type") != 2) ? "d-none" : "" }}">
                                    <input type="text" class="input" id="tax_number" name="tax_number" placeholder="Adószám" value="{{ old() && old("form_azonosito")=="szamlazasi" ? old("tax_number") : "" }}">
                                </div>
                                <div id="billing-new-btn" class="col-md-12 text-left" style="padding-left:0px;">
                                    <button type="submit" id="billing-save-btn" class="primary-btn modify-btn save-btn" >Új cím hozzáadása</button>
                                </div>
                                <div id="billing-buttons"class="col-md-12 text-left d-none" style="padding-left:0px;">
                                    <button type="submit" id="billing-edit-btn" class="primary-btn modify-btn save-btn" style="">Módosítás</button>
                                    <button type="submit" formaction="{{route("billingAddressDelete")}}" id="billing-delete-btn" class="primary-btn appoinment-btn cancel-btn">Törlés</button>
                                    <button type="submit" formaction="javascript:void(0)"id="billing_cancel_btn" class="primary-btn appoinment-btn cancel-btn" style="margin-right: 10px;">Mégse</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-5 text-left" style="padding-left: 100px;">
                        <label class="text-white profileLabel">Eddigi számlázási címeim:</label><br>
                        <ul>
                            @foreach ($billingAddresses as $billingAddress)
                                <li>
                                    <a href="javascript:void(0)" class="billing_address profile">
                                        @if($billingAddress->tax_number != null ) Cég: @endif
                                        {{$billingAddress->name}} - {{$billingAddress->postcode}} {{$billingAddress->city}}, {{$billingAddress->street}}
                                    </a>
                                    <div class="d-none">
                                        {{ $billingAddress }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <hr style="border:rgb(156, 156, 156) solid 2px; width:80%; margin-bottom:50px;margin-top:50px;">
        </div>
        <!--Számlázási adatok vége -->

        

        <!--Szállítási adatok -->
        <div id="shippingDiv" class="leave-comment d-none profileformDiv">
            <div class="form-group col-md-12">
                <h2 class="text-white">Szállítási címeim: <small> (opcionális)</small></h2><br>
                <div class="row">
                    <div id="shipping-address-form" class="col-12 col-md-7" style="padding-top: 20px;">
                        <form  name="profile" class="login" action="{{route("shippingAddressNew")}}" method="POST">
                            @csrf
                            <input type="hidden" name="form_azonosito" value="szallitasi">
                            <input type="hidden" id="shippingAddressId" name="shippingAddressId" value="">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    @if (count($errors->shippingError) > 0 )
                                        <div id="dangerShippingMsg" class="alert alert-danger">   
                                            @foreach ($errors->shippingError->all() as $error)
                                            {{ $error }}<br>
                                            @endforeach 
                                        </div>
                                    @endif
                                    @if( session()->has('successShipping') )
                                        <div id="successShippingMsg" class="alert alert-success">
                                        {{ session()->get('successShipping') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" id="shipping_name" class="input" name="shipping_name" placeholder="Név" value="{{ old() && old("form_azonosito")=="szallitasi" ? old("shipping_name") : "" }}" >
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="input" id="shipping_postcode" name="shipping_postcode" placeholder="Irányítószám" value="{{ old() && old("form_azonosito")=="szallitasi" ? old("shipping_postcode") : "" }}" >
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="input" id="shipping_city" name="shipping_city" placeholder="Város" value="{{ old() && old("form_azonosito")=="szallitasi" ? old("shipping_city") : "" }}" >
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="input" id="shipping_street" name="shipping_street" placeholder="Utca, házszám" value="{{ old() && old("form_azonosito")=="szallitasi" ? old("shipping_street") : "" }}" >
                                </div>
                                <div class="form-group col-md-12">
                                    <input id="shipping_phone" name="shipping_phone" placeholder="Telefonszám" maxlength="16" value="{{ old() && old("form_azonosito")=="szallitasi" ? old("shipping_phone") : "" }}" />
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea  name="shipping_note" id="shipping_note" placeholder="Megjegyzés">{{ old() && old("form_azonosito")=="szallitasi" ? old("shipping_note") : "" }}</textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="row">
                                        <div id="shipping-new-btn" class="col-md-12 text-left" style="padding-left:14px;">
                                            <button type="submit" id="shipping-save-btn" class="primary-btn modify-btn">Új cím hozzádása</button>
                                        </div>
                                        <div id="shipping-buttons"class="col-md-12 d-none" style="padding-left:0px;">
                                            <button type="submit" formaction="{{route("shippingAddressUpdate")}}" id="shipping-edit-btn" class="primary-btn modify-btn save-btn">Módosítás</button>
                                            <button type="submit" formaction="{{route('shippingAddressDelete')}}" id="shipping-delete-btn" class="primary-btn appoinment-btn cancel-btn">Törlés</a>
                                            <button type="button" formaction="javascript:void(0)" id="shipping_cancel_btn" class="primary-btn appoinment-btn cancel-btn" style="margin-right: 10px;">Mégse</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-5" style="padding-left: 100px;">
                        <label class="text-white profileLabel">Eddigi szállítási címeim:</label><br>
                        <ul>
                            @foreach ($shippingAddresses as $shippingAddress)
                                <li>
                                    <a href="javascript:void(0)" class="shipping_address profile">
                                        {{$shippingAddress->name}} - {{$shippingAddress->postcode}} {{$shippingAddress->city}}, {{$shippingAddress->street}}
                                    </a>
                                    <div class="d-none">
                                        {{ $shippingAddress }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Szállítási adatok vége -->

        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
@endsection

@section("scripts")
<script>
    $(".shipping_address").on("click", function() {
        let szallitasiAdatok = JSON.parse($(this).parent().find("div").html());
        
        $("#shipping_name").val(szallitasiAdatok.name);
        $("#shipping_postcode").val(szallitasiAdatok.postcode);
        $("#shipping_city").val(szallitasiAdatok.city);
        $("#shipping_street").val(szallitasiAdatok.street);
        $("#shipping_phone").val(szallitasiAdatok.phone);
        $("#shipping_note").val(szallitasiAdatok.note);
        $("#shippingAddressId").val(szallitasiAdatok.id);
    });

    $(".billing_address").on("click", function() {
        let szamlazasiAdatok = JSON.parse($(this).parent().find("div").html());
        console.log(szamlazasiAdatok);

        if(szamlazasiAdatok.tax_number != null){
            $("#company").addClass("active");
            $("#person").removeClass("active");
            $(".taxNumber").removeClass("d-none");
        }
        if(szamlazasiAdatok.tax_number == null){
            $("#person").addClass("active");
            $("#company").removeClass("active");
            $(".taxNumber").addClass("d-none");
        }
        $("#billing_name").val(szamlazasiAdatok.name);
        $("#billing_country_id").val(szamlazasiAdatok.country_id);
        $("#billing_postcode").val(szamlazasiAdatok.postcode);
        $("#billing_city").val(szamlazasiAdatok.city);
        $("#billing_street").val(szamlazasiAdatok.street);
        $("#tax_number").val(szamlazasiAdatok.tax_number);
        $("#billingAddressId").val(szamlazasiAdatok.id);
    });

    $("#modify-button").on("click", function() {
        $("#profile-form").find("input").each(function() {
            $(this).attr("disabled", false);
        });
        $("#firstname").focus();
        $("#save-button-div").removeClass("d-none");
        $("#cancel-button-div").removeClass("d-none");
        $("#modify-button-div").addClass("d-none");
    });
    $("#cancel-button").on("click", function() {
        let alapadatok = JSON.parse($("#alapadatokDIV").html());
        
        $("#firstname").val(alapadatok.firstname);
        $("#lastname").val(alapadatok.lastname);
        $("#email").val(alapadatok.email);
        $("#student_card_number").val(alapadatok.student_card_number);

        $("#profile-form").find("input").each(function() {
            $(this).attr("disabled", true);
        });
        $("#save-button-div").addClass("d-none");
        $("#cancel-button-div").addClass("d-none");
        $("#modify-button-div").removeClass("d-none");
    });
    $(".billing_address").on("click", function(e) {
        e.preventDefault();
        
        $("#billing-new-btn").addClass("d-none");
        $("#billing-buttons").removeClass("d-none");
        $("#billing_name").focus();
        
    });
    $("#billing-delete-btn").on("click", function() {
        $("#shipping-new-btn").addClass("d-none");
        $("#shipping-buttons").removeClass("d-none");
    });
    $(".shipping_address").on("click", function(e) {
        e.preventDefault();
        $("#shipping-new-btn").addClass("d-none");
        $("#shipping-buttons").removeClass("d-none");
        $("#shipping_name").focus();
    });
    $("#person").on("click", function() {
        $(".taxNumber").addClass("d-none");
        $("#billing-type").val('1');
    });
    $("#company").on("click", function() {
        
        $(".taxNumber").removeClass("d-none");
        $("#billing-type").attr('value','2');
    });
    $("#shipping_phone").inputmask("(99) 999-999[9]",{ "placeholder": "_" });

    $("#shipping_cancel_btn").on("click", function() {
        $("#shipping_name").val("");
        $("#shipping_postcode").val("");
        $("#shipping_city").val("");
        $("#shipping_street").val("");
        $("#shipping_phone").val("");
        $("#shipping_note").val("");

        $("#shipping-new-btn").removeClass("d-none");
        $("#shipping-buttons").addClass("d-none");
        $("#shipping_name").focus();
    });
    $("#billing_cancel_btn").on("click", function() {
        $("#billing_name").val("");
        $("#billing_postcode").val("");
        $("#billing_city").val("");
        $("#billing_street").val("");
        $("#billing_country_id").val("1");
        $("#tax_number").val("");

        $("#billing-new-btn").removeClass("d-none");
        $("#billing-buttons").addClass("d-none");
        $("#billing_name").focus();
    });
    $(".profilMenuBtn").on("click", function(e) {
        e.preventDefault();
        $(".profilMenuBtn").removeClass("active-profilMenuBtn");
        $(this).addClass("active-profilMenuBtn");

        if( $(this).text() == "Személyes adataim"){
            $("#personalDiv").removeClass("d-none");
            $("#passwordDiv").addClass("d-none");
            $("#billingDiv").addClass("d-none");
            $("#shippingDiv").addClass("d-none");
        }
        else if( $(this).text() == "Jelszó módosítás"){
            $("#passwordDiv").removeClass("d-none");
            $("#personalDiv").addClass("d-none");
            $("#billingDiv").addClass("d-none");
            $("#shippingDiv").addClass("d-none");
        }
        else if( $(this).text() == "Címeim"){
            $("#shippingDiv").removeClass("d-none");
            $("#billingDiv").removeClass("d-none");
            $("#passwordDiv").addClass("d-none");
            $("#personalDiv").addClass("d-none");
        }
    });
    if( $("#dangerPasswordMsg").length != 0 ){
        $("#passwordDiv").removeClass("d-none");
        $("#personalDiv").addClass("d-none");
        $("#billingDiv").addClass("d-none");
        $("#shippingDiv").addClass("d-none");
        $(".profilMenuBtn").removeClass("active-profilMenuBtn");
        $("#nav_item_password").addClass("active-profilMenuBtn");
    };
    if( $("#successPasswordMsg").length != 0 ){
        $("#passwordDiv").removeClass("d-none");
        $("#personalDiv").addClass("d-none");
        $("#billingDiv").addClass("d-none");
        $("#shippingDiv").addClass("d-none");
        $(".profilMenuBtn").removeClass("active-profilMenuBtn");
        $("#nav_item_password").addClass("active-profilMenuBtn");
    };
    if( $("#dangerBillingMsg").length != 0 ){
        $("#passwordDiv").addClass("d-none");
        $("#personalDiv").addClass("d-none");
        $("#billingDiv").removeClass("d-none");
        $("#shippingDiv").removeClass("d-none");
        $(".profilMenuBtn").removeClass("active-profilMenuBtn");
        $("#nav_item_address").addClass("active-profilMenuBtn");
    };
    if( $("#successBillingMsg").length != 0 ){
        $("#passwordDiv").addClass("d-none");
        $("#personalDiv").addClass("d-none");
        $("#billingDiv").removeClass("d-none");
        $("#shippingDiv").removeClass("d-none");
        $(".profilMenuBtn").removeClass("active-profilMenuBtn");
        $("#nav_item_address").addClass("active-profilMenuBtn");
    };
    if( $("#dangerShippingMsg").length != 0 ){
        $("#passwordDiv").addClass("d-none");
        $("#personalDiv").addClass("d-none");
        $("#billingDiv").removeClass("d-none");
        $("#shippingDiv").removeClass("d-none");
        $(".profilMenuBtn").removeClass("active-profilMenuBtn");
        $("#nav_item_address").addClass("active-profilMenuBtn");
    };
    if( $("#successShippingMsg").length != 0 ){
        $("#passwordDiv").addClass("d-none");
        $("#personalDiv").addClass("d-none");
        $("#billingDiv").removeClass("d-none");
        $("#shippingDiv").removeClass("d-none");
        $(".profilMenuBtn").removeClass("active-profilMenuBtn");
        $("#nav_item_address").addClass("active-profilMenuBtn");
    };
    if( $("#dangerPersonalMsg").length != 0 ){
        $("#passwordDiv").addClass("d-none");
        $("#personalDiv").removeClass("d-none");
        $("#billingDiv").addClass("d-none");
        $("#shippingDiv").addClass("d-none");
        $(".profilMenuBtn").removeClass("active-profilMenuBtn");
        $("#nav_item_personal").addClass("active-profilMenuBtn");
    };
    if( $("#successPersonalMsg").length != 0 ){
        $("#passwordDiv").addClass("d-none");
        $("#personalDiv").removeClass("d-none");
        $("#billingDiv").addClass("d-none");
        $("#shippingDiv").addClass("d-none");
        $(".profilMenuBtn").removeClass("active-profilMenuBtn");
        $("#nav_item_personal").addClass("active-profilMenuBtn");
    };
    
</script>
@endsection
@section('footer')
    
@endsection