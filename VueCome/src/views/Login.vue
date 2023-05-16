<template>

        <GuestLayout title="Sign into your Account"  >

            <form class="mt-8 space-y-6" @submit="login">
                <div v-if="errorMsg" :style="{color:'red',}">
                    {{ errorMsg }}
                </div>
                <div v-if="msgError" :style="{color:'red',}">
                    {{ msgError }}
                </div>

                <input type="hidden" name="remember" value="true" />
                <div class="-space-y-px rounded-md shadow-sm">
                    <div>
                        <label for="email-address" class="sr-only">Email address</label>
                        <input v-model="user.email" id="email-address" name="email" type="email" autocomplete="email" required class="relative block w-full rounded-t-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Email address" />
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input v-model="user.password" id="password" name="password" type="password" autocomplete="current-password" required class="relative block w-full rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Password" />
                    </div>
                </div>

            <div></div>


            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <!-- <input v-model="user.remember" id="remember-me" name="remember-me" type="" class="" /> -->
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900 dark:text-white"></label>
                </div>

                <div class="text-sm">
                    <router-link to="/RequestPassword" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot your password?</router-link>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative flex w-full justify-center rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
                    </span>
                    Sign in
                </button>

            </div>

            <div>
                <div type="submit" class="group relative flex w-full justify-center rounded-md bg-gray-600 py-2 px-3 text-sm font-semibold text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:bg-gray-600" >
                <!-- <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
                </span> -->
                    <h4 class="">New to XYZ? <router-link to="/register" class="text-indigo-400">Create an Account</router-link></h4>
                </div>
            </div>

            </form>
        </GuestLayout>

  </template>

  <script setup lang="ts">
    import { LockClosedIcon } from '@heroicons/vue/20/solid'
    import {RouterLink, useRouter} from 'vue-router'
    import GuestLayout from '../components/GuestLayout.vue';
    import store from '../store';
    import { ref } from 'vue';

    const space = " "

    const router = useRouter()

    let errorMsg = ref('');
    let msgError = ref('');
    let y = ref('')
    let mytext = ref('')


    const user ={
        email: '',
        password:'',
        remember: false,
    }

    function login(ev){
        ev.preventDefault();
        store.dispatch('login', user)
        .then((res)=> {
            router.push({
                name: 'Dashboard'
            })
        })
        .catch(error => {
                errorMsg.value = error.response.data.message
                msgError.value = error.response.data.error
         })
    }



  </script>

<style scoped>

</style>
