<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{$title}}</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.svg') }}" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <style>
        /* Sidebar styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar h3 {
            margin-bottom: 20px;
            color: #f8f9fa;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #adb5bd;
            padding: 10px 15px;
            display: block;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
            color: #ffffff;
        }

        .sidebar ul li a.active {
            background-color: #007bff;
            color: #ffffff;
            font-weight: bold;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
    
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Navigation</h3>
        <ul>
            <li><a href="/" class="active">Home</a></li>
            @foreach (App\Models\Category::all() as $category )
            <li><a href="{{ route('home',$category->id) }}" >{{$category->name}}</a></li>
           
            @endforeach
           
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Preloader -->
        <div class="preloader">
            <div class="preloader-inner">
                <div class="preloader-icon">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <!-- /End Preloader -->

        <!-- Header -->
        <header class="header navbar-area">
            <!-- Start Topbar -->
            <div class="topbar">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="top-left">
                                <ul class="menu-top-link">
                                    <li>
                                        <div class="select-position">
                                            <select id="currency-select" onchange="updateCurrency(this.value)">
                                            <option value="EGP" {{ session('currency') == 'EGP' ? 'selected' : '' }}>EGP</option>
                                            <option value="USD" {{ session('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                                           
                                            <option value="SAR" {{ session('currency') == 'SAR' ? 'selected' : '' }}>SAR</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select-position">
                                            <select id="select5">
                                                <option value="0" selected>English</option>
                                                <option value="4">العربية</option>
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="top-middle">
                                <ul class="useful-links">
                                    <li><a href="index.html">Home</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="top-end d-flex align-items-center justify-content-end">
                            <div class="button">
                                <a href="{{route('cart.index')}}" class="btn"><i class="lni lni-cart"></i> </a>
                            </div>
                                <ul class="user-links list-unstyled d-flex align-items-center mb-0 ms-3">
                                <li class="me-3">
                                        <a href="{{ route('login') }}">Your Store</a>
                                    </li>
                                    @guest
                                   
                                    <li class="me-3">
                                        <a href="{{ route('register') }}">Request Store</a>
                                    </li>
                                    @endguest

                                    @auth
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Topbar -->
        </header>

        <!-- Dynamic Content -->
        <div>
            {{$slot}}
        </div>
    </div>

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
   function updateCurrency(currency) {
    fetch('/update-currency', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ currency: currency })
    })
    .then(response => response.json())
    .then(data => {
        console.log("Updated currency:", data); // التحقق من القيم في الكونسول

        let rate = parseFloat(data.rate); // تحويل القيمة إلى رقم

        // تحديث العملة في جميع العناصر
        document.querySelectorAll('.symple-currency').forEach(element => {
            element.innerText = data.currency;
        });

        // تحديث سعر المنتج بناءً على العملة الجديدة
        document.querySelectorAll('.product-price').forEach(element => {
            let price = parseFloat(element.dataset.price); // استرجاع السعر الأصلي من `data-price`
            let newPrice = (rate * price).toFixed(2); // الحساب وضبط الصياغة إلى رقم عشري
            element.innerText = newPrice;
        });
    })
    .catch(error => console.error('Error:', error));
}


</script>

    @stack('script')
</body>

</html>
