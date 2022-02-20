

import "bootstrap/dist/css/bootstrap.min.css"
import 'bootstrap-icons/font/bootstrap-icons.css'
import "bootstrap"
import "bootstrap/dist/js/bootstrap.js"


require('alpinejs');


//const frete = require('frete');
//const frete = require('frete');





import { createApp } from "vue";

import router from "./router";

import Footer from './components/Footer.vue';



createApp({

    data() {
        return {
            open: false,
            publicPath: process.env.BASE_URL
        }
    }
}).use(router).component('Footer', Footer).mount("#app");







