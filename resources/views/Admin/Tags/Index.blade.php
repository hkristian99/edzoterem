@extends('Admin.Layouts.Master')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row x_title">
        <div class="col-12" style="text-align: center">
            <h3>Címkék </h3>
        </div>
    </div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".modal">Új címke</button>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                @if( Session::has('success') )
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                <table class="table jambo_table bulk_action">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th class="column-title">Név</th>
                            <th class="column-title">Művelet</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr class="sor text-left" style="cursor:pointer;" aria-data="{{ $tag->id }}" aria-label="{{ $tag->name }}">
                                <td class="cella text-left" style="vertical-align:middle;">
                                    {{$tag->name}}
                                </td>
                                <td class="text-center" style="vertical-align:middle;">
                                    <button type="button" class="btn btn-sm btn-danger deleteButton" data-toggle="modal" data-target=".deleteTag" aria-data="{{ $tag->id }}" aria-label="{{ $tag->name }}">Törlés</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>        
        </div>
    </div>
  </div>
<div class="clearfix"></div>
</div>


<!-- Tags Modal-->
<div class="modal Tag fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{route("tagStore")}}" method="POST" id="tagForm">
                @csrf 
                <div class="modal-header">
                    <h4 class="modal-title taskModal" id="myModalLabel2">Új címke hozzáadása</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="taskModalInput" id="name" placeholder="Név" autofocus>
                </div>
                <div class="modal-footer">
                    <div id="modalNew">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Mégse</a>
                        <button id="addTaskBtn" type="submit" class="btn btn-success">Hozzáad</button>
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
<!-- Tags Modal End-->

<!-- Tags Delete Modal-->
<div class="modal deleteTag fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{route("tagDestroy")}}" method="POST" id="tagForm">
                @csrf
                <input type="hidden" name="tagId" id="tagId" value="">
                <div class="modal-header">
                    <h4 class="modal-title taskModal" id="myModalLabel2">Címke törlése</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Biztosan törölni szeretnéd ezt a címkét?
                    <br>
                    <p class="font-weight-bold" id="tagName"></p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Mégse</a>
                    <button id="addTaskBtn" type="submit" class="btn btn-danger">Törlés</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Tags Delete Modal End-->


<!-- page content end-->
@endsection

@section('scripts')
    <script>
        $(".cella").on("click", function(e) {
            let id = $(this).attr("aria-data");
            let name = $(this).attr("aria-label");

            $("#tagForm").attr("action", "/admin/tags/update/"+id);
            $("#name").val(name);

            $("#modalNew").addClass("d-none");
            $("#modalUpdate").removeClass("d-none");

            $(".modal-title").html("Címke módosítása");

            $(".Tag").modal("show");

        });

        $(".deleteButton").on("click", function(e) {
            let id = $(this).attr("aria-data");
            let name = $(this).attr("aria-label");

            $("#tagId").val(id);
            $("#tagName").html(name);
        });
    </script>
@endsection