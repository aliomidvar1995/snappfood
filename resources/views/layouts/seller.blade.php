<!doctype html>
<html lang="fa-IR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/images/favicon.png">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <link href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css" rel="stylesheet" type="text/css">
    <script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js" type="text/javascript"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('title')
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-secondary shadow-sm">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-5">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        پروفایل
                    </a>
            
                    <div class="dropdown-menu bg-secondary" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-end text-light" href="{{ route('seller.index') }}">
                            {{ __('پروفایل') }}
                        </a>
                        <a class="dropdown-item text-end text-light" href="{{ route('seller.edit') }}">
                            {{ __('ویرایش پروفایل') }}
                        </a>
                        <a class="dropdown-item text-end text-light" href="{{ route('seller.destroy') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('delete-form').submit();">
                            {{ __('حذف حساب کاربری') }}
                        </a>
                        <form id="delete-form" action="{{ route('seller.destroy') }}" method="POST" class="d-none">
                            @csrf
                            @method('delete')
                        </form>
                        <a class="dropdown-item text-end text-light" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('خروج') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main dir="rtl">

        <div id="admin-sidebar" class="flex-shrink-0 p-3 bg-dark">
            <a href="{{ route('seller.index') }}" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                <svg class="bi me-2" width="30" height="24">
                    <use xlink:href="#bootstrap" />
                </svg>
                <span class="fs-5 fw-semibold text-white">پنل فروشنده</span>
            </a>
            <ul class="list-unstyled ps-0">
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed text-white" data-bs-toggle="collapse"
                        data-bs-target="#restaurant-collapse" aria-expanded="false">
                        رستوران
                    </button>
                    <div class="collapse" id="restaurant-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
                            <li><a href="{{ route('seller.restaurants.create') }}" class="link-dark rounded text-white">ایجاد رستوران</a></li>
                            <li><a href="{{ route('seller.restaurants.index') }}" class="link-dark rounded text-white">لیست رستوران ها</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        @yield('content')
    </main>
</body>

</html>
