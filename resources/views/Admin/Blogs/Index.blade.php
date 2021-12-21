@extends('Admin.Layouts.Master')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row x_title">
        <div class="col-12" style="text-align: center">
            <h3>Blogbejegyzések </h3>
        </div>
    </div>
<div class="col-md-12 col-sm-12  ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Saját bejegyzéseim</h2>
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
                        <tr class=" trT text-center">
                            <th class="column-title">Cím</th>
                            <th class="column-title">Közzététel időpontja </th>
                            <th class="column-title">Utolsó módosítás </th>
                            <th class="column-title">Olvasottság</th>
                            <th class="column-title">Státusz</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="sor text-left" style="cursor:pointer;" onClick="document.location.href='{{ route("blogEdit", $post->id) }}';">
                                <td>{{$post->title}}</td>
                                <td>{{$post->created_at}}</td>
                                <td>{{$post->updated_at}}</td>
                                <td>{{$post->counter}}</td>
                                <td>{{$post->status->name}}</td>
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
<!-- page content end-->
@endsection