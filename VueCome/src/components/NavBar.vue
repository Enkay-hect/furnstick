<template>
    <div>
        <div class="navs">
            <div>
                <router-link to="/">
                    <h1>Dashboard</h1>
                </router-link>
            </div>

            <div>
                <router-link to="/Products">
                    <h1>Products</h1>
                </router-link>
            </div>

            <h2>Welcome {{ firstName }} </h2>

            <a @click="logout()" :style="{cursor: 'pointer'}">Logout</a>

            <router-link to="/updateprofile">Update Profile</router-link>

            <LD />
        </div>

         <slot>

        </slot>
    </div>

</template>

<script setup>
import LD from '../components/lightdark.vue'

import {computed} from 'vue'
import {RouterLink, useRouter, useRoute} from 'vue-router'

import store from '../store';


const username = computed(()=>{
        return store.state.user.data.name
    })
    const splitFullname = username.value.split(' ');
    const firstName = splitFullname[0];

    console.log(store.state.user.data.name)



    const router = useRouter();


    function logout(){
        store.commit("logout");
        router.push({
            name: 'login',
        });
    }

</script>

<style scoped>

    .navs{
        display: flex;
        justify-content: space-evenly;
        padding-top: 1rem;
    }

</style>

