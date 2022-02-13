import { createRouter, createWebHistory } from "vue-router";

import ProductsIndex from "../components/products/ProductsIndex";
import ProductsCreate from "../components/products/ProductsCreate";
import ProductsEdit from "../components/products/ProductsEdit";

import CategoriesIndex from "../components/categories/CategoriesIndex";
import CategoriesCreate from "../components/categories/CategoriesCreate";
import CategoriesEdit from "../components/categories/CategoriesEdit";

import UsersIndex from "../components/users/UsersIndex";
import UsersCreate from "../components/users/UsersCreate";
import UsersEdit from "../components/users/UsersEdit";

import Cart from "../components/Cart";


import Home from "../components/Home";
import ProductView from "../components/ProductView";

import Dashboard from "../components/Dashboard";

const routes = [
    {
        path: "/dashboard",
        name: "dashboard",
        component: Dashboard,
    },
    {
        path: "/dashboard/products",
        name: "products.index",
        component: ProductsIndex,
    },
    {
        path: "/dashboard/products/create",
        name: "products.create",
        component: ProductsCreate,
    },
    {
        path: "/dashboard/products/:id/edit",
        name: "products.edit",
        component: ProductsEdit,
        props: true
    },

    {
        path: "/dashboard/categories",
        name: "categories.index",
        component: CategoriesIndex,
    },
    {
        path: "/dashboard/categories/create",
        name: "categories.create",
        component: CategoriesCreate,
    },
    {
        path: "/dashboard/categories/:id/edit",
        name: "categories.edit",
        component: CategoriesEdit,
        props: true
    },

    {
        path: "/dashboard/users",
        name: "users.index",
        component: UsersIndex,
    },
    {
        path: "/dashboard/users/create",
        name: "users.create",
        component: UsersCreate,
    },
    {
        path: "/dashboard/users/:id/edit",
        name: "users.edit",
        component: UsersEdit,
        props: true
    },

    {
        path: "/",
        name: "home",
        component: Home
    },
    {
        path: "/product/:id",
        name: "product.view",
        component: ProductView,
        props: true
    },
    {
        path: "/cart",
        name: "cart",
        component: Cart
    }
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
