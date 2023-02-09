import { createRouter, createWebHistory } from "vue-router";
import ScanQrComponent from "../components/ScanQrComponent.vue";
import GlobalComponent from "../components/GlobalComponent.vue";
import AddParticipantComponent from "../components/AddParticipantComponent.vue";
import NotFoundComponent from "../components/NotFoundComponent.vue";
import Login from "../components/Login.vue";



const routes = [
    {
        path: "/",
        name: "home",
        component: AddParticipantComponent,
    },
    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/qrscan",
        name: "qrscan",
        component: ScanQrComponent,
    },
    {
        path:'/:pathMatch(.*)' , 
        component: NotFoundComponent,
        name: 'NotFoundComponent'
    },
    
    
];


const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;
