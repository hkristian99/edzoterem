@extends('Admin.Layouts.Master')
@section('content')
        <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <br><br>
                <div class="page-title">
                    <div class="text-center">
                        <h3>Blogbejegyzések</h3>
                        <br><br>
                    </div>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="x_content">
                            <!--Jóváhagyásra váró bejegyzések táblázat-->
                            @if ( $approvePostNumber > 0 )
                            @if( Session::has('success') )
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            <div class="col-md-12 col-sm-12 ">
                                <div class="x_panel approvePost">
                                    <div class="x_title">
                                        <h2>Jóváhagyásra váró blog bejegyzések</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="card-box table-responsive">
                                            <table class=" Post_table table table-striped">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>Cím</th>
                                                    <th>Közzététel időpontja</th>
                                                    <th>Utóljára módosítva</th>
                                                    <th>Szerző</th>
                                                    <th>Státusz </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($posts as $post)
                                                        @if ( $post->post_status_id == 1 )
                                                        <tr class="text-center" style="cursor:pointer;" onClick="document.location.href='{{ route("blogEdit", $post->id) }}';">
                                                            <td>{{$post->title}}</td>
                                                            <td>{{$post->created_at}}</td>
                                                            <td>{{$post->updated_at}} </td>
                                                            <td>{{$post->user->firstname}} {{$post->user->lastname}}</td>
                                                            <td>{{$post->status->name}}</td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!--Jóváhagyásra váró bejegyzések táblázat vége-->

                            <!--Összes bejegyzés táblázat-->
                            <div class="col-md-12 col-sm-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                    <h2>Összes blog bejegyzés</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="card-box table-responsive">
                                        <table class="Post_table table table-striped">
                                            <thead>
                                            <tr class="text-center">
                                                <th>Cím</th>
                                                <th>Közzététel időpontja</th>
                                                <th>Utolsó módosítás</th>
                                                <th>Szerző</th>
                                                <th>Státusz</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($posts as $post)
                                            <tr class="text-center" style="cursor:pointer;" onClick="document.location.href='{{ route("blogEdit", $post->id) }}';">
                                                <td>{{$post->title}}</td>
                                                <td>{{$post->created_at}} </td>
                                                <td>{{$post->updated_at}} </td>
                                                <td>{{$post->user->firstname}} {{$post->user->lastname}}</td>
                                                <td>{{$post->status->name}}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>        
                                </div>
                            </div>
                            <!--Összes bejegyzés táblázat vége-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- page content end-->
    </div>
</div>
@endsection
@section('scripts')
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('.Post_table').DataTable({
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
    </script>
@endsection