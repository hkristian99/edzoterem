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
                    <h2>Új felhasználó felvétele</h2><br><br>
                </div>
                <div class="x_content">
                    <!-- HIBÁK HELYE-->
                    <!-- HIBÁK HELYE VÉGE-->
                    <form class="needs-validation" novalidate action="{{route("adminUserStore")}}" method="POST">
                        @csrf
                        <div class="form-group col-md-6">
                            <br><h5 for="firstname" class="form-label">Vezetéknév</h5>
                            <input type="text" class="form-control" id="firstname" style="text-transform: capitalize;" required>
                        </div>
                        <div class=" form-group col-md-6">
                            <br><h5 for="lastname" class="form-label">Keresztnév</h5>
                            <input type="text" class="form-control" id="lastname" style="text-transform: capitalize;" required>
                        </div>
                        <div class="form-group col-md-12">
                            <br><h5 for="email" class="form-label">Email cím</h5>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group col-md-12">
                            <br><h5 for="role" class="form-label">Szerepkör(ök)</h5>
                            <div class="userRoles" style="border: 2px solid rgb(100, 100, 100)">
                                @foreach ($roles as $role)
                                    <label class="btn btn-primary d-none" id="role-{{$role->id}}" style="margin:10px; margin-right:0px;">{{$role->name}}</label>
                                @endforeach
                            </div><br>
                            <h6>Választható:</h6>
                            @foreach ($roles as $role)
                                <div class="userRole-{{$role->id}}" style="width:auto;">
                                    <input type="checkbox" class="btn-check d-none" id="btn-check-{{$role->id}}">
                                    <label class="btn btn-primary rolebtn" for="btn-check-{{$role->id}}">{{$role->name}}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group col-md-12">
                          <button class="btn btn-success" type="submit">Felhasználó felvétele</button>
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
        $(".rolebtn").on("click", function() {
            console.log("szerepkör = " + (this).innerHTML);

        });
    </script>
@endsection