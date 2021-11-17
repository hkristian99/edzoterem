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
                <div class="col text-right" id="modify-button-div" style="padding:0px;">
                    
                    <button type="button" id="modify-button" class="primary-btn modify-btn">Módosítás</button>
                </div>
                <div class="form-row">
                    <div class="col text-right d-none" id="save-button-div">
                        <button type="submit" id="personal-save-btn" class="primary-btn modify-btn save-btn">Módosítások mentése</button>
                        <button type="button" id="cancel-button" class="primary-btn appoinment-btn cancel-btn">Mégse</button>
                    </div>
                </div>
                @if ($errors->any() )
                    <div class="alert alert-danger">   
                        @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                        @endforeach 
                    </div>
                @endif
                @if( Session::has('success') )
                    <div class="alert alert-success">
                    {{ Session::get('success') }}
                    </div>
                @endif
                <form  name="profile" id="profile-form" action="{{route("profilUpdate")}}" method="POST">
                    @csrf
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
                            <input class="input" name="student_card_number" value="764088829" type="text" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="text-white">Diákgazolványkép - előlap: <small>*</small></label>
                            <input class="input" name="student_card_front" value="764088829" type="file" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="text-white">Diákgazolványkép - hátlap: <small>*</small></label>
                            <input class="input" name="student_card_back" value="764088829" type="file" disabled>
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
            <div class="leave-comment">
                <div class="form-group col-md-12" style="padding:0px;">
                    <h2 class="text-white">Számlázási cím: <small> (kötelező rendelés esetén)</small></h2><br>
                    <div class="form-row">
                        <div id="billing-address-form" class="col-12 col-md-7" style="padding-top: 20px;">
                            <form  name="profile" id="profile-form" action="{{route("profilUpdate")}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <div class="row">
                                            <div  id="shipping-types" class="col-md-6 table-controls text-left">
                                                <ul id="shipping-types-ul" >
                                                    <li id="person" class="active" >Magánszemély</li>
                                                    <li id="company" class="">Cég</li>
                                                </ul>
                                            </div>
                                            <div id="billing-new-btn" class="col-md-6 text-right">
                                                <button type="submit" id="personal-save-btn" class="primary-btn modify-btn save-btn" style="margin:0px">Új cím hozzáadása</button>
                                            </div>
                                            <div id="billing-buttons"class="col-md-6 text-right d-none" style="padding-left:0px;">
                                                <button type="submit" id="billing-save-btn" class="primary-btn modify-btn save-btn" style="">Módosítás</button>
                                                <button type="button" id="billing-delete-btn" class="primary-btn appoinment-btn cancel-btn">Törlés</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input id="billing-name" class="input" name="" value="Név" type="text">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input class="input" name="" value="Ország" type="text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="input" name="" value="Irányítószám" type="text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="input" name="" value="Város" type="text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="input" name="" value="Utca, házszám" type="text">
                                    </div>
                                    <div class="form-group col-md-12 taxNumber d-none">
                                        <input class="input" name="" value="Adószám" type="text">
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-5 text-left" style="padding-left: 100px;">
                            <label class="text-white">Eddigi számlázási címeim:</label><br>
                            <ul>
                                <li><a href="#" class="billing-address">Kis Pista - 1081 Budapest, Csokonai utca 3.</a></li>
                                <li><a href="#" class="billing-address">Nagy Jóska - 1111 Budapest, Teszt utca 11.</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--Számlázási adatok vége -->

            <hr style="border:rgb(156, 156, 156) solid 2px; width:80%; margin-bottom:50px;">

            <!--Szállítási adatok -->
            <div class="leave-comment">
                <div class="form-group col-md-12">
                    <h2 class="text-white">Szállítási címeim: <small> (opcionális)</small></h2><br>
                    <div class="row">
                        <div id="shipping-address-form" class="col-12 col-md-7" style="padding-top: 20px;">
                            <form  name="profile" id="profile-form" action="{{route("profilUpdate")}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <div class="row">
                                            <div id="shipping-new-btn" class="col-md-12 text-right" style="padding-left:0px;">
                                                <button type="submit" id="shipping-save-btn" class="primary-btn modify-btn">Új cím hozzádása</button><button type="button" id="shipping-delete-btn" class="primary-btn appoinment-btn cancel-btn d-none">Törlés</button>
                                            </div>
                                            <div id="shipping-buttons"class="col-md-12 text-right d-none" style="padding-left:0px;">
                                                <button type="submit" id="shipping-modify-btn" class="primary-btn modify-btn save-btn">Módosítás</button>
                                                <button type="button" id="shipping-delete-btn" class="primary-btn appoinment-btn cancel-btn">Törlés</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input id="shipping-name" class="input" name="" value="Név" type="text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="input" name="" value="Irányítószám" type="text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="input" name="" value="Város" type="text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input class="input" name="" value="Utca, házszám" type="text">
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-5" style="padding-left: 100px;">
                            <label class="text-white">Eddigi szállítási címeim:</label><br>
                            <ul>
                                <li><a href="#" class="shipping-address"> Kis Pista - 1081 Budapest, Csokonai utca 3.</a></li>
                                <li><a href="#" class="shipping-address">Nagy Jóska - 1111 Budapest, Teszt utca 11.</a></li>
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
        });
        $("#company").on("click", function() {
            console.log("itt");
            $(".taxNumber").removeClass("d-none");
        });
    </script>
    @endsection