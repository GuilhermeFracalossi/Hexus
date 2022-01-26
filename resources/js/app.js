

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
require('alpinejs');


import { createApp } from "vue";
import router from "./router";
import ProductsIndex from "./components/products/ProductsIndex";

createApp({
    components: {
        ProductsIndex
    }
}).use(router).mount("#app");

