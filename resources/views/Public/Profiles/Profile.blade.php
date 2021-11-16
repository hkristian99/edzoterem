@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                      <h2>Adataim</h2>
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
            
            <div class="leave-comment">
                <div class="col text-right" style="padding:0px;"id="modify-button-div">
                    <button type="button" id="modify-button" class="primary-btn modify-btn">Módosítás</button>
                </div>
              <form  name="profile" id="profile-form" action="#" method="POST">
                @csrf
                <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="text-white">Vezetéknév:</label>
                  <input class="input" id="firstname" name="name" value="{{Auth::user()->name}}" type="text" disabled>
                </div>
                <div class="form-group col-md-6">
                  <label class="text-white">Keresztnév:</label>
                  <input class="input" name="name" value="{{Auth::user()->name}}" type="text" disabled>
                </div>
                <div class="form-group col-md-6">
                <label class="text-white">Igazolványaim:</label>
                <input class="input" name="name" value="764088829" type="text" disabled>
                </div>
                <div class="form-group col-md-6">
                <label class="text-white">E-mail:</label>
                <input class="input" name="email" value="{{Auth::user()->email}}" type="email" disabled>
                </div>
              </div>
                <div class="row">
                    <div class="col text-center d-none" id="save-button-div">
                        <button type="submit" class="primary-btn modify-btn">Módosítások mentése</button>
                    </div>
                </div>
              
            </form>
            </div>
          </div>
      </div>
    </section>
    <!-- Contact Section End -->
    @endsection

    @section("scripts")
    <script>
        $("#modify-button").on("click", function() {
            $("#profile-form").find("input").each(function() {
                $(this).attr("disabled", false);
            });
            $("#firstname").focus();
            $("#save-button-div").removeClass("d-none");
            $("#modify-button-div").addClass("d-none");
        });
    </script>
    @endsection