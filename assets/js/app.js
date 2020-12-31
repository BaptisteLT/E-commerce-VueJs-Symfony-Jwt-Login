/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

import Vue from 'vue';

import Routes from './routes.js';

import App from './views/App';

import axios from 'axios';//Axios import
import VueCookies from 'vue-cookies';//Vue cookie
import VueJWT from 'vuejs-jwt';


import 'bootstrap/dist/css/bootstrap.css';//Bootstrap-css
import 'bootstrap-vue/dist/bootstrap-vue.css';//Bootstrap-css


import { store } from './stores/store';



//import jwt_decode from 'jwt-decode'; ne fonctionne pas ici


window.axios = axios;
axios.defaults.baseURL = 'https://127.0.0.1:8000/'; //Route de base

//Vue.use(VueJWT, { storage : 'cookie' }); NE SURTOUT PAS METTRE AVANT OU CA NE FONCTIONNERA PAS (COMME AVEC CET EXEMPLE)



const app = new Vue({
  el: '#app',
  router: Routes,
  render: h => h(App),
  store
});


Vue.use(VueCookies);//Utiliser vue-cookie
Vue.use(VueJWT, { storage : 'cookie' }); //https://openbase.io/js/vuejs-jwt/documentation


export default app;
