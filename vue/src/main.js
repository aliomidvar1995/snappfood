import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router'
import { NeshanMapLeaflet } from 'vuejs-neshan-map-leaflet'

createApp(App).use(router).use(NeshanMapLeaflet).mount('#app')
