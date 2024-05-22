import Vue from 'vue'
import VueRouter from 'vue-router'

// Importa los componentes de tus páginas
import LoginPage from '~/pages/index.vue'
import HomePage from '~/pages/home/index.vue'

Vue.use(VueRouter)

// Define las rutas de tu aplicación
const routes = [
  {
    path: '/',
    component: LoginPage
  },
  {
    path: '/home',
    component: HomePage,
    meta: { requiresAuth: true } // Ruta protegida
  }
]

// Crea el router con las rutas definidas
const router = new VueRouter({
  mode: 'history',
  routes
})

// Middleware para proteger rutas que requieren autenticación
router.beforeEach((to, from, next) => {
  if (to.matched.some(route => route.meta.requiresAuth)) {
    // Verifica si el usuario está autenticado, de lo contrario redirige a la página de login
    if (!Vue.$auth.loggedIn) {
      next('/')
    } else {
      next()
    }
  } else {
    next()
  }
})

export default router
