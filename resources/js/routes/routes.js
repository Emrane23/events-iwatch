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

router.beforeEach((to, from, next) => {
    document.title = to.meta.title

    if (to.meta.middleware == "accessible") {
            next() 
    }
    if (to.meta.middleware == "guest") {
        if (store.state.userToken) {
            next({ name: "home" })
        }
        next()
    } else {
        if (to.meta.middleware == "protected" && store.state.userToken) {
            next()
        } else {
            if (to.meta.middleware == "protected" && !store.state.userToken) {
                
                store.commit("setAlert","Désolé, vous devez d'abord vous connecter!")
                next({ name: "login" })
            }
        }
    }
})

export default router;
