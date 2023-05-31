import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import store from './store'
import router from './router'
import { NeshanMapLeaflet } from 'vuejs-neshan-map-leaflet'

createApp(App).use(store).use(router).use(NeshanMapLeaflet).mount('#app')
