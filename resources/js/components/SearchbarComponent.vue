<template>
    <div
        id="searchbar"
        class="col-md-6 mb-4 mx-4 search_bar d-flex flex-row-reverse justify-content-center align-items-center"
    >
        <a
            @click="saveCo()"
            class="btn py-1 fw-bold search text-white mt-2"
            href="/research"
            >Cerca</a
        >
    </div>
</template>

<script>
import { Bus } from "../app";
export default {
    data() {
        return {
            apikey: "Oe8qW7UX2GW9LFGSM2ePZNH5D3IpOBqK",
            coordinates: {
                lat: null,
                lon: null,
            },
            newCoordinates: null,
        };
    },

    methods: {
        createSearchbox() {
            var options = {
                searchOptions: {
                    key: this.apikey,
                    language: "it-IT",
                    limit: 5,
                },
                autocompleteOptions: {
                    key: this.apikey,
                    language: "it-IT",
                },
            };

            var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
            var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
            document.getElementById("searchbar").append(searchBoxHTML);

            ttSearchBox.on("tomtom.searchbox.resultselected", (data) => {
                console.log(data.data.result.position);
                this.$set(
                    this.coordinates,
                    "lat",
                    data.data.result.position.lat
                );
                this.$set(
                    this.coordinates,
                    "lon",
                    data.data.result.position.lng
                );
                Bus.$emit("sendCoordinates", this.coordinates);
                const parsed = JSON.stringify(this.coordinates);
                localStorage.setItem("coordinates", parsed);
                console.log("salviamo le coordinate", localStorage);
            });
        },
        /* saveCo() {
            localStorage.coordinates = this.coordinates;
            console.log("salviamo le coordinate", localStorage);
        }, */
        /* saveCo() {
            const parsed = JSON.stringify(this.coordinates);
            localStorage.setItem("coordinates", parsed);
            console.log("salviamo le coordinate", localStorage);
        }, */
    },

    mounted() {
        this.createSearchbox();
    },
};
</script>

<style></style>
