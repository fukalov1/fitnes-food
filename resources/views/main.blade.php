@extends('layouts._pages')


@section('content')


    @foreach($page_blocks as $page_block)

        @if($page_block->type == '1')

                    <h1>{{ $page_block->header }}</h1>
                    {!! $page_block->text !!}
        @endif
    @endforeach

    <div class="about-page-form" id="send_order" v-if="showFormOrder || showFormCall">
        <div>
            <div class="about-page-form-item" v-if="success===false && error===''">
                <h3 v-if="showFormOrder">Оставить заявку</h3>
                <h3 v-if="showFormCall">Заказать звонок</h3>
                <ul>
                    <li class="error" :class="{showCheck: showCheck && send}">Вы должны указать согласие на обработку персональных данных</li>
                    <li class="error" :class="{showEmpty: showEmpty && send}">Поля формы обязательны. Заполните их и отправьте заявку еще раз.</li>
                </ul>
                <form id="send_order" class="" action="#" method="post">
                    <input type="text"v-model="name" placeholder="ФИО">
                    <input type="tel" v-mask="'+7(###)###-####'" v-model="phone" class="phone_numb" placeholder="Ваш номер телефона">
                    <input type="email" v-model="email" class="phone_numb" placeholder="Ваш email" v-if="showFormOrder">
                    <textarea v-model="message" class="phone_numb" placeholder="Заполните текст заявки" v-if="showFormOrder"></textarea>
                    <div class="_middle">
                        <input type="checkbox" class="form-control" v-model="check" />
                        <label for="check">Согласие на обработку персональных данных</label>
                    </div>
                    <button type="button" @click="checkForm">ОТПРАВИТЬ</button>
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
