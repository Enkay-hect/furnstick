<template>
    <GuestLayout title="Reset your Password">
        <form class="mt-8 space-y-6" action="#" method="POST">
          <input type="hidden" name="remember" value="true" />
          <div class="-space-y-px rounded-md shadow-sm">
            <div>
                <label for="npassword" class="sr-only">New Password</label>
              <input id="npassword" name="npassword" type="password" autocomplete="current-password" required class="relative block w-full rounded-t-md rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="New Password" />
            </div>
            <div>
              <label for="rpassword" class="sr-only">Repeat Password</label>
              <input id="rpassword" name="rpassword" type="password" autocomplete="current-password" required class="relative block w-full rounded-t-md rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="RepeatPassword" />
            </div>
          </div>

          <div class="flex items-center justify-between">
            <div class="flex items-center">
                <router-link to="/Login" class="font-medium text-indigo-600 hover:text-indigo-500">Go back to Login</router-link>
            </div>
          </div>

          <div>
            <button type="submit" class="group relative flex w-full justify-center rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
                </span>

                Submit
            </button>
          </div>
        </form>
    </GuestLayout>
  </template>

  <script setup lang="ts">
    import { LockClosedIcon } from '@heroicons/vue/20/solid'
    import {useRoute, RouterLink} from 'vue-router'
    import GuestLayout from '../components/GuestLayout.vue';
  </script>

<style scoped>

</style>
