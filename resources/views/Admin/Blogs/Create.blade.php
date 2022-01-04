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
            <h2>Új blogbejegyzés<small></small></h2>
            <div class="clearfix"></div>
        </div>
        @if ($errors->any() )
            <div class="alert alert-danger">   
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach 
            </div>
        @endif
          <form id="contactForm" action="{{route('blogStore')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" class="form-control" name="title" value="{{ old("title") }}" placeholder="Cím"><br>
            
            <textarea type="text" class="form-control" name="lead" placeholder="Bevezető">{{old("lead")}}</textarea><br>
            
            <textarea class="form-control" id="summary-ckeditor" name="body">{{ old("body") }}</textarea><br>
            
            <div class="col form-group has-feedback">
              <label for="avatar">Borító</label>
              <input type="file" class="form-control-file" id="cover" name="cover">
            </div>

            <div class="col form-group has-feedback">
              <label for="avatar">Címkék</label>
              <div class="tagList">
                  @foreach ($tags as $tag)
                      <input type="checkbox" class="flat" name="tags[]" value="{{ $tag->id }}" {{ old() && in_array($tag->id,old("tags")) ? "checked" : "" }}> {{ $tag->name }}
                      <br>
                  @endforeach
              </div>
            </div>

            <div class="clearfix">
                <button type="submit" class="btn btn-success" name="publish">Beadás jóváhagyásra</button>
                <button type="submit" class="btn btn-secondary" name="draft">Piszkozat</a>
            </div>
          </form>
    </div>
</div>
<div class="clearfix"></div>
</div>
<!-- page content end-->
@endsection
@section('scripts')
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>CKEDITOR.replace( 'summary-ckeditor' );</script>
@endsection