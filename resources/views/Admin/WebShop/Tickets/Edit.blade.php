@extends('Admin.Layouts.Master')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="row x_title">
    <div class="col text-center">
      <h3>Webshop<br> <small>- Termékek kezelése -</small></h3>
    </div>
  </div>
  <!-- Új termék felvétele FORM -->
    <div class="col-md-12">
        <div class="x_panel tile">
            <div class="x_title">
                <h2>Bérlet módosítása</h2>
                <div class="text-right">
                    <button type="button" class="btn btn-sm btn-danger deleteButton" data-toggle="modal" data-target=".deleteTicket" aria-data="{{ $ticket->id }}" aria-label="{{ $ticket->name }}">Törlés</button>
                </div>
            </div>
            <!-- HIBÁK HELYE-->
            @if ($errors->any() )
                <div class="alert alert-danger">   
                    @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                    @endforeach 
                </div>
            @endif
            <!-- HIBÁK HELYE VÉGE-->
            <div class="d-flex justify-content-center">
                <form   id="productForm" action="{{route("ticketUpdate", $ticket->id)}}" method="POST">
                    @csrf
                    <div class="form-group col-md-6">
                        <br><h5 for="name" class="form-label">Név</h5>
                        <input type="text" class="form-control" id="name" value="{{old() ? old("name") :$ticket->name}}" name="name">
                    </div>
                    <div class=" form-group col-md-6">
                        <br><h5 for="category" class="form-label">Kategória</h5>
                        <select name="category"  id="category"  class="form-control" disabled>
                            <option value="0" selected>Jegyek</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <br><h5 for="description" class="form-label">Leírás</h5>
                        <textarea class="form-control" id="description" name="description">{{old() ? old("description") :$ticket->description}}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <br><h5 for="list_price" class="form-label">Lista ár <small>(Ft)</small></h5>
                        <input type="number" class="form-control" id="list_price" name="list_price" value="{{old() ? old("list_price") :$ticket->list_price}}">
                    </div>
                    <div class="form-group col-md-6">
                        <br><h5 for="discount_price" class="form-label">Akciós ár <small>(Ft)</small></h5>
                        <input type="number" class="form-control" id="discount_price" name="discount_price" value="{{old() ? old("discount_price") :$ticket->discount_price}}">
                    </div>
                    <div class="form-group col-md-12">
                        <br><h5 class="form-label">Online termék?</h5><br>
                        <input type="radio" class="flat" name="onlineProduct" value="1" checked ="checked" >
                        <label for="onlineProduct">Igen, online termék</label><br>
                    </div>
                    <div class="form-group col-md-12 text-left">
                        <br><button class="btn btn-success" type="submit">Jegy módosítása</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Új termék felvétele FORM vége -->
<!-- Termék Delete Modal-->
<div class="modal deleteTicket fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{route("ticketDestroy", $ticket->id)}}" method="POST" id="productForm">
                @csrf
                <input type="hidden" name="productId" id="productId" value="">
                <div class="modal-header">
                    <h4 class="modal-title taskModal" id="myModalLabel2">Jegy törlése</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Biztosan törölni szeretnéd ezt a jegyet?
                    <br>
                    <p class="font-weight-bold" id="productName"></p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Mégse</a>
                    <button type="submit" class="btn btn-danger">Törlés</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Termék Delete Modal End-->
</div>
<!-- /page content -->
@endsection
@section('scripts')
    <script>
    </script>
@endsection