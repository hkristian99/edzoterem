@extends('Admin.Layouts.Master')
@section('custom1')
    <!-- FullCalendar -->
    <link href="/assets/admin/vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="/assets/admin/vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Naptár</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Mit keressünk?">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Keresés</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div id='calendar'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- calendar modal -->
    <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Új esemény rögzítése</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div id="testmodal" style="padding: 5px 20px;">
                        <form id="antoform" class="form-horizontal calender" role="form">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Cím</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Leírás</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Mégse</button>
                    <button type="button" class="btn btn-primary antosubmit">Esemény felvétele</button>
                </div>
            </div>
        </div>
        <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew">
        </div>
        <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit">
        </div>
    </div>
    <!-- /calendar modal -->

</div>
<!-- /page content -->

@endsection
@section('custom2')
    <!-- FullCalendar -->
    <script src="/assets/admin/vendors/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src='/assets/admin/vendors/fullcalendar/dist/lang/hu.js'></script>
@endsection
