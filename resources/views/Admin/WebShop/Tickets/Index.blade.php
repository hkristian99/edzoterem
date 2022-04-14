@extends('Admin.Layouts.Master')
@section('content')
<link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<!-- page content -->
<div class="right_col" role="main">
    <div class="row x_title">
        <div class="col text-center">
            <h3>Webshop<br> <small>- Termékek kezelése -</small></h3>
        </div>
    </div>
    <!-- Felhasználók táblázat -->
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Bérlet lista</h2>
                <div class="text-right">
                    <a href="{{route("ticketCreate")}}" class="btn btn-sm btn-success" >Új felvétele</a>
                </div>
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
                            <table id="ticket_table" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>Név</th>
                                        <th>Leírás</th>
                                        <th>Lista ár</th>
                                        <th>Kedvezményes ár</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                    <tr  class="odd text-left" style="cursor:pointer;" onClick="document.location.href='{{ route("ticketEdit", $ticket->id) }}';">
                                        <td>{{$ticket->name}}</td>
                                        <td>{{$ticket->description}}</td>
                                        <td class="text-center">{{$ticket->list_price}} Ft</td>
                                        <td class="text-center">{{$ticket->discount_price}} Ft</td>
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
            $('#ticket_table').DataTable({
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