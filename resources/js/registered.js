/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: Axios } = require('axios');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('input-address-create', require('./components/InputAddressCreate.vue').default);
Vue.component('edit-visibility-checkbox', require('./components/editVisibilityComoponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        // latitude: null,
        // longitude: null,
    },

    methods: {
        /* getLatitudeLongitude(address) {
            axios
                .get(
                    `https://api.tomtom.com/search/2/geocode/${address}.json?key=Oe8qW7UX2GW9LFGSM2ePZNH5D3IpOBqK&limit=5&countrySet=IT&radius={2000}`
                )
                .then((response) => {
                    console.log(response);
                    console.log(response.data.results[0].position);
                    this.latitude = response.data.results[0].position.lat;
                    this.longitude = response.data.results[0].position.lon;
                });
        }, */


        /* insertLatitude() {
            const latitudeInput = document.getElementById('latitude')
            latitudeInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {

                    latitudeInput.value = this.latitude;
                }


            })
        } */

    },

    mounted() {
        // this.getLatitudeLongitude('Via Piave 25 Palermo')
    }

});
