<template>
    <div :class="'w-60 mt-2 alert alert-'+alertMessage[1] " v-if="alertMessage" role="alert">
      <i class="fa fa-check" aria-hidden="true"></i>
      {{ alertMessage[0] }}
    </div>
  <div class="login">
    <div class="row h-100 align-items-center">
      <div class="col-12 col-md-6 offset-md-3">
        <div class="card shadow sm">
          <div class="card-body">
            <h3 class="text-center">Connectez-vous</h3>
            <hr />
            <form action="javascript:void(0)" class="row" method="post">
              <div
                class="col-12"
                v-if="validationErrors"
              >
                <div class="alert alert-danger">
                  <ul class="mb-0">
                    <li >
                      {{ validationErrors}}
                    </li>
                  </ul>
                </div>
              </div>
              <div class="form-group col-12">
                <label for="email" class="font-weight-bold">Email</label>
                <input
                  type="text"
                  v-model="email"
                  name="email"
                  id="email"
                  class="form-control"
                />
              </div>
              <div class="form-group col-12 my-2">
                <label for="password" class="font-weight-bold">Mot de passe</label>
                <input
                  type="password"
                  v-model="password"
                  name="password"
                  id="password"
                  class="form-control"
                />
              </div>
              <div class="col-12 mb-2">
                <button
                  type="submit"
                  :disabled="processing"
                  @click="login"
                  class="btn btn-primary btn-block"
                >
                  <div
                    v-if="processing"
                    class="spinner-border spinner-border-sm"
                  ></div>
                  <template v-else>Se Connecter</template
                  >
                </button>
              </div>
            </form>
              <div class="text-center mb-3">
                  <router-link to="/reset-password">Mot de passe oublié ?</router-link>
              </div>
              <hr class="hr hr-blurry" />
              <div class="text-center">
                Vous n'avez pas de compte? 
                  <router-link to="/register">Créer maintenant!</router-link>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  name: "login",
  data() {
    return {
      email: "",
      password: "",
      validationErrors: '',
      processing: false,
    };
  },
  computed:{
    alertMessage(){
        return this.$store.getters.getAlert ;
    },
    currentUserLogged() {
      return this.$store.getters.currentUserLogged;
    },
  },
  methods: {
    async login() {
      this.processing = true;
      let { email, password } = this;
      await axios.post("/api/login", { email, password }).then((response) => {
        console.log(response.data.user);
          this.$store.commit("setUserToken", response.data.token);    
          this.$store.commit("setUser", response.data.user);
            this.processing = false;
            window.location.href = "/";
            // this.$store.commit("setAlert", `Bienvenue dans notre appliction ${res.data.user.name} !`);
            // console.log(this.$store.getters.user.name);
        })
        .catch(({ response }) => {
            if (response.status === 401) {
                this.processing = false;
                this.validationErrors = response.data.error;
          }else if(response.status === 429){
            this.validationErrors = response.data.error;
          } else {
                this.validationErrors = [];
                alert("error 500! something went wrong *.* ");
          }
        }).finally(()=> {
          // this.$store.commit("setAlert", `Bienvenue dans notre appliction ${this.$store.state.name} !`);
        });
    },
  },
};
</script>
<style >
.login {
  margin: auto;
  padding: 50px;
  font-family: "Avenir", sans-serif;
  color: #33475b;
}
</style>