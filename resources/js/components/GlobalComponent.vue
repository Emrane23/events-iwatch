<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-info">
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
      </ul>

      <!-- <select
        :value="$i18n.locale"
        @change="setLocale($event.target.value)"
        id="locale"
        class="p-1 bg-dark text-white rounded"
      >
        <option v-for="locale in allLocales" :value="locale" :key="locale.id">
          {{ locale }}
        </option>
      </select> -->
    </div>
  </nav>

  <!-- <div class="container my-4">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>

    </div> -->
</template>

<script setup>
// import AddParticipantComponentVue from './AddParticipantComponent.vue';
import { allLocales, setLocale } from "../i18n";
</script>

<style>
</style>