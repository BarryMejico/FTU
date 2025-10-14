import './bootstrap';


import {createApp} from 'vue'
import { createPinia } from 'pinia'
import App from '../vueTemplate/App.vue'

import router from './routes.js'
import { useUi } from '../Store/ui'

const pinia = createPinia()
const app = createApp(App)

app.use(pinia)
app.use(router)

// Mount app
app.mount('#app')

// Router navigation guards for global loader
router.beforeEach((to, from, next) => {
	try {
		const ui = useUi()
		ui.show()
	} catch (e) {
		// ignore if called before pinia is ready
	}
	next()
})

router.afterEach(() => {
	try {
		const ui = useUi()
		// small delay to avoid quick flicker on fast navigations
		setTimeout(() => ui.hide(), 120)
	} catch (e) {}
})