import Vue from 'vue'
import Router from 'vue-router'
import DashboardPage from './pages/DashboardPage.vue'
import CheckRoomsPage from './pages/CheckRoomsPage.vue'
import RoomsPage from './pages/RoomsPage.vue'
import NotesPage from './pages/NotesPage.vue'

Vue.use(Router)

const router = () => {
    return new Router ({
        routes: [
            {
                path: '*',
                component: DashboardPage
            },
            {
                path: '/',
                name: 'dashboard',
                component: DashboardPage
            },
            {
                path: '/home',
                name: 'home',
                component: DashboardPage
            },
            {
                path: '/check-rooms',
                name: 'check-rooms',
                component: CheckRoomsPage
            },
            {
                path: '/notes',
                name: 'notes',
                component: NotesPage
            },
            {
                path: '/rooms',
                name: 'rooms',
                component: RoomsPage
            }
        ]
    })
}

export const makeRouter = () => {
    return router()
}
