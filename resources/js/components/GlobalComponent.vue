<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="/images/mac2023-02.png" alt="..." height="36" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li :class="['nav-item', this.$route.path == '/' ? 'active' : '']">
            <router-link class="nav-link" to="/">Dashboard</router-link>
          </li>
          <li class="nav-item" v-if="isModerator">
            <router-link
              to="/qrscan"
              :class="[
                'nav-link',
                this.$route.path == '/qrscan' ? 'active' : '',
              ]"
              >Enregistrer les participant
            </router-link>
          </li>

          <template v-if="isLogged">
            <li class="nav-item" v-if="!isModerator">
            <router-link
              to="/contact"
              :class="[
                'nav-link',
                this.$route.path == '/contact' ? 'active' : '',
              ]"
              >Contact
            </router-link>
          </li>
            <li class="nav-item">
            <router-link
              to="/calendar"
              :class="[
                'nav-link',
                this.$route.path == '/calendar' ? 'active' : '',
              ]"
              >Calendrier
            </router-link>
          </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
              <i class="fa fa-user" aria-hidden="true" ></i> {{ currentUserLogged?.name }}
              </a>
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="navbarDropdown"
              >
                <li v-if="!isModerator"><router-link class="dropdown-item" to="/profile" type="button"><i class="fa fa-user" aria-hidden="true" ></i> Profile</router-link></li>
                <li>
                  <hr class="dropdown-divider" v-if="!isModerator" />
                </li>
                <li><a class="dropdown-item" type="button" @click="Logout()"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
                <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
              </ul>
            </li>
          </template>

          <li
            v-else
            :class="['nav-item', this.$route.path == '/login' ? 'active' : '']"
          >
            <router-link class="nav-link" to="/login">Login </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <a class="navbar-brand" href="#"
      ><img src="assets/images/codingcush-logo.png" alt=""
    /></a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li :class="['nav-item', this.$route.path == '/' ? 'active' : '']">
          <router-link class="nav-link" to="/">Home </router-link>
        </li>
        <li class="nav-item">
          <router-link
            to="/qrscan"
            :class="['nav-link', this.$route.path == '/qrscan' ? 'active' : '']"
            >Participant
          </router-link>
        </li>
        <li :class="['nav-item', this.$route.path == '/login' ? 'active' : '']">
          <router-link class="nav-link" to="/login">Login </router-link>
        </li>
        <li :class="['nav-item', this.$route.path == '/register' ? 'active' : '']">
          <router-link class="nav-link" to="/register">Register </router-link>
        </li>
      </ul>

      <select
        :value="$i18n.locale"
        @change="setLocale($event.target.value)"
        id="locale"
        class="p-1 bg-dark text-white rounded"
      >
        <option v-for="locale in allLocales" :value="locale" :key="locale.id">
          {{ locale }}
        </option>
      </select>
    </div>
  </nav> -->
</template>

<script>
// import AddParticipantComponentVue from './AddParticipantComponent.vue';
import { allLocales, setLocale } from "../i18n";
export default {
  beforeMount() {
    this.updateToken();
  },
  computed: {
    isLogged() {
      return this.$store.getters.isLogged;
    },
    currentUserLogged() {
      return this.$store.getters.currentUserLogged;
    },
    isModerator(){
      return this.$store.getters.isModerator
    }
  },
  mounted() {
    if (this.isLogged && (window.location.pathname != "/contact" || window.location.pathname != "/profile" ) ) {
      this.getUser();
    }
  },
  methods: {
   async getUser() {
     await this.$store.dispatch("getUser");
      // this.user = this.$store.state.user;
    },
    updateToken() {
      let token = JSON.parse(localStorage.getItem("userToken"));
      this.$store.commit("setUserToken", token);
    },
    async Logout() {
      await axios
        .post("/api/logout")
        .then((res) => {
          this.$store.state.userToken = null;
          localStorage.removeItem("userToken");
          window.location.href='/';
          console.log("loged in successfully!");
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>

<style>
</style>