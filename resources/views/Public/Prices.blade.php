@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Áraink</h2>
                        <div class="bt-option">
                            <a href="{{route("home")}}">Kezdőlap</a>
                            <span>Áraink</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Pricing Section Begin -->
    <section class="pricing-section service-pricing spad" id="berletek" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Bérletek és napijegyek</span>
                        <h2>Válassz az elérhetők közül</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3>Napijegy</h3>
                        <div class="pi-price">
                            <h2>1 490 Ft</h2>
                            <span>EGYSZERI BELÉPÉSRE ALKALMAS</span>
                        </div>
                        <ul>
                            <li>Free riding</li>
                            <li>Unlimited equipments</li>
                            <li>Personal trainer</li>
                            <li>Weight losing classes</li>
                            <li>Month to mouth</li>
                            <li>No time restriction</li>
                        </ul>
                        <a href="#" class="primary-btn pricing-btn">Megveszem</a>
                        <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3>Havi bérlet</h3>
                        <div class="pi-price">
                            <h2>15 990 Ft</h2>
                            <span>30 napos</span>
                        </div>
                        <ul>
                            <li>Free riding</li>
                            <li>Unlimited equipments</li>
                            <li>Personal trainer</li>
                            <li>Weight losing classes</li>
                            <li>Month to mouth</li>
                            <li>No time restriction</li>
                        </ul>
                        <a href="#" class="primary-btn pricing-btn">Megveszem</a>
                        <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3>10 alkamas bérlet</h3>
                        <div class="pi-price">
                            <h2>9 990 Ft</h2>
                            <span>NAPONTA EGYSZERI BELÉPÉSRE ALKALMA</span>
                        </div>
                        <ul>
                            <li>Free riding</li>
                            <li>Unlimited equipments</li>
                            <li>Personal trainer</li>
                            <li>Weight losing classes</li>
                            <li>Month to mouth</li>
                            <li>No time restriction</li>
                        </ul>
                        <a href="#" class="primary-btn pricing-btn">Megveszem</a>
                        <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3>Diák havi bérlet</h3>
                        <div class="pi-price">
                            <h2>9 990 Ft</h2>
                            <span>érvényes diákigazolvány megléte feltétel </span>
                        </div>
                        <ul>
                            <li>Free riding</li>
                            <li>Unlimited equipments</li>
                            <li>Personal trainer</li>
                            <li>Weight losing classes</li>
                            <li>Month to mouth</li>
                            <li>No time restriction</li>
                        </ul>
                        <a href="#" class="primary-btn pricing-btn">Megveszem</a>
                        <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3>Havi bérlet LIGHT</h3>
                        <div class="pi-price">
                            <h2>9 990 Ft</h2>
                            <span>Csúcsidőn kívüli belépésre alkalmas 30 napos bérlet</span>
                        </div>
                        <ul>
                            <li>Free riding</li>
                            <li>Unlimited equipments</li>
                            <li>Personal trainer</li>
                            <li>Weight losing classes</li>
                            <li>Month to mouth</li>
                            <li>No time restriction</li>
                        </ul>
                        <a href="#" class="primary-btn pricing-btn">Megveszem</a>
                        <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pricing-section service-pricing spad" id="webshop">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Web Shop</span>
                        <h2>Legnépszerűbb termékeink</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3>BioTech Multi-Vitamin 30</h3>
                        <div class="pi-price">
                            <h2>4 490 Ft</h2>
                            <span>Táplálék-kiegészíők</span>
                        </div>
                        <ul>
                            <li>30 db kapszula</li>
                            <li>Unlimited equipments</li>
                            <li>Personal trainer</li>
                            <li>Weight losing classes</li>
                            <li>Month to mouth</li>
                            <li>No time restriction</li>
                        </ul>
                        <a href="#" class="primary-btn pricing-btn">Megveszem</a>
                        <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3>Kesztyű </h3>
                        <div class="pi-price">
                            <h2>5 990 Ft</h2>
                            <span>Felszerelés</span>
                        </div>
                        <ul>
                            <li>Több méret</li>
                            <li>Unisex</li>
                            <li>Personal trainer</li>
                            <li>Weight losing classes</li>
                            <li>Month to mouth</li>
                            <li>No time restriction</li>
                        </ul>
                        <a href="#" class="primary-btn pricing-btn">Megveszem</a>
                        <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3>10 alkamas bérlet</h3>
                        <div class="pi-price">
                            <h2>9 990 Ft</h2>
                            <span>NAPONTA EGYSZERI BELÉPÉSRE ALKALMA</span>
                        </div>
                        <ul>
                            <li>Free riding</li>
                            <li>Unlimited equipments</li>
                            <li>Personal trainer</li>
                            <li>Weight losing classes</li>
                            <li>Month to mouth</li>
                            <li>No time restriction</li>
                        </ul>
                        <a href="#" class="primary-btn pricing-btn">Megveszem</a>
                        <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3>Diák havi bérlet</h3>
                        <div class="pi-price">
                            <h2>9 990 Ft</h2>
                            <span>érvényes diákigazolvány megléte feltétel </span>
                        </div>
                        <ul>
                            <li>Free riding</li>
                            <li>Unlimited equipments</li>
                            <li>Personal trainer</li>
                            <li>Weight losing classes</li>
                            <li>Month to mouth</li>
                            <li>No time restriction</li>
                        </ul>
                        <a href="#" class="primary-btn pricing-btn">Megveszem</a>
                        <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3>Havi bérlet LIGHT</h3>
                        <div class="pi-price">
                            <h2>9 990 Ft</h2>
                            <span>Csúcsidőn kívüli belépésre alkalmas 30 napos bérlet</span>
                        </div>
                        <ul>
                            <li>Free riding</li>
                            <li>Unlimited equipments</li>
                            <li>Personal trainer</li>
                            <li>Weight losing classes</li>
                            <li>Month to mouth</li>
                            <li>No time restriction</li>
                        </ul>
                        <a href="#" class="primary-btn pricing-btn">Megveszem</a>
                        <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Pricing Section End -->
@endsection