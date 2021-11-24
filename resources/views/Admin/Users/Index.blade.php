@extends('Admin.Layouts.Master')
@section('content')
<!-- page content -->
<div class="right_col" role="main">

    <!-- Cím -->
    <div class="row x_title">
        <div class="col-12" style="text-align: center">
            <h3>Felhasználók kezelése </h3>
        </div>
    </div>
    <!-- FelhasználókCím vége -->

    <!-- Felhasználók táblázat -->
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel tile">
            <div class="x_title">
                <h2>Felhasználók lista</h2><br><br>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table jambo_table bulk_action">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Vezetéknév</th>
                                <th scope="col">Keresztnév</th>
                                <th scope="col">E-mail cím</th>

                                <!--<th scope="col">@sortablelink('id','#')</th>
                                <th scope="col">@sortablelink('firstname','Vezetéknév')</th>
                                <th scope="col">@sortablelink('lastname','Keresztnév')</th>
                                <th scope="col">@sortablelink('email','E-mail cím')</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="" style="cursor:pointer;" onClick="document.location.href='{{ route("adminUserEdit", $user->id) }}';">
                                <td scope="row">{{$user->id}}</td>
                                <td>{{$user->firstname}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- Felhasználók táblázat vége -->


    </div>
<!-- /page content -->
@endsection