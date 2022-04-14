@extends('Admin.Layouts.Master')
@section('content')
<link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<!-- page content -->
<div class="right_col" role="main">
    <div class="row x_title">
        <div class="col text-center">
            <h3>Webshop<br> <small>- Rendelések kezelése -</small></h3>
        </div>
    </div>
    <!-- Felhasználók táblázat -->
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Rendelések lista</h2>
                <div class="clearfix"></div>
            </div>
            @if( Session::has('success') )
                <div class="alert alert-success text-center">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="product_table" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Felhasználó</th>
                                        <th>Fizetés módja</th>
                                        <th>Szállítás</th>
                                        <th>Státusz</th>
                                        <th>Összeg</th>
                                        <th>Leadás</th>
                                        <th>Módosítás</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr  class="odd text-center" style="cursor:pointer;" onClick="document.location.href='{{ route("orderDetailsAdmin", $order->id) }}';">
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->getUserName($order->user_id)->firstname}} {{$order->getUserName($order->user_id)->lastname}}</td>
                                        <td>{{$order->getPaymode($order->paymode_id)}}</td>
                                        <td>{{$order->getShipping($order->shipping_mode_id)}}</td>
                                        <td>{{$order->getOrderStatus($order->order_status_id)}}</td>
                                        <td>{{number_format($order->grandtotal, 0, ',', ' ' ) }} Ft</td>
                                        <td>{{\Date::parse($order->created_at)->format("Y. M j. h:m") }}</td>
                                        <td>{{\Date::parse($order->updated_at)->format("Y. M j. h:m")}}</td>
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
</div>
<!-- Felhasználók táblázat vége -->
</div>
<!-- /page content -->
@endsection
@section('scripts')
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#product_table').DataTable({
                language: {
                    emptyTable: "Nincs rendelkezésre álló adat",
                    info: "Találatok: _START_ - _END_ Összesen: _TOTAL_",
                    infoEmpty: "Nulla találat",
                    infoFiltered: "(_MAX_ összes rekord közül szűrve)",
                    infoThousands: " ",
                    lengthMenu: "_MENU_ találat oldalanként",
                    loadingRecords: "Betöltés...",
                    processing: "Feldolgozás...",
                    search: "Keresés:",
                    zeroRecords: "Nincs a keresésnek megfelelő találat",
                    paginate: {
                        first: "Első",
                        previous: "Előző",
                        next: "Következő",
                        last: "Utolsó"
                    },
                    aria: {
                        sortAscending: ": aktiválja a növekvő rendezéshez",
                        sortDescending: ": aktiválja a csökkenő rendezéshez"
                    },
                }
            });
        } );
    </script>
@endsection