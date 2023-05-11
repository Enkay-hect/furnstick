<template>
    <div>
        <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-md space-y-8">
                <div>
                    <h2 class="mt-6 text-center text-3xl font-bold tracking-tight ">{{ title }}</h2>
                    <!-- {{ body }} -->
                    <slot></slot>
                    <!-- <router-view></router-view> -->
                </div>
            </div>
        </div>
    </div>
    <div>

    </div>
</template>

<script setup lang="ts">
    // import { defineProps } from 'vue';
import { RouterView } from 'vue-router';

    const {title, body} = defineProps(['title', 'body'])

</script>

<style scoped>

</style>
