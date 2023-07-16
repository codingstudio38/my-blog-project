<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="{{ route('indexpage') }}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="{{ url('/') }}/assets/img/logo.png" alt=""> -->
        <h1>Blog</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{ route('all-blog') }}">Show All Blogs</a></li>
          {{-- <li><a href="single-post.html">Single Post</a></li>
          <li class="dropdown"><a href="category.html"><span>Categories</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="search-result.html">Search Result</a></li>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul> --}}
          </li>
@if(session()->has('user_data'))
  <li><a href="{{ route('user-home') }}">My Dashboard</a></li>
  @else
  <li><a href="{{ route('login') }}">Login</a></li>
@endif
          

        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative">
        <a href="https://www.facebook.com/" target="_blank" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="https://twitter.com/" target="_blank" class="mx-2"><span class="bi-twitter"></span></a>
        <a href="https://www.instagram.com/" target="_blank" class="mx-2"><span class="bi-instagram"></span></a>

        <a href="javascript:void(0)" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.html" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->