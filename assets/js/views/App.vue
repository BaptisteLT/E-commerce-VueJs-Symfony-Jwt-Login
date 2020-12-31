<template>
  <div>
    <Navigation></Navigation>
    <div id='router-view'>
      <router-view/>
    </div>
  </div>
</template>
<script>
  import Navigation from '../components/Navigation.vue'
  export default {
  created () {
  },
    name: "App",
    components: { 
      'Navigation': Navigation 
    }
  }
</script>

<style scoped>

</style>