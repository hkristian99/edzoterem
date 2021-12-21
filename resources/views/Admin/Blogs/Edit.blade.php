@extends('Admin.Layouts.Master')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row x_title">
        <div class="col-12" style="text-align: center">
            <h3>Blogbejegyzések </h3>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Szerző: {{$post->user->firstname}} {{$post->user->lastname}} </h2>
                	<a  class="btn btn-secondary" style="float: right" href="{{route("blogDetails", $post->slug)}}">Ugrás a blogra</a>
                @if ($post->post_status_id == 1 && in_array("1",session("userRoles")) )
                  	<a  class="btn btn-success" style="float: right" href="{{route("postApproval", $post->id)}}">Jóváhagyás</a>
                @endif
                <div class="clearfix"></div>
			</div>
            @if ($errors->any() )
                <div class="alert alert-danger">   
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach 
                </div>
            @endif
            <form id="contactForm" action="{{route('blogUpdate', $post->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <span>Cím</span>
                <input type="text" class="form-control" name="title" placeholder="Cím" value="{{ old() ? old("title") : $post->title }}"><br>
                <span>Bevezető</span>
                <textarea  class="form-control" name="lead" placeholder="Bevezető">{{old() ? old("lead") :$post->lead}}</textarea><br>
                <textarea class="form-control" id="summary-ckeditor" name="body">{{ old() ? old("body") :$post->body}}</textarea><br>
                
                <div class="col form-group has-feedback">
                    <label for="avatar">Borító</label>
                    <input type="file" class="form-control-file" id="cover" name="cover"><br>
                    <img src="{{ $post->cover }}" style="max-height:100px;">
                </div>

                <div class="col form-group has-feedback">
                  <label for="avatar">Címkék</label>
                  <div class="tagList">
                      @foreach ($tags as $tag)
                          <input type="checkbox" class="flat" name="tags[]" {{ (old() && in_array($tag->id,old("tags"))) || ( !old() && in_array($tag->id,$post_tags) ) ? "checked" : " " }} value="{{ $tag->id }}"> {{ $tag->name }}
                          <br>
                      @endforeach
                  </div>
                </div>

                <div class="clearfix">
                    
                    <button type="submit" class="btn btn-success" name="publish">Beadás jóváhagyásra</button>
                    @if ($post->post_status_id == 3)
                    <button type="submit" class="btn btn-secondary" name="draft">Piszkozat</a>
                    @endif
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Törlés</button>
                </div>
            </form>     
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $post->title }} törlése</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Biztosan törölni szeretnéd ezt a bejegyzést?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
        <a href="{{ route("blogDestroy", $post->id) }}" class="btn btn-danger">Törlés</a>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
</div>
<!-- page content end-->
@endsection
@section('scripts')
  <!--<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
  <script>CKEDITOR.replace( 'summary-ckeditor' );</script>-->

  <script src="/assets/admin/ckeditor/ckeditor.js?v=1"></script>
  <script>
      CKEDITOR.replace( 'summary-ckeditor', {
          language: 'hu',
          width: '1130px',
          filebrowserBrowseUrl: '/ckfinder/browser',
			    filebrowserUploadUrl: '/ckfinder/connector',
      });
  </script>
@endsection