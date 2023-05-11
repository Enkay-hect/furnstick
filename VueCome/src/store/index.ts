import {createStore} from 'vuex'
import persistState from "vuex-persist"
import axiosClient from '../axios';


const toLocal = new persistState({
    key: "id",
    storage : window.localStorage
})

const store = createStore({
    state: {
        user: {
            data:{},
            token: sessionStorage.getItem('TOKEN'),
        },

    },

    getters: {},

    actions: {

        register({commit}, user){
            return axiosClient.post('/register', user)
            .then(({data})=> {
                commit('setUser', data);
                return data
            })
        },

        login({commit}, user){
            return axiosClient.post('/login', user)
            .then(({data})=> {
                commit('setUser', data);
                return data
            })
        }
    },

    mutations:{
        logout: (state)=>{
            state.user.token = null;
            state.user.data = {};
        },
        setUser: (state, userData)=>{
            state.user.token = userData.token;
            state.user.data = userData.user;
            sessionStorage.setItem('TOKEN', userData.token)
        }

    },

    plugins: [toLocal.plugin],

    modules:{},
})

export default store
