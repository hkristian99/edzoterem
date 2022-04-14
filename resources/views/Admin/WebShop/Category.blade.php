@extends('Admin.Layouts.Master')
@section('content')
<link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<!-- page content -->
<div class="right_col" role="main">
    <div class="row x_title">
        <div class="col text-center">
            <h3>Webshop<br> <small>- Termék kategóriák kezelése -</small></h3>
        </div>
    </div>
    <!-- Felhasználók táblázat -->
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Kategóriák lista</h2>
                <div class="text-right">
                    <button type="button" class="btn btn-sm btn-success addCategory" data-toggle="modal" data-target=".modifyCategory" aria-placeholder="Név">Új felvétele</button>
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
                            <table id="category_table" class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Név</th>
                                        <th>Főkategória</th>
                                        <th>Művelet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr class="odd" aria-data="{{ $category->id }}" aria-label="{{ $category->name }}">
                                        <td class="text-center">{{$category->id}}</td>
                                        <td class="text-center">{{$category->name}}</td>
                                        @if ($category->parent_id != 0)
                                        <td class="text-center">{{$category->getParentCategory($category->parent_id)}}</td>
                                        @else
                                        <td class="text-center">FŐKATEGÓRIA</td>
                                        @endif
                                        <td class="text-right">
                                            <button type="button" class="btn btn-sm btn-secondary deleteButton cella" data-toggle="modal" data-target=".modifyCategory" aria-data="{{ $category->id }}" aria-data-parentID="{{$category->parent_id}}" aria-label="{{ $category->name }}">Módosítás</button> 
                                            <button type="button" class="btn btn-sm btn-danger deleteButton" data-toggle="modal" data-target=".deleteCategory" aria-data="{{ $category->id }}" aria-label="{{ $category->name }}">Törlés</button>
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

    <!-- Új kategória Modal-->
    <div class="modal modifyCategory fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route("categoryStore")}}" method="POST" id="categoryForm">
                    @csrf 
                    <div class="modal-header">
                        <h4 class="modal-title taskModal" id="myModalLabel2">Új kategória hozzáadása</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" class="taskModalInput" id="name" placeholder="Név" autofocus>
                        <br><br>
                        <label for="parentCategory">Főkategória</label>
                        <select name="parentCategory"  id="parentCategory" class="taskModalInput" style="height: 47px;" >
                            <option value="" disabled selected>- Válassz a kategóriák közül -</option>
                            <option value="0">Új főkategória</option>
                            @foreach ($mainCategories as $mainCategory)
                                <option value="{{$mainCategory->id}}" style="font-weight: bold;">{{$mainCategory->name}}
                                    @foreach ($mainCategory->getSubCategories($mainCategory->id) as $subCategory)
                                        <option value="{{$subCategory->id}}" style="font-style: italic;">&nbsp&nbsp{{$subCategory->name}}</option>
                                    @endforeach
                                </option>
                                
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <div id="modalNew">
                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Mégse</a>
                            <button id="addCategoryBtn" type="submit" class="btn btn-success">Hozzáad</button>
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
    <!-- Új kategória Modal End-->

    <!-- Kategória Delete Modal-->
    <div class="modal deleteCategory fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route("categoryDestroy")}}" method="POST" id="categoryForm">
                    @csrf
                    <input type="hidden" name="categoryId" id="categoryId" value="">
                    <div class="modal-header">
                        <h4 class="modal-title taskModal" id="myModalLabel2">Kategória törlése</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Biztosan törölni szeretnéd ezt a kategóriát?
                        <br>
                        <p class="font-weight-bold" id="categoryName"></p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Mégse</a>
                        <button type="submit" class="btn btn-danger">Törlés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Kategória Delete Modal End-->
</div>
</div>
<!-- /page content -->
@endsection
@section('scripts')
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#category_table').DataTable({
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
        $(".addCategory").on("click", function(e) {
            let name = $(this).attr("aria-label");
            $("#name").val(name);
            $("#parentCategory").val("");

            $("#modalNew").removeClass("d-none");
            $("#modalUpdate").addClass("d-none");

            $(".modal-title").html("Új kategória hozzáadása");
            $(".modifyCategory").modal("show");
        });

        $(".cella").on("click", function(e) {
            let id = $(this).attr("aria-data");
            let name = $(this).attr("aria-label");
            let parent_id = $(this).attr("aria-data-parentID");

            $("#categoryForm").attr("action", "/admin/webshop/kategoriak/update/"+id);
            $("#name").val(name);
            $("#parentCategory").val(parent_id);

            $("#modalNew").addClass("d-none");
            $("#modalUpdate").removeClass("d-none");

            $(".modal-title").html("Kategória módosítása");

            $(".modifyCategory").modal("show");

        });
        $(".deleteButton").on("click", function(e) {
            let id = $(this).attr("aria-data");
            let name = $(this).attr("aria-label");

            $("#categoryId").val(id);
            $("#categoryName").html(name);
        });

        $("#parentCategory").on("click", function(e) {
            console.log($(this).val());
            $("#parentCategory1").removeClass("d-none");
        });
        
    </script>
@endsection