import 'axios';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var VueScrollTo = require('vue-scrollto');

window.Vue = require('vue');
window.axios = require('axios');
Vue.use(VueScrollTo);



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data() {
        return {
            name: '',
            phone: '',
            email: '',
            message: '',
            check: false,
            send: false,
            resultSend: '',
            success: false,
            error: '',
            showFormOrder: false,
            showFormCall: false,
        }
    },
    computed: {
        showCheck: function () {
            let result = true;
            if (this.check===false && this.send)
                result = false
            return result;
        },
        showEmpty: function () {
            let result = true;
            if ((this.name==='' ||this.phone=='') && this.send)
                result = false
            return result;
        },

    },
    watch: {
        send: function (val) {
            if (val && this.showCheck && this.showEmpty) {
                console.log('send data');
                this.error = 'Отправка письма, пожалуйста подождите...';
                let caption = 'Отправить заявку';
                if (this.showFormCall)
                    caption = 'Заказать звонок';
                axios.post('/send_order', {'name': this.name, 'phone': this.phone, 'caption': caption})
                    .then((response) => {
                    console.log('send order data');
                    this.success = response.data.success;
                    this.error = response.data.error;
                    this.resultSend = response.data.result;
                    this.send = false;
                    location.href = '/spasibo';
                })
                .catch( e =>  {
                    console.log('Error send data', e);
                    this.error = 'Ошибка при отправлении: '+e;
                });
            }
        }
    }
});
