import { createRouter, createWebHistory } from "vue-router";
import ScanQrComponent from "../components/ScanQrComponent.vue";
import GlobalComponent from "../components/GlobalComponent.vue";
// import AddParticipantComponent from "../components/AddParticipantComponent.vue";
import NotFoundComponent from "../components/NotFoundComponent.vue";
import Login from "../components/Login.vue";
import Register from "../components/Register.vue";
import Home from "../components/Home.vue";
import Contact from "../components/Contact.vue";
import Profil from "../components/Profile.vue";
import ForgotPassword from "../components/ForgotPassword.vue";
import ResetPasswordForm from "../components/ResetPasswordForm.vue";
import Calendar from "../components/EventsCalendar.vue";
import NProgress from 'nprogress';
import store from "../store";



const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
        meta: {
            middleware: "accessible",
            title: `Home`
        }
    },
    {
        path: '/reset-password',
        name: 'reset-password',
        component: ForgotPassword,
        meta: {
            middleware: "guest",
            title: `Forgot password`
        }
    },
    {
        path: '/reset-password/:token',
        name: 'reset-password-form',
        component: ResetPasswordForm,
        meta: {
            middleware: "guest",
            title: `Reset password`
        }
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },
    {
        path: "/register",
        name: "register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },
    {
        path: "/contact",
        name: "contact",
        component: Contact,
        meta: {
            middleware: "protected",
            title: `Contact`
        }
    },
    {
        path: "/profile",
        name: "profile",
        component: Profil,
        meta: {
            middleware: "protected",
            title: `profile`
        }
    },
    {
        path: "/qrscan",
        name: "qrscan",
        component: ScanQrComponent,
        meta: {
            middleware: "accessible",
            title: `participation`
        }
    },
    {
        path: "/calendar",
        name: "calendar",
        component:Calendar ,
        meta: {
            middleware: "accessible",
            title: `Events calendar`
        }
    },
    // {
    //     path:'/:pathMatch(.*)' , 
    //     component: NotFoundComponent,
    //     name: 'NotFoundComponent',
    //     meta: {
    //         middleware: "accessible",
    //         title: `404`
    //     }
    // },


];


const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    if (to.name) {
        // Start the route progress bar.
        NProgress.start()
    }
    document.title = to.meta.title
    NProgress.start()
    if (to.meta.middleware == "accessible") {
        next()
    }
    if (to.meta.middleware == "guest") {
        if (store.state.userToken) {
            store.commit("setAlert", ["Vous êtes déjà connecté!", "success"])
            next({ name: "home" })
        }
        next()
    } else {
        if (to.meta.middleware == "protected") {
            const setUser = await store.dispatch('getUser').then((response) => {

                if (store.state.userToken && store.state.user.roles.length < 1) {
                    next()
                } else {
                    if (!store.state.userToken) {
                        store.commit("setAlert", ["Désolé, vous devez d'abord vous connecter!", "warning"])
                        next({ name: "login" })
                    } else if (to.meta.middleware == "protected" && store.state.user.roles.length > 0) {
                        store.commit("setAlert", ["Désolé, vous n'êtes pas autorisé à accéder à la page requise!", "danger"])
                        next({ name: "home" })
                    }
                }

            }).catch(() => {
                store.commit("setAlert", ["Désolé, vous devez d'abord vous connecter!", "warning"])
                next({ name: "login" })
            });
        }

    }
})

router.afterEach(() => {
    // Complete the animation of the route progress bar.
    NProgress.done()
})

export default router;
