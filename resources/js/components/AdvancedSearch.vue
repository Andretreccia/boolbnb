<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1>TESTIAMO IL COMPONENTE</h1>

                    <form class="d-flex me-5">
                        <input
                            class="form-control mr-sm-2"
                            type="search"
                            placeholder="fai una ricerca"
                            v-model="pippoutente"
                        />
                        <button
                            class="btn btn-primary my-2 my-sm-0"
                            type="submit"
                            @click="pippofunction()"
                        >
                        Search
                        </button>
                 </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
    return {
        pippo: "",
        pippoutente:"",
    };
  },
    methods:
    {
            pippofunction() {
                console.log('pippo function consolelog')
                axios
                    .get("" + this.pippoutente)
                    .then((response) => {
                        this.pippo = response.data;
                        })
                .catch((error) => {
                console.log(error, "Pippo non funge fra");
                });
            },
        mounted() {
            console.log('W PIPPO')
        },
    }
    }
</script>
