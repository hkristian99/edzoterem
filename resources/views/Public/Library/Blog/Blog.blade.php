@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/about-us.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Cikkeink</h2>
                        <div class="bt-option">
                            <a href="/">Kezdőlap</a>
                            <a href="#">Tudástár</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog-section spad text-center">
        <div class="container">
            <div class="row">
                <div class="col-12 p-0">
                    {!! $posts->links("/vendor/pagination/gym") !!}
                    <br><br>
                        @foreach ($posts as $post)
                                <div class="blog-item">
                                    <div class="row" style="width: 1000px; height: 250px; margin:auto; ">
                                        <div class="bi-pic col-12 col-md-3 p-0">
                                            <img src="{{$post->cover}}" alt="" class="img-fluid" style="width: 100%; height: 250px;">
                                        </div>
                                        <div class="bi-text col-12 col-md-9">
                                            <h5><a href="{{ route("blogDetails", $post->slug) }}">{{$post->title}}</a></h5>
                                            <ul>
                                                <li>Szerző: <a href="{{ route("blogBy", $post->user_id) }}" > {{$post->user->firstname}} {{$post->user->lastname}}</a></li>
                                                <li>{{ \Date::parse($post->created_at)->format("Y. F j.") }}</li>
                                                <li>
                                                    <div class="tags">
                                                        @foreach ($post->getTagsByPostId($post->id) as $tag)
                                                            <a href="{{ route("blogByTag", $tag->getTag->slug) }}">{{$tag->getTag->name}}</a>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                            <p>{{$post->lead}}</p>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    {!! $posts->links("/vendor/pagination/gym") !!}
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection