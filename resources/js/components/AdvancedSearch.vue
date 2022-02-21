<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1>TESTIAMO IL COMPONENTE</h1>
                    <input
                        class="form-control mr-sm-2"
                        type="text"
                        placeholder="fai una ricerca"
                        v-model="userInput"
                    />
                    <button
                        class="btn btn-primary my-2 my-sm-0"
                        @click="searchFunction()"
                    >
                        Search
                    </button>

                    <button class="" @click="serviceFunction()">
                        click di prova
                    </button>

                    <div class="d-flex flex-wrap">
                        <div style="max-width: 70px" class="mx-2 mb-3">
                            <label for="n_rooms" class="form-label">
                                n Camere min</label
                            >
                            <input
                                type="number"
                                min="0"
                                max="200"
                                class="form-control"
                                name="n_rooms"
                                id="n_rooms"
                                aria-describedby="n_roomsHelper"
                                placeholder="0"
                                v-model="n_rooms"
                            />
                        </div>
                        <div style="max-width: 70px" class="mx-2 mb-3">
                            <label for="square_meters" class="form-label"
                                >n letti min</label
                            >
                            <input
                                type="number"
                                min="0"
                                max="5000"
                                class="form-control"
                                name="n_bed"
                                id="n_bed"
                                aria-describedby="n_bedHelper"
                                placeholder="0"
                                v-model="n_bed"
                            />
                        </div>
                        <div>
                            <div
                                class="mb-3"
                                v-for="service in services"
                                v-bind:key="service.id"
                            >
                                <div class="form-check">
                                    <input
                                        type="checkbox"
                                        class="form-check-input"
                                        :name="service.name"
                                        :id="service.id"
                                        :value="service.id"
                                        v-model="v_services"
                                    />
                                    <label class="form-check-label" for="">
                                        {{ service.name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <a
                href="#"
                class="card justify-content-between card_promo m-3"
                v-for="apartment in apartments"
                :key="apartment.id"
            >
                <img
                    class="card-img-top thumb"
                    :src="'storage/' + apartment.image"
                    alt="Card image cap"
                />
                <p class="promo">Promotion</p>
                <h2 class="card-text m-3 card_title">{{ apartment.title }}</h2>
                <div class="box">
                    <p class="card-text m-3">{{ apartment.description }}</p>
                </div>

                <div
                    class="button_details p-2 w-50 justify-content-center align-items-center text-center text-white m-auto mt-4 mb-4"
                >
                    <span>View details</span>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
import { Bus } from "../app";
export default {
    data() {
        return {
            apartments: [],
            userInput: "",
            n_bed: "",
            n_rooms: "",
            v_services: [],
            coordinates: {},
            pippo: null,
        };
    },
    props: { services: Array },

    methods: {
        searchFunction() {
            /* console.log(this.pippoutente)
                console.log('pippo function consolelog') */
            console.log(this.userInput);
            axios
                //.get('/api/apartments' + '?address=' + this.userInput )
                //.get(`/api/apartments?address=${this.userinput}`
                .get(
                    /*  "/api/apartments?n_rooms=" +
                        //this.n_bed +
                        "&n_rooms=" +
                        this.n_rooms */
                    //`/api/apartments?address=${this.userInput}&n_rooms=${this.n_rooms}&n_bed=${this.n_bed}`
                    //`/api/apartments?address=${this.userInput}&n_rooms=${this.n_rooms}&n_bed=${this.n_bed}&services=${this.v_services}`
                    `/api/apartments?address=${this.userInput}&n_rooms=${this.n_rooms}&n_bed=${this.n_bed}&services=${this.v_services}&latitude=${this.coordinates.lat}&longitude=${this.coordinates.lon}`
                )
                .then((response) => {
                    this.apartments = response.data.data;
                    console.log(this.apartments);
                    console.log(this.n_rooms);
                    console.log(this.n_rooms);
                })
                .catch((error) => {
                    console.log(error, "Pippo non funge fra");
                });
        },
        serviceFunction() {
            console.log(this.coordinates);
        },
        pippoFunction(i) {
            console.log(this.service[i]);
        },
    },
    created() {
        Bus.$on("sendCoordinates", (data) => {
            this.coordinates = data;
        });
        console.log(this.coordinates);
    },
};
/*appunti prima di iniziare

Per soddisfare il fatto che non si deve avere un refresh della pagina della ricerca bisogna fare chiamate delle ajax.
Il metodo più utilizzato in questi casi è fare in modo che ogni cambiamento di input vada a modificare i campi utili alla ricerca nell’url es (/ricerca?tipologia=cinese).
Dopo ogni cambiamento viene fatta una chiamata ajax con i parametri presenti nella URL.









  */
</script>
