<template>
    <!-- <div v-if="is_verified == 2">adsfasdf</div> -->
    <!-- <div v-else><h3>Go and sign up</h3></div> -->



    <div >
        <NavBar>
        </NavBar>
    </div>

    <div>
    <!-- {{ is_verified }} -->
    </div>

</template>

<script setup>
    import NavBar from '../components/NavBar.vue'
    import store from '../store'

    import {computed} from 'vue'


    const verified = computed(()=>{
        return store.state.user.data.is_verified
    })

    let is_verified = verified.value



</script>

<style lang="scss" scoped>

</style>
