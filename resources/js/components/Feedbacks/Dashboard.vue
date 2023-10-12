<template >
    <div class="container-fluid ">
        <loader v-if="loading" class="loading-box"></loader>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <!--      <h1 class="h3 mb-0 text-gray-800">Vehicles Dashboard</h1>-->
        </div>
    </div>
    <div class="col-span-12 mt-6">
            <h1 class="text-3xl font-bold mb-6">FEED BACK SYSTEM</h1>
            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-1 gap-2">
                <div style="background-color: #ff5252;" class="p-6 rounded-lg shadow-lg">
                    <h2 class="text-white text-xl font-bold mb-2">Total  Feedbacks</h2>
                    <p class="text-black font-bold text-xl">{{ data.feedbacks }}</p>
                    <span class="text-white text-xl"></span>
                </div>
                <div style="background-color: #FFD700;" class="p-6 rounded-lg shadow-lg">
                    <h2 class="text-white text-xl font-bold mb-2">Total  Comments</h2>
                    <p class="text-black font-bold text-xl">{{ data.comments ? data.comments : 0 }}</p>
                    <span class="text-white text-xl"></span>
                </div>
                <div style="background-color: #4CAF50;" class="p-6 rounded-lg shadow-lg">
                    <h2 class="text-white text-xl font-bold mb-2">Total Votes</h2>
                    <p class="text-black font-bold text-xl">{{ data.votes }}</p>
                    <span class="text-white text-xl"></span>
                </div>
                <div style="background-color: #00BFFF;" class="p-6 rounded-lg shadow-lg">
                    <h2 class="text-white text-xl font-bold mb-2">Total Users</h2>
                    <p class="text-black font-bold text-xl">{{ data.users }}</p>
                    <span class="text-white text-xl"></span>
                </div>

            </div>
           </div>

    </template>

    <script>
    import axios from "axios";
    import Navigation from "../Layouts/Navigation.vue";
    export default {
        data() {
            return {
                currentUser:"",
                data:"",
            };
        },
        components(){
            Navigation
        },
        methods: {
            getCurrentUser(){
                const url = process.env.MIX_ADMIN_APP_URL + '/user';
                axios.get(url).then((res) => {
                    this.currentUser = res.data;
                    localStorage.setItem('userRole',res.data.role);
                });
            },
            getAllData(){
                const url = process.env.MIX_ADMIN_APP_URL + '/get-all-data';
                axios.get(url).then((res) => {
                    this.data = res.data;
                });
            }
        },
        created() {
            this.getCurrentUser();
            this.getAllData();
        },

    };
    </script>
