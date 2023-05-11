import { createApp } from 'vue'
import store from './store'
import router from './router'
import './style.css'
import './index.css'
import {VueClipboard} from '@soerenmartius/vue3-clipboard'
import App from './App.vue'

createApp(App).use(VueClipboard).use(store).use(router).mount('#app')
