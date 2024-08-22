<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="{{asset("css/common.css
      ")}}">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
      <title>管理画面</title>
</head>
<body>
      <div class="bg hidden"></div>
      <main>
          <!-- nav -->
          <nav>
            <div class="nav__top">
                  <div class="nav__ttl">
                        <p>管理画面</p>
                  </div>
                  @if (Route::currentRouteName() !== "device")
                        <div class="nav__item-option">
                              <a href="{{ route("device")}}"><p>ホーム</p></a>
                        </div>

                  @endif
                   
            </div>
            <div class="nav__bottom">
                  <div class="nav__item-option">
                        <form action="{{route("logout")}}" method="post">
                              @csrf
                              <button type="submit" class="logout_btn">ログアウト</button>
                        </form>
                  </div>  
            </div>
            
        </nav>
        @yield('main')
            
      </main>
@yield('script')
  </body>
</html>