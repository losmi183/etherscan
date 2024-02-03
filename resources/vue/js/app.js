import './bootstrap';
import '../plugins'

import { createApp } from 'vue'
import Main from '../Main.vue'

import router from '../router'
import vuetify from '../plugins/vuetify' // TODO: Load just needed components and directives from vuetify
import pinia from '../plugins/pinia'

createApp(Main)
.use(vuetify)
.use(pinia)
.use(router)
.mount("#app")