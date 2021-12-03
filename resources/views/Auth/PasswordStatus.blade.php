@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 leave-comment">
                        <h2 class="text-white">Jelszó módosítása<small> - kötelező - </small></h2><br>
                        @if ($errors->any() )
                            <div class="alert alert-danger">   
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach 
                            </div>
                        @endif
                        <form action="{{route('sendPasswordStatus')}}" method="POST">
                            @csrf
                            <input class="input" name="password" value="" type="password" placeholder="Új jelszó"><br>
                            <input class="input" name="password_confirmation" value="" type="password" placeholder="Új jelszó mégegyszer"><br>
                            <div class="row justify-content-center">
                                <div class="col-lg-5">
                                    <button type="submit" class="primary-btn">Jelszó megváltoztatása</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
    <!-- Contact Section End -->
    @endsection