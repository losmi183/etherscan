import * as VueRouter from 'vue-router'

import insideLayout from '@/layouts/Inside.vue'
import outsideLayout from '@/layouts/Outside.vue'
// import { trailingSlash } from '@/util/helpers'

import { useAppStore } from '@/stores/AppStore'
import { useUserStore } from '@/stores/userStore'



// const routes = [
//     {
//         path: '/:pathMatch(.*)*',
//         name: '404 Not Found',
//         meta: { layout: insideLayout},
//         component: () => import('@/layouts/Error.vue')
//     }
// ]

const router = VueRouter.createRouter({
  // Provide the history implementation to use. We are using the hash history for simplicity here.
  history: VueRouter.createWebHistory('/cms/'),
//   routes: isAuthenticated ? inside : outside
  routes, // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    const appStore = useAppStore()
    const userStore = useUserStore()
    userStore.userStatus()
    .then((user) => {

    })
    .catch((error) => {
        if(!['Login','Register','Lost Password'].includes(to.name)){
            userStore.refreshJWT()
            .then(() => {
                if(to.matched.length > 0 ){
                    return next()
                }else{
                    next({name:'NotFound'})
                }
            })
            .catch(() => {
                if(error.code == 'ERR_BAD_REQUEST'){
                    next({ name: 'Login' })
                    appStore.alert = {
                        show: true,
                        type: 'error',
                        message: 'Session expired! Please login.'
                    }
                }else{
                    appStore.alert = {
                        show: true,
                        type: 'error',
                        message: error
                    }
                }
            })
        }
        // next({name:'Login'})
    })
    .finally(() => {
        if(to.matched.length > 0 ){
            return next()
        }else{
            next({name:'NotFound'})
        }
    })
})

export default router
