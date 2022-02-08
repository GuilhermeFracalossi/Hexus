

import "bootstrap/dist/css/bootstrap.min.css"
import 'bootstrap-icons/font/bootstrap-icons.css'
import "bootstrap"
require('alpinejs');


import { createApp } from "vue";

import router from "./router";

createApp({

    data() {
        return {
            open: false
        }
    }
    
    
}

).use(router).mount("#app");

import "bootstrap/dist/js/bootstrap.js"



