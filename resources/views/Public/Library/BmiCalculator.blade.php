@extends('Public.Layouts.Master')
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>BMI kalkulátor</h2>
                        <div class="bt-option">
                            <a href="/">Kezdőlap</a>
                            <a href="#">Tudástár</a>
                            <span>BMI kalkulátor</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    
    <!-- BMI Calculator Section Begin -->
    <section class="bmi-calculator-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="section-title chart-title col-12 col-md-6">
                            <span>Mi az a BMI?</span><br><br>
                            <p style="text-align:justify"> A BMI, avagy a Body Mass Index mutatja a testsúlyod és a magasságod arányát. 
                                A BMI kiszámolása alapján megtudhatod, hogy ideális-e az aktuális testsúlyod vagy jobb lenne változtatni rajta. 
                                Keresd meg a táblázatban az életkorod, rendeld hozzá a BMI eredményt, és bekerülsz az 5 súlykategória egyikébe.
                                Amennyiben a BMI szerint pl. soványság vagy túlsúly jön ki, mindenképpen jó, ha megbeszéled a háziorvosoddal. 
                                Ő majd elmagyarázza, hogyan tudsz helyesen lefogyni. 
                            </p>
                        </div>
                        <div class="chart-calculate-form col-12 col-md-6">
                            <div class="section-title chart-title">
                                <span>Számold ki a sajátodat</span>
                            </div>
                            <form>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <input type="number" id="height" name="height" min=100 placeholder="Magasság (cm)">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="number" id="weight" name="weight" min=100 placeholder="Súly (kg)">
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="number"  id="age" name="age" min=0 placeholder="Kor">
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="input form-control bmi" name="sex" id="sex">
                                            <option value="0">Férfi</option>    
                                            <option value="1">Nő</option>    
                                        <select>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="button" id="calculate">Számítás</button>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <h2  id="result" style="color:#fff; text-align:center;"></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="section-title chart-title">
                        <h2>BMI Táblázat</h2>
                    </div>
                    <div class="chart-table">
                        <table id = "BMI_woman_table" class="table-md-responsive d-none">
                            <thead>
                                <tr class="text-center">
                                    <th>Életkor</th>
                                    <th>Soványság</th>
                                    <th>Ideális</th>
                                    <th>Túlsúly</th>
                                    <th>Elhízás</th>
                                    <th>Súlyos elhízás</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="Woman_age_24" class="woman_age">
                                    <td>18 - 24</td>
                                    <td>< 19</td>
                                    <td>19 - 24</td>
                                    <td>24 - 29</td>
                                    <td>29 - 39</td>
                                    <td>> 39</td>
                                </tr>
                                <tr id="Woman_age_25_34" class="woman_age">
                                    <td>25-34</td>
                                    <td>< 20</td>
                                    <td>20 - 25</td>
                                    <td>25 - 30</td>
                                    <td>30 - 40</td>
                                    <td>> 40</td>
                                </tr>
                                <tr id="Woman_age_35_44" class="woman_age">
                                    <td>35-44</td>
                                    <td>< 21</td>
                                    <td>21 - 26</td>
                                    <td>26 - 31</td>
                                    <td>31 - 41</td>
                                    <td>> 41</td>
                                </tr>
                                <tr id="Woman_age_45_54" class="woman_age">
                                    <td>45-54</td>
                                    <td>< 22</td>
                                    <td>22 - 27</td>
                                    <td>27 - 32</td>
                                    <td>32 - 42</td>
                                    <td>> 42</td>
                                </tr>
                                <tr id="Woman_age_55_64" class="woman_age"> 
                                    <td>54-64</td>
                                    <td>< 23</td>
                                    <td>23 - 28</td>
                                    <td>28 - 33</td>
                                    <td>33 - 43</td>
                                    <td>> 43</td>
                                </tr>
                                <tr id="Woman_age_65" class="woman_age">
                                    <td>65+</td>
                                    <td>< 24</td>
                                    <td>24 - 29</td>
                                    <td>29 - 34</td>
                                    <td>34 - 44</td>
                                    <td>> 44</td>
                                </tr>
                            </tbody>
                        </table>

                        <table id = "BMI_man_table" class="table-md-responsive">
                            <thead>
                                <tr class="text-center">
                                    <th>Életkor</th>
                                    <th>Soványság</th>
                                    <th>Ideális</th>
                                    <th>Túlsúly</th>
                                    <th>Elhízás</th>
                                    <th>Súlyos elhízás</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="man_age_24" class="man_age">
                                    <td>18 - 24</td>
                                    <td>< 20</td>
                                    <td>20 - 25</td>
                                    <td>25 - 30</td>
                                    <td>30 - 40</td>
                                    <td>> 40</td>
                                </tr>
                                <tr id="man_age_25_34" class="man_age">
                                    <td>25-34</td>
                                    <td>< 21</td>
                                    <td>21 - 26</td>
                                    <td>26 - 31</td>
                                    <td>31 - 41</td>
                                    <td>> 41</td>
                                </tr>
                                <tr id="man_age_35_44" class="man_age">
                                    <td>35-44</td>
                                    <td>< 22</td>
                                    <td>22 - 27</td>
                                    <td>27 - 32</td>
                                    <td>32 - 42</td>
                                    <td>> 42</td>
                                </tr>
                                <tr id="man_age_45_54" class="man_age">
                                    <td>45-54</td>
                                    <td>< 23</td>
                                    <td>23 - 28</td>
                                    <td>28 - 33</td>
                                    <td>33 - 43</td>
                                    <td>> 43</td>
                                </tr>
                                <tr id="man_age_55_64" class="man_age">
                                    <td>54-64</td>
                                    <td>< 24</td>
                                    <td>24 - 29</td>
                                    <td>29 - 34</td>
                                    <td>34 - 44</td>
                                    <td>> 44</td>
                                </tr>
                                <tr id="man_age_65" class="man_age">
                                    <td>65+</td>
                                    <td>< 25</td>
                                    <td>25 - 30</td>
                                    <td>30 - 35</td>
                                    <td>35 - 45</td>
                                    <td>> 45</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BMI Calculator Section End -->
@endsection
@section('scripts')
    <script>

        $("#sex").on("change", function() {
            let sex = $(this).val();
            if(sex == 1){
                $("#BMI_man_table").addClass("d-none");
                $("#BMI_woman_table").removeClass("d-none");
            }
            else{
                $("#BMI_man_table").removeClass("d-none");
                $("#BMI_woman_table").addClass("d-none");
            }
        });

        $("#calculate").on("click", function() {
            let eredmeny = 0;
            let height = parseInt( $("#height").val() );
            let weight = parseInt( $("#weight").val() );
            let age = parseInt( $("#age").val() );
            let sex = parseInt( $("#sex").val() );
            
            
            if(Number.isNaN(height) || Number.isNaN(weight) || Number.isNaN(age) || height == 0 || weight == 0 || age == 0){
                $("#result").html("Töltsd ki valós értékekkel!");
            }
            else{
                height = height / 100;
                let tmp = weight / (height * height);
                eredmeny = tmp.toFixed(1);
                $("#result").html("= " + eredmeny);
            }

            if( age < 24 ){
                $(".woman_age").removeClass("calculated");
                $("#Woman_age_24").addClass("calculated");

                $(".man_age").removeClass("calculated");
                $("#man_age_24").addClass("calculated");
            }
            if( age >= 25 && age < 34 ){
                $(".woman_age").removeClass("calculated");
                $("#Woman_age_25_34").addClass("calculated");

                $(".man_age").removeClass("calculated");
                $("#man_age_25_34").addClass("calculated");
            }
            if( age >= 35 && age < 44 ){
                $(".woman_age").removeClass("calculated");
                $("#Woman_age_35_44").addClass("calculated");
                
                $(".man_age").removeClass("calculated");
                $("#man_age_35_44").addClass("calculated");
            }
            if( age >= 45 && age < 54 ){
                $(".woman_age").removeClass("calculated");
                $("#Woman_age_45_54").addClass("calculated");
                
                $(".man_age").removeClass("calculated");
                $("#man_age_45_54").addClass("calculated");
            }
            if( age >= 55 && age < 64 ){
                $(".woman_age").removeClass("calculated");
                $("#Woman_age_55_64").addClass("calculated");
                
                $(".man_age").removeClass("calculated");
                $("#man_age_55_64").addClass("calculated");
            }
            if( age >= 65 ){
                $(".woman_age").removeClass("calculated");
                $("#Woman_age_65").addClass("calculated");
                
                $(".man_age").removeClass("calculated");
                $("#man_age_65").addClass("calculated");
            }
        });
    </script>
@endsection