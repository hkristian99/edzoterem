@extends('Admin.Layouts.Master')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row x_title">
        <div class="col-12" style="text-align: center">
            <h3>Webshop<br> <small>- Rendelések kezelése -</small></h3>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Rendelés részletei</h2>
                <a  class="btn btn-secondary" style="float: right" href="">Lemondva</a>
                <a  class="btn btn-danger" style="float: right" href="">Törlés</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-12">
                        <table id="cart" class="table cartTable">
                            <tbody>
                                <tr class="text-center caption">
                                    <th colspan="2"style="width:35%">Terméklista</th>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <ul class="products">
                                            @foreach($order_items as $order_item)
                                            <li>
                                                <div class="row">
                                                    <div class="col-sm-3 hidden-xs">
                                                        <img src="{{ $order_item->getFirstImage($order_item->product_id) }}" width="50" height="50" class="img-responsive productImageCart"/>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {{ $order_item->getProductName($order_item->product_id) }}
                                                        <div class="productData">
                                                            <p >{{ number_format($order_item->price, 0, ',', ' ' ) }} Ft
                                                            x {{ $order_item->quantity }} = {{ number_format( $order_item->amount, 0, ',', ' ' ) }} Ft
                                                            </p> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr class="text-center caption" >
                                    <th colspan="2"> <h4>Összesen: {{ number_format($order->grandtotal, 0, ',', ' ' ) }} Ft</h4></th>
                                </tr>
                                <tr class="text-center caption">
                                    <th style="width:32.5%">Szállítási adatok:</th>
                                    <th style="width:32.5%">Számlázási adatok:</th>
                                </tr>
                                <tr>
                                    <td>
                                        <ul class="shippingDATA products">
                                            <li> Név: 
                                                <p>{{$shippingData["name"]}}</p>
                                            </li>
                                            <li> Cím: 
                                                <p>{{$shippingData["postcode"]}} {{$shippingData["city"]}}, {{$shippingData["street"]}}</p>
                                            <li> Telefonszám: 
                                                <p>{{$shippingData["phone"]}} </p>
                                            </li>
                                            @if ($shippingData["note"] )
                                            <li> Megjegyzés: 
                                                <p>{{$shippingData["note"]}}</p> 
                                            </li>
                                            @endif
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="billingDATA products">
                                            @if ($shippingData["tax_number"] != null)
                                                <li> Számlatípus: 
                                                    <p>Cég</p>
                                                </li>
                                                <li> Adószám: {{$shippingData["tax_number"]}}</li>
                                            @else
                                                <li> Számlatípus: 
                                                    <p>Magánszemély</p>
                                                </li>
                                            @endif
                                            <li> Név: 
                                                <p>{{$billingData["name"]}}</p>
                                            </li>
                                            <li> Cím: 
                                                <p>{{$shippingData["country_id"]}}</p>
                                                <p>{{$shippingData["postcode"]}} {{$shippingData["city"]}}, {{$shippingData["street"]}}</p>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p>PDF:</p>
                    </div>
                </div>
			</div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $order->id }} törlése</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Biztosan törölni szeretnéd ezt a rendelést?
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
</div>
<!-- page content end-->
@endsection
@section('scripts')
  <script>
  </script>
@endsection