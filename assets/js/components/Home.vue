<template>
    <div class="container">
        Home
        <input type="text" v-model="lol">
        {{lol}}
        <div class="row">
          <div class="col-6 col-sm-4 px-3 mt-4" v-for="res in result">
            <div class="p-3 border product_div">
              <p>{{res.id}}</p>
              <p>{{res.Nom}}</p>
              <div class="img_container">
                <img :src="`/uploads/product_images/${res.imageFilename}`" class="img-fluid img_product" alt="responsive image">
              </div>
              <p>{{res.prix}}</p>
            </div>
          </div>
        </div>
        <sliding-pagination
          :current="currentPage"
          :total="totalPages"
          @page-change="pageChangeHandler"
        ></sliding-pagination>
    </div>
</template>

<script>
import SlidingPagination from 'vue-sliding-pagination'
import "vue-sliding-pagination/dist/style/vue-sliding-pagination.css";
  export default {
    name: "Home",
    components: {
      SlidingPagination
    },
    data:function(){
        return{
            lol:'0',
            result:[],
            currentPage: 1,
            totalPages: 10
        }
    },
    methods:{
      test: function(){
        console.log(this.result[0])
      },
      pageChangeHandler(selectedPage){
        this.currentPage=selectedPage;
        axios.get('/produit',{
          params: {
            page: selectedPage
          }
        }).then((response) => {
          this.result=response.data[0];
          this.totalPages=response.data[1]['lastPage'];
        }).catch(function(error) {
          console.log(error);
        })
      }
    },
    created: function(){
      axios.get('/produit').then((response) => {
        console.log(response.data);
        this.result=response.data[0];
        this.totalPages=response.data[1]['lastPage'];
        console.log(this.result)
      }).catch(function(error) {
        console.log(error);
      })
    }
  }
</script>

<style scoped>
.product_div{
  border:1px solid black;
  background:gray;
}
.img_product{
height: 100%; width: 100%; object-fit: contain;
}
.img_container{

  height:180px;
}
</style>