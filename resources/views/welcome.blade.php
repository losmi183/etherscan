<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ethereum App</title>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    {{-- <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/css/materialdesignicons.min.css">

    {{-- <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/css/vuetify.min.css">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui"> --}}

    {{-- Vuetify CDN  --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script> --}}
    <script src="/js/vue.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>   --}}
    <script src="/js/vuetify.js"></script>

    {{-- Axios --}}
    <script src="/js/axios.min.js"></script>




</head>
<body>
    <div id="app">
        <template>
            <v-app>                
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-data-table
                                dense
                                :headers="headers"
                                :items="transactions"
                                item-key="name"
                                class="elevation-1"
                                :pagination.sync="pagination"
                                :footer-props="{ itemsPerPageOptions: [5, 10] }"
                            ></v-data-table>  
                        </v-col>
                        <v-col>
                            <v-pagination
                                v-model="pagination.page"
                                :length="transactions.length"
                                :total-items="pagination.totalItems"
                                :rows-per-page-items="[5, 10]"
                                @input="fetchData"
                            ></v-pagination>
                        </v-col>
                    </v-row>
                </v-container>       
            </v-app>
        </template>
    </div>
</body>


<script>
    new Vue({
        el: "#app",
        vuetify: new Vuetify(),
        mounted() {
            this.fetchData()
        },
        data: {
            transactions: [],
            headers: [
                { text: 'Id', value: 'id' },
                { text: 'Address', value: 'address' },
                { text: 'timeStamp', value: 'timeStamp' },
            ],
            pagination: {
                page: 1,
                itemsPerPage: 10
            }
        },
        methods: {
            fetchData(page = 1) {
                axios.post('/api/transactions', {
                    "address": "0xaa7a9ca87d3694b5755f213b5d04094b8d0f0a6f",
                    "page": page,
                    "itemsPerPage": this.pagination.itemsPerPage
                })
                .then(result => { 
                    this.transactions = result.data.data;
                })
                .catch(error => console.log(error));
            }
        },
        watch: {
            'pagination.page': function(newPage) {
                this.fetchData(newPage);
            },
            'pagination.itemsPerPage': function(newItemsPerPage) {
                this.pagination.page = 1; // Resetujemo stranicu na prvu kada se promeni broj stavki po stranici
                this.fetchData();
            }
        },
    });
</script>
</html>
