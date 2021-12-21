@extends('Public.Layouts.Master')
@section('content')
    <!-- Blog Details Hero Section Begin -->
    <section class="blog-details-hero set-bg" data-setbg="{{$post->cover}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 p-0 m-auto">
                    <div class="bh-text">
                        <h3>{{$post->title}}</h3>
                        <ul>
                            <li>Szerző: <a href="#"> {{$post->user->firstname}} {{$post->user->lastname}} </a></li>
                            <li>{{ \Date::parse($post->created_at)->format("Y. F j.") }}</li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero Section End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-0 m-auto">
                    <div class="blog-details-text">
                        <div class="blog-details-lead">
                            <p>{!!$post->lead!!}</p>
                        </div>
                        <br>
                        <div class="blog-details-title">
                            <p>{!!$post->body!!}</p>
                        </div>
                        <div class="blog-details-tag-share">
                            <div class="tags">
                                <h5 style="color:#fff;">Címkék </h5><br>
                                @foreach ($post_tags as $post_tag)
                                    <a href="{{ route("blogByTag", $post_tag->getTag->slug) }}">{{$post_tag->getTag->name}}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="blog-details-author">
                            <div class="ba-pic">
                                <img src="/images/profile/{{$post->user->avatar}}">
                            </div>
                            <div class="ba-text">
                                <h5>{{$post->user->firstname}} {{$post->user->lastname}}</h5>
                                <div class="ba-text">
                                    <p style="text-align: center">Olvasd el az író többi cikkét is</p>
                                    <ul>
                                        @foreach ($postsByUser as $postByUser)
                                        <li style="list-style-type: none;"><a href="{{route("blogDetails",$postByUser->slug)}}">{{$postByUser->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <br>
                                <div class="bp-social">
                                    @if ($post->user->facebook !=null)
                                        <a href="{{$post->user->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a>
                                    @endif
                                    @if ($post->user->twitter !=null)
                                        <a href="{{$post->user->twitter}}" target="_blank" ><i class="fa fa-twitter"></i></a>
                                    @endif
                                    @if ($post->user->instagram !=null)
                                        <a href="{{$post->user->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a>
                                    @endif
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
    @endsection