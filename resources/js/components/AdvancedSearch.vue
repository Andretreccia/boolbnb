<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1>TESTIAMO IL COMPONENTE</h1>
                        <input class="form-control mr-sm-2" type="text" placeholder="fai una ricerca" v-model="userInput"/>
                        <button class="btn btn-primary my-2 my-sm-0" @click="searchFunction()"> Search </button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

    export default {
        data() {
    return {
        pippo: [],
        userInput:"",

    };
  },
    methods:
    {
        searchFunction() {
                /* console.log(this.pippoutente)
                console.log('pippo function consolelog') */
                        console.log(this.userInput)
                axios
                    //.get('/api/apartments' + '?address=' + this.userInput )
                    //.get(`/api/apartments?address=${this.userinput}`
                    .get('/api/apartments?address=' + this.userInput
                    )
                    .then((response) => {
                        this.pippo = response.data;
                    console.log(this.pippo)
                        })
                .catch((error) => {
                console.log(error, "Pippo non funge fra");
                });
    }
    }
    }
/*appunti prima di iniziare

Per soddisfare il fatto che non si deve avere un refresh della pagina della ricerca bisogna fare chiamate delle ajax. 
Il metodo più utilizzato in questi casi è fare in modo che ogni cambiamento di input vada a modificare i campi utili alla ricerca nell’url es (/ricerca?tipologia=cinese). 
Dopo ogni cambiamento viene fatta una chiamata ajax con i parametri presenti nella URL.









  */
</script>

