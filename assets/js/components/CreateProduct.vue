<template>
    <div>
        CreateProduct

        <div>
          <div v-for="error in errors">
            <p>{{error}}</p>
          </div>

          Nom Produit
          <input type="text" id="NomProduit" name="NomProduit" v-model="NomProduit" min="2">

          Prix
          <input type="number" step="0.01" id="PrixProduit" name="PrixProduit" v-model="Prix" min="0.01">


         
          <select v-model="selectedTypeProduit">
            <option disabled value="">Sélectionnez un Type</option>
            <option v-for="typ in type" v-bind:value="typ.id">
              {{ typ.Nom }}
            </option>
          </select>


          
          <select v-model="selectedCollectionProduit">
            <option disabled value="">Sélectionnez une collection</option>
            <option v-for="col in collection" v-bind:value="col.id">
              {{ col.nom }}
            </option>
          </select>
          


          <input type="file" @change="onFileChanged">

          <div class="image-preview" v-if="imageData.length > 0">
            <img class="preview" width="1080":src="imageData">
          </div>

          <button @click="onUpload">Upload!</button>
          
          <p>{{selectedTypeProduit}}</p>
          <p>{{collection}}</p>

          <p>{{type}}</p>



            <!--(Couleur produit //On push ça dans un array CouleurProduit
              <div id="Sous_form_CouleurProduit">
                <input type="text" id="CouleurProduit" name="CouleurProduit" v-model="CouleurProduit" min="2">Couleur</input>
                image upload (upload)
              <div>-->
            
        </div>
    
    </div>
</template>

<script>
  export default {
    name: "CreateProduct",
    data:function(){
        return{
            NomProduit:'',
            selectedFile: null ,
            Prix:null,
            CouleurProduit:'',
            CouleurProduitArray:[],
            selectedTypeProduit:'',
            selectedCollectionProduit:'',
            errors:[],
            imageData: "",
            collection:[],
            type:[]
        }
    },
    methods:{
      onFileChanged (event) {
        this.selectedFile = event.target.files[0]

        // Reference to the DOM input element
        var input = event.target;
        //Etre sur d'avoir l'image avant de vouloir la lire
        if (input.files && input.files[0])
        {
          //FileReader pour lire l'image et la convertir en base 64
          var reader = new FileReader();
          // On définit un callback, lancé lorsque FileReader a terminé son travail
          reader.onload = (e) => {
            //On convertit en base 64 et on met le résultat dans this.imageData
            this.imageData = e.target.result;
          }
          // Start the reader job - read file as a data url (base64 format)
          reader.readAsDataURL(input.files[0]);
        }

      },
      onUpload() {
        if((this.NomProduit.length > 2) && this.selectedFile && this.selectedCollectionProduit && this.selectedTypeProduit && this.Prix)
        {
          let formData = new FormData();
          
          formData.append('titre',this.NomProduit);
          formData.append('collection',this.selectedCollectionProduit);
          formData.append('type',this.selectedTypeProduit);
          formData.append('prix',this.Prix);
          formData.append('myFile', this.selectedFile, this.selectedFile.name);

          console.log(formData);

          const token = $cookies.get('auth_token');

          axios.post('/api/postproduit',
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data',
              'Authorization' : `Bearer ${token}`
              }
          }).then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          })
          .then(function () {
            // always executed
          });  

        }
        this.errors=[];
        if(this.NomProduit.length<=2){
          this.errors.push('Nom du produit absent ou trop court.');
        }
        if(!this.selectedFile){
          this.errors.push('Une image est requise.');
        }
        if(!this.selectedTypeProduit){
          this.errors.push('Un type de produit est requis.');
        }
        if(!this.selectedCollectionProduit){
          this.errors.push('Une collection est requise.');
        }
        if(!this.Prix){
          this.errors.push('Un prix est requis.');
        }
      }
    },
    created: function(){
      const token = $cookies.get('auth_token');

      axios.get('/api/getcollectiontypeproduit', {headers: {'Authorization' : `Bearer ${token}`}}).then((response) => {
        console.log(response.data);
        this.collection=JSON.parse(response.data[0]);
        this.type=JSON.parse(response.data[1]);
        console.log()
      }).catch(function(error) {
        console.log(error);
      })
    }
  }
</script>

<style scoped>

</style>