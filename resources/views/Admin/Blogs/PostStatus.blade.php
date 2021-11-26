@extends('Admin.Layouts.Master')
@section('content')
<!-- page content -->
<div class="row x_title">
  <div class="col-12" style="text-align: center">
    <h3>Blogbejegyzések </h3>
  </div>
</div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Jóváhagyásra váró bejegyzések ({{$postStatusCount}})<small></small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="table-responsive">
      @if( Session::has('success') )
        <div class="alert alert-success">
          {{ Session::get('success') }}
        </div>
      @endif
      {{$posts->links("vendor.pagination.bootstrap-4")}}
          <table class="table jambo_table bulk_action">
            <thead class="thead-dark">
              <tr class=" trT text-center">
                <th class="column-title">Cím</th>
                <th class="column-title">Szerző</th>
                <th class="column-title">Közzététel időpontja </th>
                <th class="column-title">Státusz </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
              <tr class="sor text-left" style="cursor:pointer;" onClick="document.location.href='{{ route("blogEdit", $post->id) }}';">
                <td>{{$post->title}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->created_at}} </td>
                <td>{{$post->status->name}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{$posts->links("vendor.pagination.bootstrap-4")}}
        </div>        
      </div>
    </div>
  </div>
<div class="clearfix"></div>
<!-- page content end-->
@endsection