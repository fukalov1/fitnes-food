
<footer>
    <div class="footer-navig">
        <ul>
            <li><a href="">Товары</a></li>
            <li><a href="/o-kompanii">О компании</a></li>
            <li><a href="/kontakty">Контакты</a></li>
        </ul>
    </div>
    <div class="header-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="header-main-submit">
                        <a v-scroll-to="'#send_order'" @click="showFormOrder=true; showFormCall=false" class="pointer">Оставить <br>заявку</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="logo">
                        <a href="/" title="на главную страницу">
                            <img src="{{ asset('images/logo.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="phone-header">
                        <a href="mailto:{{ config('phone') }}" class="ph1">{{ config('phone') }}</a>
                        <p>ПН-ПТ: с 8:00 до 17:00</p>
                        <a  v-scroll-to="'#send_order'" @click="showFormOrder=false; showFormCall=true" class="ph2 pointer">Заказать звонок</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-top-left">
                        Сырье для производства максимально полезных продуктов
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header-top-right">
                        {{ config('address') }}   |   <a href="mailto:{{ config('email') }}">{{ config('email') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
