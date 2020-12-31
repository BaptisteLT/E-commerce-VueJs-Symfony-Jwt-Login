import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from "vuex-persistedstate";//Persiste les data

Vue.use(Vuex);


export const store = new Vuex.Store({
    plugins: [createPersistedState()],//Persiste les data
    strict: true,
    store,
    modules: {},
    state:{
        TokenLogin:false,
        role:null
    },
    mutations: {
        setTokenTrue (state) {
          // mutate state
          state.TokenLogin=true;
        },
        setTokenFalse (state) {
            // mutate state
            state.TokenLogin=false;
        },
        setRoleUser (state) {
          // mutate state
          state.role='ROLE_USER';
        },
        setRoleAdmin (state) {
            // mutate state
            state.role='ROLE_ADMIN';
        },
        setRoleNull (state) {
          // mutate state
          state.role=null;
        }
      }
})