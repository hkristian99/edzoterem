@extends('Admin.Layouts.Master')
@section('content')
<link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
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
    <div class="x_panel">
        <div class="x_title">
            <h2>Felhasználók lista</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="user_table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vezetéknév</th>
                                    <th>Keresztnév</th>
                                    <th>E-mail cím</th>
                                    <th><input type="checkbox" id="check-all"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr  class="odd" style="cursor:pointer;" onClick="document.location.href='{{ route("adminUserEdit", $user->id) }}';">
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->firstname}}</td>
                                    <td>{{$user->lastname}}</td>
                                    <td>{{$user->email}}</td>
                                    <th class="sorting_1"><input type="checkbox" id="check-all"></th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Felhasználók táblázat vége -->
</div>
<!-- /page content -->

@endsection
@section('scripts')
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#user_table').DataTable();
        } );
    </script>
@endsection