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
                            <br><h5 for="email" class="form-label">Szerepkör(ök)</h5>
                            <div class="form-group col-md-12" style="border:2px solid;">
                                <table class="table">
                                    <tr>
                                        <th><h6 style="padding-top: 14px;">Választott:</h6></th>
                                        <th>
                                            @foreach ($roles as $role)
                                                <span class="tag d-none" id="span_{{$role->id}}">{{$role->name}}&nbsp;
                                                    <a href="#" class="removing_roletag">x</a>
                                                </span>
                                            @endforeach
                                        </th>
                                    </tr>
                                    <tr>
                                        <td><h6 style="padding-top: 14px;">Választható:</h6></td>
                                        <td>
                                            @foreach ($roles as $role)
                                                <span class="tag add_roletag" id="span_addRole_{{$role->id}}">{{$role->name}}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
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
        $(".add_roletag").on("click", function() {
            $(this).addClass("d-none");
            var span = ($(this).get(0).innerHTML);
            console.log($(span).find("span"));
        });
        $(".removing_roletag").on("click", function() {
            var span = $(this).parent().get( 0 );
            $(span).addClass("d-none");
            $("#span_addRole_1").removeClass("d-none");
        });
    </script>
@endsection