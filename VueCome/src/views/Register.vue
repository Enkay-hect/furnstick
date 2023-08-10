<template>
    <div>
        <GuestLayout title="Sign up to XYZ">

            <form class="mt-8 space-y-6" @submit='register'>
                <div v-if="errorMsg" :style="{color: 'red'}">
                    {{ errorMsg }}
                </div>
             <input type="hidden" name="remember" value="true" />
                <div class="-space-y-px rounded-md shadow-sm">
                    <div>
                        <label for="name" class="sr-only">Name</label>
                        <input v-model="user.name" id="name" name="name" type="text" required class="relative block w-full rounded-t-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Name" />
                    </div>
                    <div>
                        <label for="email-address" class="sr-only">Email address</label>
                        <input v-model="user.email" id="email-address" name="email" type="email" autocomplete="email" required class="relative block w-full border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Email address" />
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input v-model="user.password" id="password" name="password" type="password" autocomplete="current-password" required class="relative block w-full  border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Password" />
                    </div>
                    <div>
                        <label for="password_confirmation" class="sr-only">Password</label>
                        <input v-model="user.password_confirmation" id="password_confirmation" name="password" type="password" autocomplete="current-password" required class="relative block w-full rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Password" />
                    </div>
                </div>



                <div>
                    <button type="submit" class="group relative flex w-full justify-center rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
                    </span>
                        Sign up
                    </button>
                </div>

                <div>
                    <div type="submit" class="group relative flex w-full justify-center rounded-md bg-gray-600 py-2 px-3 text-sm font-semibold text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 hover:bg-gray-600" >
                    <!-- <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
                    </span> -->
                        <h4 class="">Already have an account? <router-link to="/login" class="text-indigo-400">Sign in</router-link></h4>
                    </div>

                </div>

                </form>
                    <div>
                    </div>
        </GuestLayout>
    </div>

</template>

<script setup lang="ts">
import { useRoute, useRouter } from 'vue-router';
import GuestLayout from '../components/GuestLayout.vue';
import store from '../store';
import { ref } from 'vue';


const router = useRouter();
const errorMsg = ref('');

const user = {
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
};

function register(ev: { preventDefault: () => void; }){
    ev.preventDefault();
    store
        .dispatch('register', user)
        .then((res)=> {
            router.push({
                name: 'login'
            })
    })

}


</script>

<style scoped>

</style>
