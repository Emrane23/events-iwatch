import { createApp } from 'vue';
import { createStore } from 'vuex';
import { setCurrentLanguage,getCurrentLanguage } from '../utils';


const store = createStore({
    state: {
        activeLanguage: getCurrentLanguage(),
        loading: false ,
        params: '',
        userToken: null,
        user: null,
    },
    getters: {
        activeLanguage(state) {
            return state.activeLanguage;
        },
        isLogged(state) {
            return !!state.userToken
        },
        isAdmin(state) {
            if (state.user) {
                return state.user.is_admin
            }
            return null;
        },
    },
    mutations: {
        changeLang(state, payload) {
            state.activeLanguage = payload;
            setCurrentLanguage(payload);
        },
        setLoading(state,value){
            state.loading = value ;
        },
        setParams(state,value){
            state.params = value;
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
            state.user = user
            Echo.connector.pusher.config.auth.headers.Authorization = `Bearer ${state.userToken}`;
        }
    },
    actions: {
        setLang({ commit }, payload) {
            commit('changeLang', payload)

        }
    },
    modules: {

    }
});

export default store;


