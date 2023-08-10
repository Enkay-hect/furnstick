<template>
    <div v-if="is_verified == 0">
        <h2>Go and Verify please <a @click="logout()" :style="{cursor: 'pointer'}"> Login</a></h2>
    </div>

    <div v-else>
        <NavBar>
        </NavBar>
    </div>

    <div>
    </div>

</template>

<script setup>
    import NavBar from '../components/NavBar.vue'
    import store from '../store'

    import {computed, ref} from 'vue'
    import {RouterLink, useRouter, useRoute} from 'vue-router'


    let is_verified = ref()


    is_verified = store.state.user.data.is_verified
    const router = useRouter();

        function logout(){
            store.commit("logout");
            router.push({
                name: 'login',
            });
        }




</script>

<style lang="scss" scoped>

</style>
