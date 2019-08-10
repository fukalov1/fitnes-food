
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
                    <div class="header-main-submit" >
                        <a v-scroll-to="'#send_order'" @click="showFormOrder=true; showFormCall=false" class="send-order pointer">Оставить <br>заявку</a>
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
                        <a v-scroll-to="'#send_order'" @click="showFormCall=true; showFormOrder=false"  class="ph2 pointer">Заказать звонок</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="header-navig" id="flexmenu">--}}
    {{--<ul id="main-menu">--}}
    {{--@foreach($pages as $page)--}}
    {{--<li>--}}
    {{--@if($page->redirect=='')--}}
    {{--<a href='/{{ $page->url }}'>{!! $page->name  !!} </a>--}}
    {{--@else--}}
    {{--<a href='/{{ $page->redirect }}'>{!! $page->name  !!} </a>--}}
    {{--@endif--}}
    {{--@if ($page->relation)--}}
    {{--<ul class="sub-menu">--}}
    {{--@foreach($page->sub_pages as $sub_page)--}}
    {{--<li>--}}
    {{--@if($sub_page->redirect=='')--}}
    {{--<a href='/{{ $sub_page->url }}'>{{ $sub_page->name }}</a>--}}
    {{--@else--}}
    {{--<a href='/{{ $sub_page->redirect }}'>{{ $sub_page->name }}</a>--}}
    {{--@endif--}}
    {{--</li>--}}
    {{--@endforeach--}}
    {{--</ul>--}}
    {{--@endif--}}
    {{--</li>--}}
    {{--@endforeach--}}
    {{--</ul>--}}
    {{--</div>--}}

    <nav class="navbar navbar-expand-lg navbar-dark justify-content-center bg-menu">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse  justify-content-center" id="navbar1">
            <ul class="navbar-nav">
                @foreach($pages as $page)
                    <li class="nav-item">
                        @if($page->id == 1)
                            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown{{ $page->id }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {!! $page->name  !!}
                            </a>
                        @elseif($page->redirect=='')
                            <a class="nav-link active" href="/{{ $page->url }}" id="navbarDropdown{{ $page->id }}">{!! $page->name  !!}</a>
                        @else
                            <a class="nav-link active" href="/{{ $page->redirect }}" id="navbarDropdown{{ $page->id }}">{!! $page->name  !!}</a>
                        @endif
                        @if ($page->relation)
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $page->id }}">
                                @foreach($page->sub_pages as $sub_page)
                                    @if($sub_page->redirect=='')
                                        <a  class="dropdown-item" href='/{{ $sub_page->url }}'>{{ $sub_page->name }}</a>
                                    @else
                                        <a  class="dropdown-item" href='/{{ $sub_page->redirect }}'>{{ $sub_page->name }}</a>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>

        </div>
    </nav>
</header>
