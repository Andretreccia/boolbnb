<template>
    <div id="searchbar" class="w-75"></div>
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
            pippot: "stringa di pippo",
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
            });
        },
        sendFunction() {
            console.log("click");
        },
    },

    mounted() {
        this.createSearchbox();
    },
};
</script>

<style></style>
