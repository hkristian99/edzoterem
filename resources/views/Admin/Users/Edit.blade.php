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
            <div class="x_panel tile row">
                <div class="x_title">
                    <div class="col-lg-6 text-left">
                        <br><h2>{{$user->firstname}} {{$user->lastname}}<small>adatainak módosítása</small></h2><br><br>
                    </div>
                    <div class="col-lg-6 text-right">
                        <br><a href="{{route("adminUsers")}}" class="btn btn-danger">Mégsem</a>
                    </div><br><br><br>
                </div>
                <div class="x_content">
                    <!-- HIBÁK HELYE-->
                    <!-- HIBÁK HELYE VÉGE-->
                    <form class="needs-validation" novalidate action="{{route("adminUserStore")}}" method="POST">
                        @csrf
                        <div class="form-group col-md-6">
                            <br><h5 for="firstname" class="form-label">Vezetéknév</h5>
                            <input type="text" class="form-control" id="firstname" value="{{$user->firstname}}">
                        </div>
                        <div class=" form-group col-md-6">
                            <br><h5 for="lastname" class="form-label">Keresztnév</h5>
                            <input type="text" class="form-control" id="lastname" value="{{$user->lastname}}">
                        </div>
                        <div class="form-group col-md-12">
                            <br><h5 for="email" class="form-label">Email cím</h5>
                            <input type="email" class="form-control" id="email" value="{{$user->email}}">
                        </div>
                        <div class="form-group col-md-12">
                            <br><h5 for="role" class="form-label">Szerepkör</h5>
                            @foreach ($roles as $role)
                                <input type="checkbox" class="btn-check d-none" id="btn-check-{{$role->id}}">
                                <label class="btn btn-primary" for="btn-check-{{$role->id}}">{{$role->name}}</label>
                            @endforeach
                        </div>
                        <div class="form-group col-md-12">
                          <button class="btn btn-success" type="submit">Módosítás</button>
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
    </script>
@endsection