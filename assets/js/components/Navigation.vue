<template>
    <ul>
      <li><router-link to="/">Page 1</router-link></li>
      <li v-if="!LoginStatus"><router-link to="/login">Login</router-link></li><!-- v-if="!isLogged()" -->
      <li v-if="LoginStatus"><router-link to="/userinfos">Data user</router-link></li><!-- v-if="isLogged()" -->
      <li v-if="LoginStatus && isAdmin"><router-link to="/createproduct">createproduct</router-link></li><!-- v-if="isLogged()" -->
      <button class="btn btn-primary" v-if="LoginStatus" v-on:click="disconnect">Logout</button>
       {{ LoginStatus }}
       <button class="btn btn-primary"  v-on:click="RoleStatusMethod">testrole</button>
    </ul>
</template>

<script>
  export default {
    name: "Navigation",
    methods:{
      disconnect: function(){
        this.$store.commit('setTokenFalse');//Le token est devenu inactif (il a été supprimé ou est arrivé à expiration) (dans store.js)
        this.$store.commit('setRoleNull');//Le token est devenu inactif (il a été supprimé ou est arrivé à expiration) (dans store.js)
        $cookies.keys().forEach(cookie => $cookies.remove(cookie));//Tue tous les cookies.
        if (this.$route.name !== 'home'){
          this.$router.push('home');//Simple redirection vers la page /
        }
      },
      RoleStatusMethod: function (requiredRole) {
        var roleUser = this.$store.state.role;//Récupère true ou false, selon si l'utilisateur est login ou non
        console.log(roleUser);
          //$cookies.set('auth_token', response.data.token);//Set le cookie avec le Token, et l'array "Roles".
          //$cookies.set('Roles', decoded.roles);//Set le cookie avec le Token, et l'array "Roles".
         
         //return
        
      }
    },
    computed: {
      LoginStatus () {
        return this.$store.state.TokenLogin//Récupère true ou false, selon si l'utilisateur est login ou non
      },
      isAdmin() {
        if(this.$store.state.role==='ROLE_ADMIN')
        {
          return true;
        }
      }

        
    },
  }
</script>

<style scoped>

</style>