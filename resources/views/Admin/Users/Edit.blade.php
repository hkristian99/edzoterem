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
                    <div class="col-lg-6 text-left">
                    <br><h5>{{$user->firstname}} {{$user->lastname}}<small> - adatainak módosítása</small></h5>
                </div>
                <div class="col-lg-6 text-right">
                    <br><a href="{{route("adminUsers")}}" class="btn btn-danger">Mégsem</a>
                </div><br><br><br>
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
                <form class="" action="{{route("adminUserUpdate",$user->id)}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <br><h5 for="firstname" class="form-label">Vezetéknév</h5>
                            <input type="text" class="form-control" id="firstname" name="firstname"value="{{$user->firstname}}">
                        </div>
                        <div class=" form-group col-12">
                            <br><h5 for="lastname" class="form-label">Keresztnév</h5>
                            <input type="text" class="form-control" id="lastname" name="lastname"  value="{{$user->lastname}}">
                        </div>
                        <div class="form-group col-12">
                            <br><h5 for="email" class="form-label">Email cím</h5>
                            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                        </div>
                        <div class="form-group col-12">
                            <br><h5 for="password" class="form-label">Jelszó</h5><small> - csak módosítás esetén - </small>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group col-12">
                            <br><h5 class="form-label">Státusz</h5>
                            <select class="form-control" id="statusList" name="status">
                                @if ( $user->status=="3" )
                                    <option value="" disabled selected>Jelszó váltás kötelező</option>
                                @endif

                                @foreach ($userStatuses as $userStatus)
                                    <option value="{{$userStatus->id}}" {{$userStatus->id == $user->status ? "selected" : ""}}>{{$userStatus->name}}</option>
                                @endforeach
                            </select>

                            <h6 class="d-none" id="statusPw">Jelszó változtatás esetén a státusz automatikusan "Jelszó változatás"-ra módosul!</h6>
                        </div>
                        <div class="form-group col-12">
                            <br><h5 for="email" class="form-label">Szerepkör(ök)</h5><br>
                            @foreach ($roles as $role)
                                <div class="">
                                    <input type="checkbox" class="flat roles" name="roles[]" value="{{$role->id}}" id="role_{{$role->id}}" {{ (old() && in_array($role->id,old("roles"))) || ( !old() && in_array($role->id,$userRoles) ) ? "checked" : " " }}>
                                    <label for="role_{{$role->id}}">{{$role->name}}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group col-12">
                            <button class="btn btn-success" type="submit">Módosítás</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Új Felhasználó felvétele FORM vége -->
</div>
<!-- /page content -->
@endsection
@section('scripts')
    <script>
        $("#password").keyup(function() {
            if ( $(this).val().length==0 ) {
                $("#statusList").removeClass("d-none");
                $("#statusPw").addClass("d-none");
            } else {
                $("#statusList").addClass("d-none");
                $("#statusPw").removeClass("d-none");
            }
        });
    </script>
@endsection