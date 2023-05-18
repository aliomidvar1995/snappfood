<!doctype html>
<html lang="fa-IR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/images/favicon.png">
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
                        <a class="dropdown-item text-end text-light" href="{{ route('admin.index') }}">
                            {{ __('پروفایل') }}
                        </a>
                        <a class="dropdown-item text-end text-light" href="{{ route('admin.edit') }}">
                            {{ __('ویرایش پروفایل') }}
                        </a>
                        <a class="dropdown-item text-end text-light" href="{{ route('admin.destroy') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('delete-form').submit();">
                            {{ __('حذف حساب کاربری') }}
                        </a>
                        <form id="delete-form" action="{{ route('admin.destroy') }}" method="POST" class="d-none">
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
            <a href="{{ route('admin.index') }}" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                <svg class="bi me-2" width="30" height="24">
                    <use xlink:href="#bootstrap" />
                </svg>
                <span class="fs-5 fw-semibold text-white">پنل ادمین</span>
            </a>
            <ul class="list-unstyled ps-0">
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed text-white" data-bs-toggle="collapse"
                        data-bs-target="#restaurant-collapse" aria-expanded="false">
                        دسته بندی رستوران
                    </button>
                    <div class="collapse" id="restaurant-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
                            <li><a href="{{ route('admin.restaurantCategories.create') }}" class="link-dark rounded text-white">ایجاد دسته بندی رستوران</a></li>
                            <li><a href="{{ route('admin.restaurantCategories.index') }}" class="link-dark rounded text-white">لیست دسته بندی رستوران</a></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn btn-toggle align-items-center rounded collapsed text-white" data-bs-toggle="collapse"
                        data-bs-target="#food-collapse" aria-expanded="false">
                        دسته بندی غذا
                    </button>
                    <div class="collapse" id="food-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
                            <li><a href="{{ route('admin.foodCategories.create') }}" class="link-dark rounded text-white">ایجاد دسته بندی غذا</a></li>
                            <li><a href="{{ route('admin.foodCategories.index') }}" class="link-dark rounded text-white">لیست دسته بندی غذا</a></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn btn-toggle align-items-center rounded collapsed text-white" data-bs-toggle="collapse"
                        data-bs-target="#off-collapse" aria-expanded="false">
                        تخفیف
                    </button>
                    <div class="collapse" id="off-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
                            <li><a href="{{ route('admin.offs.create') }}" class="link-dark rounded text-white">ایجاد تخفیف</a></li>
                            <li><a href="{{ route('admin.offs.index') }}" class="link-dark rounded text-white">لیست تخفیف ها</a></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn btn-toggle align-items-center rounded collapsed text-white" data-bs-toggle="collapse"
                        data-bs-target="#banner-collapse" aria-expanded="false">
                        بنر
                    </button>
                    <div class="collapse" id="banner-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
                            <li><a href="{{ route('admin.banners.create') }}" class="link-dark rounded text-white">ایجاد بنر</a></li>
                            <li><a href="{{ route('admin.banners.index') }}" class="link-dark rounded text-white">مشاهده بنر ها</a></li>
                            <li><a href="{{ route('admin.banners.show') }}" class="link-dark rounded text-white">نمایش اسلایدی بنر ها</a></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn btn-toggle align-items-center rounded collapsed text-white" data-bs-toggle="collapse"
                        data-bs-target="#comment-collapse" aria-expanded="false">
                        نظرات
                    </button>
                    <div class="collapse" id="comment-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1">
                            <li><a href="{{ route('admin.comments.index') }}" class="link-dark rounded text-white">مشاهده نظرات</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        @yield('content')
    </main>
</body>

</html>
