@extends('Admin.Layouts.Master')
@section('content')
<!-- page content -->
<div class="right_col" role="main">

        <!-- Cím -->
        <div class="row x_title">
            <div class="col-md-12" style="text-align: center">
                <h3>Felhasználók kezelése</h3>
            </div>
        </div>
        <!-- Cím vége -->

        <!-- Új Felhasználó felvétele FORM -->
        <div class="col-md-12">
            <div class="x_panel tile">
                <div class="x_title">
                    <br><h5>Új felhasználó felvétele</h5>
                </div>
                <!-- HIBÁK HELYE-->
                @if ($errors->any() )
                    <div class="alert alert-danger">   
                        @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                        @endforeach 
                    </div>
                @endif
                <!-- HIBÁK HELYE VÉGE-->
                <div class="d-flex justify-content-center">
                    <form class="needs-validation" novalidate action="{{route("adminUserStore")}}" method="POST">
                        @csrf
                        <div class="form-group col-md-12">
                            <br><h5 for="firstname" class="form-label">Vezetéknév</h5>
                            <input type="text" class="form-control" id="firstname" value="{{old("firstname")}}" name="firstname" style="text-transform: capitalize;" required>
                        </div>
                        <div class=" form-group col-md-12">
                            <br><h5 for="lastname" class="form-label">Keresztnév</h5>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{old("lastname")}}" style="text-transform: capitalize;" required>
                        </div>
                        <div class="form-group col-md-12">
                            <br><h5 for="email" class="form-label">Email cím</h5>
                            <input type="email" class="form-control" id="email" name="email" value="{{old("email")}}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <br><h5 for="password" class="form-label">Jelszó<small> (Alapértelmezett, első belépéskor változtatás szükséges)</small></h5>
                            <input type="text" class="form-control" id="password" name="password" value="{{$password}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <br><h5 class="form-label">Szerepkör(ök)</h5><br>
                            @foreach ($roles as $role)
                                <div class="">
                                    <input type="checkbox" class="flat roles" id="roles[]" name="roles[]">
                                    <label for="role_{{$role->id}}">{{$role->name}}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group col-md-6">
                            <br><h5 class="form-label">Értesítés</h5><br>
                            <input type="radio" class="flat roles"  name="Notification" checked>
                            <label for="emailNotification">Regisztrációs levél küldése a megadott e-mail címre.</label><br>
                            <input type="radio" class="flat roles" id="SMSNotification" name="Notification" >
                            <label for="SMSNotification">Regisztrációs SMS küldése telefonszámra.</label><br><br>
                            <label for="phoneNumber">Telefonszám:</label>
                            <input type="text" class="form-control " id="phoneNumber" name="phoneNumber" disabled>
                            
                        </div>
                        <div class="form-group col-md-12 text-right">
                            <br><button class="btn btn-success" type="submit">Felhasználó felvétele</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Új Felhasználó felvétele FORM vége -->

</div>
<!-- /page content -->
@endsection
@section('scripts')
    <script>
        $("#phoneNumber").inputmask("(99) 999-999[9]",{ "placeholder": "_" });
        if( $("#SMSNotification").checked ){
            console.log("itt");
            $("#phoneNumber").removeAttr("disabled");
        }
    </script>
@endsection