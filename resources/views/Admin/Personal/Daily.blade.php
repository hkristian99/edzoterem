@extends('Admin.Layouts.Master')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <br>
        <div class="page-title">
            <div class="text-center">
                <h3>Napi teendők</h3>
            </div>
        </div>
        
        <div class="clearfix">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        <!-- Start to do list -->
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                            <div class="x_title">
                                <h2>Feladataim</h2>
                                <div class="text-right">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Új felvétele</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="">
                                <ul class="to_do" id="taskList">
                                    <li><p><input type="checkbox" class="flat"> Schedule meeting with new client</p></li>
                                    <li><p><input type="checkbox" class="flat"> Create email address for new intern</p></li>
                                </ul>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- End to do list -->

                        <!-- New To do List Modal-->
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title taskModal" id="myModalLabel2">Új feladat hozzáadása</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <h4 class="taskModal">Feladat leírása:</h4>
                                            <input type="text" class="taskModalInput" id="addTask" placeholder="Leírás">
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Mégse</a>
                                        <button id="addTaskBtn" class="btn btn-success" data-dismiss="modal">Hozzáad</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- New To do List Modal End-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@endsection
@section('scripts')
<script>
    $("#addTaskBtn").click(function() {
        var value = $('#addTask').val();
        $('ul li:last').after("<li><p><input type='checkbox' class="+"flat"+">" + value + "</p></li>");
        $('#addTask').val('');
    });
</script>
@endsection


