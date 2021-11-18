@extends('Public.Layouts.Master')
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-text">
                    <h2>Profilom</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Contact Section Begin -->
<section class="contact-section spad">
    <div class="container">
        <div class="row justify-content-center">

            <!-- Személyes adatok -->
            <div class="leave-comment">
                <h2 class="text-white">Alapadatok: </h2><br>
                
                @if (count($errors->personalError) > 0 )
                    <div class="alert alert-danger">   
                        @foreach ($errors->personalError->all() as $error)
                        {{ $error }}<br>
                        @endforeach 
                    </div>
                @endif
                @if( session()->has('successPersonal') )
                    <div class="alert alert-success">
                        {{ session()->get('successPersonal') }}
                    </div>
                @endif
                <form  name="profile" id="profile-form" action="{{route("profilUpdate")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col text-right" id="modify-button-div" style="padding:0px;">
                        <button type="button" id="modify-button" class="primary-btn modify-btn">Módosítás</button>
                    </div>
                    <div class="form-row">
                        <div class="col text-right d-none" id="save-button-div">
                            <button type="submit" id="personal-save-btn" class="primary-btn modify-btn save-btn">Módosítások mentése</button>
                            <button type="button" id="cancel-button" class="primary-btn appoinment-btn cancel-btn">Mégse</button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="text-white">Vezetéknév:</label>
                            <input class="input" id="firstname" name="firstname" value="{{Auth::user()->firstname}}" type="text" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="text-white">Keresztnév:</label>
                            <input class="input" name="lastname" value="{{Auth::user()->lastname}}" type="text" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="text-white">E-mail:</label>
                            <input class="input" name="email" value="{{Auth::user()->email}}" type="email" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="text-white">Diákgazolványszám: <small>*</small></label>
                            <input class="input" name="student_card_number" value="{{Auth::user()->student_card_number}}" type="text" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="text-white">Diákgazolványkép - előlap: <small>*</small></label><br>
                            <input type="file" class="file " id="student_card_front" name="student_card_front" disabled>    
                            @if (Auth::user()->student_card_front != null)
                                <img src="images/student_cards/{{Auth::user()->student_card_front}}"  class="student_card">
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label class="text-white">Diákgazolványkép - hátlap: <small>*</small></label><br>
                            <input type="file" class="file" name="student_card_back" disabled>  
                            @if (Auth::user()->student_card_front != null)  
                                <img src="images/student_cards/{{Auth::user()->student_card_back}}" class="student_card">
                            @endif
                        </div>
                        <div class="form-group col-md-12 text-right">
                            <label class=text-white><small>*A kedvezményes bérlet igénybevételéhez szükséges az érvényes diákigazolvány feltöltése</small></label>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Személyes adatok vége -->

            <hr style="border:rgb(156, 156, 156) solid 2px; width:80%; margin-bottom:50px;">

            <!-- Számlázási adatok -->
            <div class="leave-comment" id="billingDiv">
                <div class="form-group col-md-12" style="padding:0px;">
                    <h2 class="text-white">Számlázási cím: <small> (kötelező rendelés esetén)</small></h2><br>
                    <div class="form-row">
                        <div id="billing-address-form" class="col-12 col-md-7" style="padding-top: 20px;">
                            <form  name="profile" id="profile-form" action="{{route("billingAddressNew")}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        @if (count($errors->billingError) > 0 )
                                            <div class="alert alert-danger">   
                                                @foreach ($errors->billingError->all() as $error)
                                                {{ $error }}<br>
                                                @endforeach 
                                            </div>
                                        @endif
                                        @if( session()->has('successBilling') )
                                            <div class="alert alert-success">
                                            {{ session()->get('successBilling') }}
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div  id="billing-types" class="col-md-6 table-controls text-left">
                                                <ul id="billing-types-ul" >
                                                    <li id="person" class="active" >Magánszemély</li>
                                                    <li id="company" class="">Cég</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="billing-type" class="input" name="billing_type" value="1" >
                                    <div class="form-group col-md-12">
                                        <input id="billing-name" class="input" name="billing_name" placeholder="Név" type="text">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <select class="input form-control" name="billing_country_id">
                                            @foreach ($countries as $country)
                                            <option  value="{{$country["id"]}}"> {{$country["name"]}}</label></option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="input" name="billing_postcode" placeholder="Irányítószám" type="text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="input" name="billing_city" placeholder="Város" type="text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="input" name="billing_street" placeholder="Utca, házszám" type="text">
                                    </div>
                                    <div class="form-group col-md-12 taxNumber d-none">
                                        <input class="input" name="tax_number" placeholder="Adószám" type="text">
                                    </div>
                                    <div id="billing-new-btn" class="col-md-12 text-left">
                                        <button type="submit" id="billing-save-btn" class="primary-btn modify-btn save-btn" style="margin:0px">Új cím hozzáadása</button>
                                    </div>
                                    <div id="billing-buttons"class="col-md-12 text-left d-none" style="padding-left:0px;">
                                        <button type="submit" id="billing-edit-btn" class="primary-btn modify-btn save-btn" style="">Módosítás</button>
                                        <button type="button" id="billing-delete-btn" class="primary-btn appoinment-btn cancel-btn">Törlés</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-5 text-left" style="padding-left: 100px;">
                            <label class="text-white">Eddigi számlázási címeim:</label><br>
                            <ul>
                                @foreach ($billingAddresses as $billingAddress)
                                    <li><a href="#" class="billing-address">
                                        @if($billingAddress->tax_number != 0 ) Cég: @endif
                                        {{$billingAddress->name}}
                                        - {{$billingAddress->postcode}} {{$billingAddress->city}}, {{$billingAddress->street}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--Számlázási adatok vége -->

            <hr style="border:rgb(156, 156, 156) solid 2px; width:80%; margin-bottom:50px;">

            <!--Szállítási adatok -->
            <div class="leave-comment" id="shippingDiv">
                <div class="form-group col-md-12">
                    <h2 class="text-white">Szállítási címeim: <small> (opcionális)</small></h2><br>
                    <div class="row">
                        <div id="shipping-address-form" class="col-12 col-md-7" style="padding-top: 20px;">
                            <form  name="profile" id="profile-form" action="{{route("shippingAddressNew")}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        @if (count($errors->shippingError) > 0 )
                                            <div class="alert alert-danger">   
                                                @foreach ($errors->shippingError->all() as $error)
                                                {{ $error }}<br>
                                                @endforeach 
                                            </div>
                                        @endif
                                        @if( session()->has('successShipping') )
                                            <div class="alert alert-success">
                                            {{ session()->get('successShipping') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input id="shipping-name" class="input" name="shipping_name" value="{{old("shipping-name")}}" placeholder="Név" type="text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="input" name="shipping_postcode" value="{{old("shipping-postcode")}}" placeholder="Irányítószám" type="text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="input" name="shipping_city" value="{{old("shipping-city")}}" placeholder="Város" type="text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="input" name="shipping_street"value="{{old("shipping-street")}}" placeholder="Utca, házszám" type="text">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input id="phoneNumber" name="shipping_phone" value="{{old("shipping-phone")}}" placeholder="Telefonszám" maxlength="16" />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea  name="shipping_note" value="{{old("shipping-comment")}}" placeholder="Megjegyzés"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="row">
                                            <div id="shipping-new-btn" class="col-md-12 text-left" style="padding-left:0px;">
                                                <button type="submit" id="shipping-save-btn" class="primary-btn modify-btn">Új cím hozzádása</button>
                                            </div>
                                            <div id="shipping-buttons"class="col-md-12 text-left d-none" style="padding-left:0px;">
                                                <button type="submit" id="shipping-edit-btn" class="primary-btn modify-btn save-btn">Módosítás</button>
                                                <button type="button" id="shipping-delete-btn" class="primary-btn appoinment-btn cancel-btn">Törlés</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-5" style="padding-left: 100px;">
                            <label class="text-white">Eddigi szállítási címeim:</label><br>
                            <ul>
                                @foreach ($shippingAddresses as $shippingAddress)
                                    <li><a href="#" class="shipping-address"> {{$shippingAddress->name}}
                                        - {{$shippingAddress->postcode}} {{$shippingAddress->city}}, {{$shippingAddress->street}}</a></li>
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
<!-- Contact Section End -->
    @endsection

    @section("scripts")
    <script>
        $("#modify-button").on("click", function() {
            $("#profile-form").find("input").each(function() {
                $(this).attr("disabled", false);
            });
            $("#firstname").focus();
            $("#order-button1").removeClass("d-none");
            $("#order-button2").removeClass("d-none");
            $("#save-button-div").removeClass("d-none");
            $("#cancel-button-div").removeClass("d-none");
            $("#modify-button-div").addClass("d-none");
        });
        $("#cancel-button").on("click", function() {
            $("#profile-form").find("input").each(function() {
                $(this).attr("disabled", true);
            });
            $("#order-button1").addClass("d-none");
            $("#order-button2").addClass("d-none");
            $("#save-button-div").addClass("d-none");
            $("#cancel-button-div").addClass("d-none");
            $("#modify-button-div").removeClass("d-none");
        });
        $(".billing-address").on("click", function(e) {
            e.preventDefault();
            $("#billing-new-btn").addClass("d-none");
            $("#billing-buttons").removeClass("d-none");
            $("#billing-name").focus();
            $("#billing-name").attr('value','Kecske');
        });
        $("#billing-delete-btn").on("click", function() {
            $("#shipping-new-btn").addClass("d-none");
            $("#shipping-buttons").removeClass("d-none");
        });
        $(".shipping-address").on("click", function(e) {
            e.preventDefault();
            $("#shipping-new-btn").addClass("d-none");
            $("#shipping-buttons").removeClass("d-none");
            $("#shipping-name").focus();
        });
        $("#person").on("click", function() {
            $(".taxNumber").addClass("d-none");
            $("#billing-type").attr('value','s');
        });
        $("#company").on("click", function() {
            
            $(".taxNumber").removeClass("d-none");
            $("#billing-type").attr('value','2');
        });
        $("#phoneNumber").inputmask("(99) 999-999[9]",{ "placeholder": "_" });

    </script>
    @endsection