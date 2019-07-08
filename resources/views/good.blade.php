@extends('layouts._pages')


@section('content')

            <div id="app" class="container">
                <div class="goods-page-item" style="background: url(/uploads/{{ $data->image }})no-repeat center;">
                    {{--{{ dd($data) }}--}}
                    <h3>{{ $data->name }}</h3>
                    <p>&nbsp;</p>
                    <h3>{{ $data->name_ext }}</h3>
                </div>

                <div class="about-page-main">
                    <div class="row">
                            <div class="col-md-6">
                                {!! $data->text !!}
                            </div>
                            <div class="col-md-6">
                                {!! $data->info !!}
                            </div>
                    </div>
                </div>
                <div class="about-page-form">
                    <div class="about-page-form-item" v-if="success===false && error===''">
                        <h3>Оставить заявку</h3>
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



@stop
