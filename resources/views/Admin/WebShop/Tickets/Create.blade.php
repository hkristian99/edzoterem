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
                <br><h5>Új bérlet felvétele</h5>
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
                <form   id="productForm" action="{{route("ticketStore")}}" method="POST">
                    @csrf
                    <div class="form-group col-md-6">
                        <br><h5 for="name" class="form-label">Név</h5>
                        <input type="text" class="form-control" id="name" value="{{old("name")}}" name="name">
                    </div>
                    <div class=" form-group col-md-6">
                        <br><h5 for="category" class="form-label">Kategória</h5>
                        <select name="category"  id="category"  class="form-control" disabled>
                            <option value="0" selected>Jegyek</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <br><h5 for="description" class="form-label">Leírás</h5>
                        <textarea class="form-control" id="description" name="description">{{old("description")}}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <br><h5 for="list_price" class="form-label">Lista ár <small>(Ft)</small></h5>
                        <input type="number" class="form-control" id="list_price" name="list_price" value="{{old("list_price")}}">
                    </div>
                    <div class="form-group col-md-6">
                        <br><h5 for="discount_price" class="form-label">Akciós ár <small>(Ft)</small></h5>
                        <input type="number" class="form-control" id="discount_price" name="discount_price" value="{{old("discount_price")}}">
                    </div>
                    <div class="form-group col-md-12">
                        <br><h5 class="form-label">Online termék?</h5><br>
                        
                        <input type="radio" class="flat" name="onlineProduct" value="1" checked ="checked" >
                        <label for="onlineProduct">Igen, online termék</label><br>
                    </div>
                    <div class="form-group col-md-12 text-left">
                        <br><button class="btn btn-success" type="submit">Termék felvétele</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Új termék felvétele FORM vége -->
</div>
<!-- /page content -->
@endsection
@section('scripts')
    <script>
       $(document).ready(function() {
            const manufacturerOldValue = '{{ old('manufacturer') }}';
            const categoryOldValue = '{{ old('category') }}';
    
            if(manufacturerOldValue !== '') {
                $('#manufacturer').val(manufacturerOldValue).change();
            }
            if(categoryOldValue !== '') {
                $('#category').val(categoryOldValue).change();
            }
        });
    </script>
@endsection