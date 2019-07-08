@extends('layouts._pages')


@section('content')



    @foreach($page_blocks as $page_block)

        @if($page_block->type == '1')
            {{--<section class="page-block" id="block{{$page_block->id}}">--}}
                {{--<div class="container">--}}
                    {{--<h1>{{ $page_block->header }}</h1>--}}

                {{--</div>--}}
            {{--</section>--}}
            <div class="container">
                <div class="about-page-item">
                    <h2>{{ $page_block->header }}</h2>
                    @if($page_block->header1!='')
                        <p></p>
                        <h2>{{ $page_block->header1 }}</h2>
                    @endif
                </div>

                <div class="about-page-main">
                    <div class="row">
                        @if($page_block->text1!='' and $page_block->text1!='<p>-</p>')
                            <div class="col-md-6">
                                {!! $page_block->text !!}
                            </div>
                            <div class="col-md-6">
                                {!! $page_block->text1 !!}
                            </div>
                        @else
                            <div class="col-md-12">
                                {!! $page_block->text !!}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="about-page-form" id="send_order" v-if="showFormOrder || showFormCall">
                    <div>
                        <div class="about-page-form-item" v-if="success===false && error===''">
                            <h3 v-if="showFormOrder">Оставить заявку</h3>
                            <h3 v-if="showFormCall">Заказать звонок</h3>
                            <ul>
                                <li class="error" :class="{showCheck: showCheck}">Вы должны указать согласие на обработку персональных данных</li>
                                <li class="error" :class="{showEmpty: showEmpty}">Поля формы обязательны. Заполните их и отправьте заявку еще раз.</li>
                            </ul>
                            <form id="send_order" class="" action="#" method="post">
                                <input type="text"v-model="name" placeholder="ФИО">
                                <input type="text" v-model="phone" class="phone_numb" placeholder="Ваш номер телефона">
                                <div class="_middle">
                                    <input type="checkbox" id="check" class="form-control" v-model="check" />
                                    <label for="check">Согласие на обработку персональных данных</label>
                                </div>
                                <button type="button" @click="send=true">ОТПРАВИТЬ</button>
                            </form>
                        </div>
                        <div class="about-page-form-item" v-if="success===false && error != ''">
                            <h3>@{{ error }}</h3>
                        </div>
                        <div class="about-page-form-item" v-else-if="success && error === ''">
                            <h3>@{{ resultSend }}</h3>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($page_block->type=='10')
            @foreach($page_block->mail_forms as $item)
                    <section class="mail-form" id="block{{ $page_block->id }}">
                        <div class="container form-area{{ $item->id }}">
                            <h2>{{ $item->name }}</h2>
                            {!! $page_block->text  !!}
                            <form id="sendform{{ $item->id }}" class="send-form" method="post">
                                {{ csrf_field() }}
                                <div class="form-inp">
                                    @foreach($item->fields as $field)
                                        <input type="text" class="field" rel="{{ $field->field_name }}"
                                               id="{{ $field->field_name }}{{ $item->id }}"
                                               name="{{ $field->field_name }}" placeholder="{{ $field->field_value }}">
                                    @endforeach
                                </div>
                                <div class="form-textarea">
                                    <textarea name="message{{ $item->id }}" id="message{{ $item->id }}"
                                              placeholder="Комментарий…"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="submit-button" rel="{{ $item->id }}">Отправить</button>
                                </div>
                                <div class="clearfix"></div>
                                <input type="hidden" name="uid" value="{{ $item->id }}">
                            </form>
                        </div>
                    </section>
            @endforeach
        @elseif($page_block->type=='11')

            <script src="https://api-maps.yandex.ru/2.1/?apikey=c79faa17-9b3b-4054-9a04-3aad1bb7cb1d&lang=ru_RU&load=Map,Placemark,GeoObjectCollection"
                    type="text/javascript"></script>

            @foreach($page_block->maps as $map)
                    <section class="block_maps"  id="block{{$page_block->id}}">
                        <div class="container">
                            <h2>{{ $map->name }}</h2>

                            <script>
                                ymaps.ready(function () {
                                    // В функцию поступает пространство имен, которое содержит все запрощенные при инициализации модули.
                                    var myMap = new ymaps.Map('map{{ $map->id }}', {
                                        center: [{{ $map->xcoord }}, {{ $map->ycoord }}],
                                        zoom: '{{ $map->zoom }}',
                                        // В данном примере карта создается без контролов, так как те не были загружены при инициализации API.
                                        controls: []
                                    });

                                    @if (count($map->points)>0)
                                    @if ($map->type==1)
                                    myMap.geoObjects
                                    @foreach($map->points as $point)
                                        .add(new ymaps.Placemark(
                                            [{{ $point->xcoord }}, {{ $point->ycoord }}], {
                                                balloonContent: '{{ $point->content }}',
                                                balloonContentHeader: '{{ $point->content }}',
                                                balloonContentBody: '{{ $point->content }}',
                                                hintContent: '{{ $point->content }}',
                                                iconCaption: '{{ $point->name }}'
                                            }))
                                        @endforeach
                                        .add(new ymaps.Placemark(
                                            [53.195538, 50.101783], {
                                                balloonContent: 'Самара город-герой',
                                                balloonContentHeader: "Самара",
                                                balloonContentBody: "описание Самары",
                                                balloonContentFooter: "Подвал",
                                                hintContent: "самара подсказка"
                                            }));
                                    @elseif ($map->type==2)
                                    // Контейнер для меню.
                                    var menu = $('<ul class="map_menu"></ul>');

                                    // Группы объектов
var groups = [
@foreach($map->points as $point)
     @if ($point->parent_id==0)
     {
     name: "{{ $point->name }}",
     style: "islands#redIcon",
     items: [
     @foreach($point->sub_points as $sub_point)
     {
     center: [{{ $sub_point->xcoord }}, {{ $sub_point->ycoord }}],
     name: "{{ $sub_point->name }}"
     },
     @endforeach
     ]
     },
@endif
@endforeach
];

                                    for (var i = 0, l = groups.length; i < l; i++) {
                                        console.log('group ',groups[i]);
                                        createMenuGroup(groups[i]);
                                    }

                                    console.log(groups);

                                    function createMenuGroup(group) {
                                        // Пункт меню.
                                        var menuItem = $('<li><a href="javascript:">' + group.name + '</a></li>'),
                                            // Коллекция для геообъектов группы.
                                            collection = new ymaps.GeoObjectCollection(null, {preset: group.style}),
                                            // Контейнер для подменю.
                                            submenu = $('<ul class="map_submenu"></ul>');

                                        // Добавляем коллекцию на карту.
                                        myMap.geoObjects.add(collection);
                                        // Добавляем подменю.
                                        menuItem
                                            .append(submenu)
                                            // Добавляем пункт в меню.
                                            .appendTo(menu)
                                            // По клику удаляем/добавляем коллекцию на карту и скрываем/отображаем подменю.
                                            .find('a')
                                            .bind('click', function () {
                                                if (collection.getParent()) {
                                                    myMap.geoObjects.remove(collection);
                                                    submenu.hide();
                                                } else {
                                                    myMap.geoObjects.add(collection);
                                                    submenu.show();
                                                }
                                            });
                                        for (var j = 0, m = group.items.length; j < m; j++) {
                                            createSubMenu(group.items[j], collection, submenu);
                                        }
                                    }

                                    function createSubMenu(item, collection, submenu) {
                                        // Пункт подменю.
                                        var submenuItem = $('<li><a href="javascript:">' + item.name + '</a></li>'),
                                            // Создаем метку.
                                            placemark = new ymaps.Placemark(item.center, {balloonContent: item.name, iconCaption: item.name});

                                        // Добавляем метку в коллекцию.
                                        collection.add(placemark);
                                        // Добавляем пункт в подменю.
                                        submenuItem
                                            .appendTo(submenu)
                                            // При клике по пункту подменю открываем/закрываем баллун у метки.
                                            .find('a')
                                            .bind('click', function () {
                                                if (!placemark.balloon.isOpen()) {
                                                    placemark.balloon.open();
                                                } else {
                                                    placemark.balloon.close();
                                                }
                                                return false;
                                            });
                                    }

                                    console.log('menu', menu);
                                    // Добавляем меню в тэг BODY.
                                    menu.appendTo($('#mymenu'));
                                    // Выставляем масштаб карты чтобы были видны все группы.
                                    myMap.setBounds(myMap.geoObjects.getBounds());


                                @endif
                                    @endif

                                });
                            </script>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="map{{ $map->id }}" class="mymaps"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div id="mymenu">
                                        <ul class="map-info">
                                            @foreach($map->points as $point)
                                                <li>
                                                    <strong>
                                                        @if($point->content!='')
                                                            <a href="{{ $point->content }}" target="_blank">{{ $point->name }}</a>
                                                        @else
                                                            {{ $point->name }}
                                                        @endif
                                                    </strong>
                                                    @if ($point->body!='')
                                                        - {{ $point->body }}
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
            @endforeach
        @endif
    @endforeach

    {{--<section class="page-block">--}}
    {{--<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A2bba92d5c8e733ccf0d05bcdeff0fdfac3af4b97f607093cabfa6388e841ada8&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>--}}
    {{--</section>--}}

@stop
