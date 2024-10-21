<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Attendance Management</title>
    <!-- 外部 CSS -->
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  

  @yield('css')
  <script src="{{ asset('js/shop.js') }}" defer></script>
</head>

<body>
  <header class="header">
    <div class="header-utilities">
      <button class="hamburger" id="hamburger">
        <span class="hamburger__line"></span>
        <span class="hamburger__line"></span>
        <span class="hamburger__line"></span>
      </button>
      <h1 class="header-title">Rese</h1>
      <nav class="header-nav" id="nav">
        <ul>
          @if (Auth::check())
          <li class="header-nav__item">
            <a class="header-nav__link" href="/">Home</a>
          </li>
          <li class="header-nav__item">
            <a href="/logout" class="header-nav__link"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
            </a>
            <li class="header-nav__item">
            <a class="header-nav__link" href="/mypage">Mypage</a>
          </li>
            <form id="logout-form" action="/logout" method="post" style="display: none;">
              @csrf
            </form>
          </li>
          @else
          <li class="header-nav__item">
            <a class="header-nav__link" href="/">Home</a>
          </li>
          <li class="header-nav__item">
            <a class="header-nav__link" href="/register">Registration</a>
          </li>
          <li class="header-nav__item">
            <a class="header-nav__link" href="/login">Login</a>
          </li>
          @endif
        </ul>
      </nav>
    </div>
  </header>
  <main>
    @yield('content')
  </main>

</body>

</html>
