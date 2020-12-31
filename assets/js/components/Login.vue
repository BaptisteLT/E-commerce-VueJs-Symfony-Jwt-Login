<template>
      <div id="login">
        <h1>Login</h1>
        <input type="text" name="username" v-model="username" placeholder="Username" />
        <input type="password" name="password" v-model="password" placeholder="Password" />
        <button type="button" v-on:click="login()">Login</button>
        {{username}}
        {{password}}
        {{token}}
    </div>
</template>

<script>
  import jwt_decode from 'jwt-decode';//JWT TOKEN DECODE
  export default {
    name: "Login",
    data:function(){
      return{
        username: '',
        password: '',
        token:''
      }
    },
    methods:{
        login() {
        axios.post('/api/login_check', {
          username: this.username,
          password: this.password
        }).then(response => {
          //(npm run watch)

          var decoded = jwt_decode(response.data.token);//Décode le token
          $cookies.set('auth_token', response.data.token);//Set le cookie avec le Token

          this.$store.commit('setTokenTrue');//Active la session dans Vuejs
          var roleGranted=0;//ROLE_USER == 0 et ROLE_ADMIN == 1
          
          decoded.roles.forEach((item, index) => { //Pour chaque role
            if(item==="ROLE_ADMIN"){//Si le role vaut ROLE_ADMIN
              roleGranted=1;//roleGranted vaut 1
            }
          }); 
          if(roleGranted==1){//Si roleGranted vaut 1, donc le ROLE_ADMIN est trouvé
            this.$store.commit('setRoleAdmin'); //On commit dans Vuex la "méthode" setRoleAdmin
          }
          else{ //ou à défaut
            this.$store.commit('setRoleUser'); //On commit dans Vuex la "méthode" setRoleUser
          }
          
          if (this.$route.name !== 'home'){
            this.$router.push({ name: 'home' });//Simple redirection vers la page /
          }

        }).catch(error => {
          console.log(error.response);
        }).finally(() => {
          this.isLoading = false;
        })
        //const token = $cookies.get('auth_token');
      }
    }
  }
</script>

<style scoped>

</style>