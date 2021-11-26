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
                <div class="d-flex justify-content-center">
                    <!-- HIBÁK HELYE-->
                    <!-- HIBÁK HELYE VÉGE-->
                    <form class="needs-validation" novalidate action="{{route("adminUserStore")}}" method="POST">
                        @csrf
                        <div class="form-group col-md-12">
                            <br><h5 for="firstname" class="form-label">Vezetéknév</h5>
                            <input type="text" class="form-control" id="firstname" name="firstname" style="text-transform: capitalize;" required>
                        </div>
                        <div class=" form-group col-md-12">
                            <br><h5 for="lastname" class="form-label">Keresztnév</h5>
                            <input type="text" class="form-control" id="lastname" name="lastname"style="text-transform: capitalize;" required>
                        </div>
                        <div class="form-group col-md-12">
                            <br><h5 for="email" class="form-label">Email cím</h5>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group col-md-12">
                            <br><h5 for="email" class="form-label">Szerepkör(ök)</h5><br>
                            
                            @foreach ($roles as $role)
                                <div class="">
                                    <input type="checkbox" class="flat roles" id="role_{{$role->id}}">
                                    <label for="role_{{$role->id}}">{{$role->name}}</label>
                                </div>
                            @endforeach
                            <label id="activeRoles">Választott szerepkörök: <label><br>
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
    </script>
@endsection