
<header>
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="header-top-left">
                        Сырье для производства максимально полезных продуктов
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="header-top-right">
                        {{ config('address') }}  |   <a href="mailto:{{ config('email') }}">{{ config('email') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-main">
        <div class="container">
            <div class="row">
                <div class="col-5 col-lg-4 order-1 order-lg-1">
                    <div class="header-main-submit">
                        <a href="#send_order">Оставить <br>заявку</a>
                    </div>
                </div>
                <div class="col-lg-4 order-3 order-lg-2">
                    <div class="logo">
                        <a href="/" title="на главную страницу"><img src="{{ asset('images/logo.png') }}" alt="на главную страницу"></a>
                    </div>
                </div>
                <div class="col-7 col-lg-4 order-2 order-lg-3">
                    <div class="phone-header">
                        <a href="tel:{{ config('phone') }}" class="ph1">{{ config('phone') }}</a>
                        <p>ПН-ПТ: с 8:00 до 17:00</p>
                        <a href="" class="ph2">Заказать звонок</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-navig">
        <ul>
            @foreach($pages as $page)
                <li>
                    @if($page->redirect=='')
                        <a href='/{{ $page->url }}'>{!! $page->name  !!} </a>
                    @else
                        <a href='/{{ $page->redirect }}'>{!! $page->name  !!} </a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</header>

