<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>Általános</h3>
      <ul class="nav side-menu">
        <li><a><i class="fa fa-user"></i> Személyes <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route("profile")}}">Profilom</a></li>
            <li><a href="{{route("calendar")}}">Naptár</a></li>
            <li><a href="{{route("daily")}}">Napi teendők</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-shopping-cart"></i>WebShop<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a>Termékek kezelése<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li class="sub_menu"><a href="{{route("productCreate")}}">Új termék hozzáadása</a>
                  </li>
                  <li><a href="{{route("products")}}">Termékek listája</a>
                  </li>
                  <li><a href="{{route("productDiscont")}}">Kedvezmények kezelése</a>
                  </li>
                </ul>
              </li>
            <li><a href="{{route("productIdeas")}}">Ötletláda</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-bicycle"></i>Edzés<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route("workoutPlans")}}">Edzéstervek</a></li>
            <li><a href="{{route("workoutDiet")}}">Étrendek</a></li>
            <li><a href="{{route("workoutNotes")}}">Jegyzetfüzet</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-newspaper-o"></i>Blog<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route("blogCreate")}}">Új bejegyzés</a></li>
            <li><a href="{{route("blogByUser")}}">Bejegyzéseim</a></li>
            <li><a href="{{route("blogAll")}}">Összes bejegyzés</a></li>
          </ul>
        </li>
      </ul>
    </div>
    
    <div class="menu_section">
      <h3>Adminisztráció</h3>
      <ul class="nav side-menu">
        <li><a><i class="fa fa-users"></i>Felhasználó kezelés<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route("adminUserCreate")}}">Új felhasználó</a></li>
            <li><a href="{{route("adminUsers")}}">Felhasználók listája</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="menu_section">
      <h3>Pénzügyek és Statisztika</h3>
      <ul class="nav side-menu">
        <li><a><i class="fa fa-user"></i> Számlák kezelése <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="#">Új felhasználó</a></li>
            <li><a href="#">Felhasználók listája</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-newspaper-o"></i> Riporting <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="#">Havi kimuatások</a></li>
            <li><a href="#">Kimutatás készítő</a></li>
            <li><a href="#">Excel export</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-sitemap"></i>NAV<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
              <li><a href="##level1_1">ÁFA lista</a>
              <li><a>ÁFA analitika</a></li>
              <li><a href="#">Forgalom</a></li>
              <li><a href="#">Főkönyvi adatexport</a></li>
              <li><a href="#">NAV pénztárgép feladás</a></li>
              <li><a href="#">Adóhatósági ellenőrzés</a></li>
              <li><a href="#">Beszámolók</a></li>
              <li><a href="#">Számlák</a></li>
          </ul>
        </li>  
      </ul>
    </div>
  </div>