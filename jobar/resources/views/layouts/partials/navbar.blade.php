<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2 text-secondary">首頁</a></li>
        @auth
        <li><a href="/" class="nav-link px-2 text-white">加入的團購</a></li>
        <li><a href="/group/own" class="nav-link px-2 text-white">我開設的團購</a></li>
        <li><a href="/group/search" class="nav-link px-2 text-white">尋找團購</a></li>
        @endauth
        <!-- <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li> -->
        <!-- <li><a href="#" class="nav-link px-2 text-white">About</a></li> -->
      </ul>

      <a href="/group/edit" class="btn btn-secondary btn-sm btn-icon icon-left">新增團購訂單</a>

      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
      </form>

      @auth
        {{auth()->user()->name}}
        <div class="text-end">
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
        </div>
      @endauth

      @guest
        <div class="text-end">
          <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
          <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
        </div>
      @endguest
    </div>
  </div>
</header>