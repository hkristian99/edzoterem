@extends('Admin.Layouts.Master')
@section('content')
<link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<!-- page content -->
<div class="right_col" role="main">
    <div class="row x_title">
        <div class="col text-center">
            <h3>Webshop<br> <small>- Termék gyártók kezelése -</small></h3>
        </div>
    </div>

    <!-- Felhasználók táblázat -->
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Gyártók lista </h2>
                <div class="text-right">
                    <button type="button" class="btn btn-sm btn-success addManufacturer" data-toggle="modal" data-target=".modifyManufacturer">Új felvétele</button>
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
                            <table id="manufacturer_table" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Név</th>
                                        <th>Művelet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($manufacturers as $manufacturer)
                                    <tr class="odd" aria-data="{{ $manufacturer->id }}" aria-label="{{ $manufacturer->name }}">
                                        <td class="text-center">{{$manufacturer->id}}</td>
                                        <td class="text-center">{{$manufacturer->name}}</td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-sm btn-secondary deleteButton cella" data-toggle="modal" data-target=".modifyManufacturer" aria-data="{{ $manufacturer->id }}" aria-label="{{ $manufacturer->name }}">Módosítás</button> 
                                            <button type="button" class="btn btn-sm btn-danger deleteButton" data-toggle="modal" data-target=".deleteManufacturer" aria-data="{{ $manufacturer->id }}" aria-label="{{ $manufacturer->name }}">Törlés</button>
                                        </td>
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

    <!-- Gyártó módosítás Modal-->
    <div class="modal modifyManufacturer fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route("manufacturerStore")}}" method="POST" id="manufacturerForm">
                    @csrf 
                    <div class="modal-header">
                        <h4 class="modal-title taskModal" id="myModalLabel2">Új gyártó hozzáadása</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" class="taskModalInput" id="name" placeholder="Név" autofocus>
                    </div>
                    <div class="modal-footer">
                        <div id="modalNew">
                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Mégse</a>
                            <button id="addManufacturerBtn" type="submit" class="btn btn-success">Hozzáad</button>
                        </div>
                        <div id="modalUpdate" class="d-none">
                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Mégse</a>
                            <button id="addTaskBtn" type="submit" class="btn btn-success">Módosítás</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Gyártó módosítás Modal End-->

    <!-- Gyártó Delete Modal-->
    <div class="modal deleteManufacturer fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route("manufacturerDestroy")}}" method="POST" id="manufacturerForm">
                    @csrf
                    <input type="hidden" name="manufacturerId" id="manufacturerId" value="">
                    <div class="modal-header">
                        <h4 class="modal-title taskModal" id="myModalLabel2">Gyártó törlése</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Biztosan törölni szeretnéd ezt a gyártót?
                        <br>
                        <p class="font-weight-bold" id="manufacturerName"></p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Mégse</a>
                        <button id="addTaskBtn" type="submit" class="btn btn-danger">Törlés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Gyártó Delete Modal End-->
</div> 
</div>
<!-- /page content -->
@endsection
@section('scripts')
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#manufacturer_table').DataTable({
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
        $(".addManufacturer").on("click", function(e) {
            let name = $(this).attr("aria-label");
            $("#name").val(name);

            $("#modalNew").removeClass("d-none");
            $("#modalUpdate").addClass("d-none");

            $(".modal-title").html("Új gyártó hozzáadása");
            $(".modifyManufacturer").modal("show");
        });
        $(".cella").on("click", function(e) {
            let id = $(this).attr("aria-data");
            let name = $(this).attr("aria-label");

            $("#manufacturerForm").attr("action", "/admin/webshop/gyartok/update/"+id);
            $("#name").val(name);

            $("#modalNew").addClass("d-none");
            $("#modalUpdate").removeClass("d-none");

            $(".modal-title").html("Gyártó módosítása");

            $(".modifyManufacturer").modal("show");

        });
        $(".deleteButton").on("click", function(e) {
            let id = $(this).attr("aria-data");
            let name = $(this).attr("aria-label");

            $("#manufacturerId").val(id);
            $("#manufacturerName").html(name);
        });
    </script>
@endsection