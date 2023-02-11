import { createApp } from 'vue';
import { createStore } from 'vuex';
import { setCurrentLanguage,getCurrentLanguage } from '../utils';


const store = createStore({
    state: {
        activeLanguage: getCurrentLanguage(),
        userToken: localStorage.getItem('userToken') ? localStorage.getItem('userToken') : null,
        user: null,
        alertMessage:[],
    },
    getters: {
        activeLanguage(state) {
            return state.activeLanguage;
        },
        currentUserLogged(state) { 
            if (state.user) {
                return state.user
            }
            return null;
        },
        isLogged(state) {
            return !!state.userToken
        },
        isModerator(state) {
            if (state.user) {
                return state.user.is_admin
            }
            return null;
        },
        getAlert(state){
            if (state.alertMessage) {
                return state.alertMessage[0];
            }
            return null; 
        }
    },
    mutations: {
        changeLang(state, payload) {
            state.activeLanguage = payload;
            setCurrentLanguage(payload);
        },
        setUserToken(state, userToken) {
            state.userToken = userToken;
            localStorage.setItem('userToken', JSON.stringify(userToken));
            axios.defaults.headers.common.Authorization = `Bearer ${userToken}`
        },
        removeUserToken(state) {
            state.userToken = null;
            localStorage.removeItem('userToken')
        },
        setUser(state, user) {
            state.user = user;
            // Echo.connector.pusher.config.auth.headers.Authorization = `Bearer ${state.userToken}`;
        },
        setAlert(state,alert){
            state.alertMessage[0] = alert ;
            setTimeout(() => {
                state.alertMessage = [];
              }, 3000);
        }
        
    },
    actions: {
        setLang({ commit }, payload) {
            commit('changeLang', payload)
        },
        register({ commit }, payload){
            commit('setUserToken',payload)
        },
       async loginUser({commit},parametres){
               
        },
       async getUser({ dispatch, commit }){
          await  axios.get('/api/user')
                .then( res => {
                   commit('setUser',res.data.user);
                })
        }
    },
    modules: {

    }
});

export default store;


