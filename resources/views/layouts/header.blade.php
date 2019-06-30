<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(53439478, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/53439478" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script>
    (function() {
        var cx = '006452384993994432771:9yn80i_ozlw';
        var gcse = document.createElement('script');
        gcse.type = 'text/javascript';
        gcse.async = true;
        gcse.src = 'https://cse.google.com/cse.js?...' + cx;
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(gcse, s);
    })();
</script>
<gcse:search></gcse:search>


<header id="top-header">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-6 col-sm-4 col-lg-6">
                    <div class="logo">
                        <a href="/" title="на главную страницу центра трудовых ресурсов"><img src="{{ asset('images/logo.png') }}" alt="центр трудовых ресурсов"></a>
                    </div>
                </div>
                <div class="col-6 col-sm-8 col-lg-6">
                    <div class="phone-header">
                        <a href="tel:{{ config('phone') }}">{{ config('phone') }}</a>
                        <a href="/svedeniya-ob-organizacii/obratnaya-svyaz">Обратная связь</a>
                        <a href="/svedeniya-ob-organizacii/platnye-uslugi">Платные услуги</a>
                    </div>
                    <div class="clearfix"></div>
                    <p>Создаем будущее вместе</p>
                </div>
            </div>
        </div>
    </div>

    <nav id='flexmenu'>
        <div id="mobile-toggle" class="button"></div>
        <ul id="main-menu">
            @foreach($pages as $page)
                <li>
                    @if($page->redirect=='')
                        <a href='/{{ $page->url }}'>{!! $page->name  !!} </a>
                    @else
                        <a href='/{{ $page->redirect }}'>{!! $page->name  !!} </a>
                    @endif
                    @if ($page->relation)
                        <ul class="sub-menu">
                            @foreach($page->sub_pages as $sub_page)
                                <li>
                                    @if($sub_page->redirect=='')
                                        <a href='/{{ $sub_page->url }}'>{{ $sub_page->name }}</a>
                                    @else
                                        <a href='/{{ $sub_page->redirect }}'>{{ $sub_page->name }}</a>
                                    @endif
                                    @if ($sub_page->relation)
                                        <ul>
                                        @foreach($sub_page->sub_pages as $sub_sub_page)
                                            <li>
                                                @if($sub_sub_page->redirect=='')
                                                    <a href='/{{ $sub_sub_page->url }}'>{{ $sub_sub_page->name }}</a>
                                                @else
                                                    <a href='/{{ $sub_sub_page->redirect }}'>{{ $sub_sub_page->name }}</a>
                                                @endif
                                            </li>
                                        @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
</header>
