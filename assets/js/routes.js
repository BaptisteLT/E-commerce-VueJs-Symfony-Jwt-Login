import Vue from 'vue';
import VueRouter from 'vue-router';
import VueCookies from 'vue-cookies';//Vue cookie pareil à voir si on peut suppr
import { store } from './stores/store'

import Home from './components/Home';
import Login from './components/Login';
import CreateProduct from './components/CreateProduct';


Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes:[
    {path:'/', name:'home', component:Home},
    {path:'/login', name:'login', component:Login/*,BeforeEnter check if logged*/},
    {path:'/createproduct', name:'CreateProduct', component:CreateProduct/*,BeforeEnter check if logged*/}
  ]
});

/*On vérifie que le token role et auth_token sont bien valides, si c'est le cas on continue normalement*/
router.beforeEach((to, from, next) => {
  if($cookies.get('auth_token') && store.state.role!=null){
    console.log('Access granted.');
    next();
  }
  /*Autrement on kill tous les cookies et dans store.js on commit setTokenFalse pour passer la session à False*/
  else{
    store.commit('setTokenFalse'); //Le token est devenu inactif (il a été supprimé ou est arrivé à expiration) (dans store.js)
    store.commit('setRoleNull'); //Le token est devenu inactif (il a été supprimé ou est arrivé à expiration) (dans store.js)
    console.log('The session has expired. Please login.');
    $cookies.keys().forEach(cookie => $cookies.remove(cookie));//Tue tous les cookies.
      next();
  }
})

export default router;