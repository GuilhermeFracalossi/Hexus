

import "bootstrap/dist/css/bootstrap.min.css"
import 'bootstrap-icons/font/bootstrap-icons.css'
import "bootstrap"
import "bootstrap/dist/js/bootstrap.js"
import {VueToastify} from "vue-toastify";

require('alpinejs');


import { createApp } from "vue";

import router from "./router";

createApp({

    data() {
        return {
            open: false
        }
    }
}).use(router).use(VueToastify).mount("#app");





