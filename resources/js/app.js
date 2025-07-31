import './bootstrap';


import {createApp} from 'vue'
import { createPinia } from 'pinia'
import App from '../vueTemplate/App.vue'

import router from './routes.js'

const pinia = createPinia()
const app = createApp(App)

app.use(pinia)

createApp(App)
.use(router)
.mount("#app")