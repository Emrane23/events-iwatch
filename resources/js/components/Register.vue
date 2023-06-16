<template>
  <div class="login">
    <div class="row h-100 align-items-center">
      <div class="col-12 col-md-6 offset-md-3">
        <div class="card shadow sm">
          <div class="card-body">
            <h3 class="text-center">S’inscrire</h3>
            <hr />
            <form
              action="javascript:void(0)"
              @submit="register"
              class="row"
              method="post"
            >
              <!-- <div
                class="col-12"
                v-if="Object.keys(validationErrors).length > 0"
              >
                <div class="alert alert-danger">
                  <ul class="mb-0">
                    <li v-for="(value, key) in validationErrors" :key="key">
                      {{ value[0] }}
                    </li>
                  </ul>
                </div>
              </div> -->
              <div class="form-group col-6">
                <label for="name" class="font-weight-bold">Nom complet</label>
                <input
                  type="text"
                  name="name"
                  v-model="name"
                  id="name"
                  placeholder="Ex : Emrane Klaai"
                  :class="['form-control', errors.name ? 'is-invalid' : '']"
                />
                <div v-if="errors.name" class="invalid-feedback">
                  {{ errors.name[0] }}
                </div>
              </div>
              <div class="form-group col-6">
                <label for="phone" class="font-weight-bold">Télephone</label>
                <input
                  type="text"
                  name="phone"
                  v-model="phone"
                  id="phone"
                  placeholder="Ex: 88888888"
                  :class="['form-control', errors.phone ? 'is-invalid' : '']"
                />
                <div v-if="errors.phone" class="invalid-feedback">
                  {{ errors.phone[0] }}
                </div>
              </div>
              <div class="form-group col-6">
                <label for="sexe" class="font-weight-bold">Sex</label>
                <select
                  :class="['form-select', errors.sexe ? 'is-invalid' : '']"
                  v-model="sexe"
                  id="sexe"
                >
                  <option selected disabled value="">Choisir...</option>
                  <option value="Homme">Homme</option>
                  <option value="Femme">Femme</option>
                  <option value="Autre">Autre</option>
                </select>
                <div v-if="errors.sexe" class="invalid-feedback">
                  {{ errors.sexe[0] }}
                </div>
              </div>
              <div class="form-group col-6 ">
                <label for="email" class="font-weight-bold">Email</label>
                <input
                  type="text"
                  name="email"
                  v-model="email"
                  id="email"
                  placeholder="Ex: exemple@exemple.com"
                  :class="['form-control', errors.email ? 'is-invalid' : '']"
                />
                <div v-if="errors.email" class="invalid-feedback">
                  {{ errors.email[0] }}
                </div>
              </div>
              <div class="form-group col-6">
                <label for="password" class="font-weight-bold"
                  >Mot de passe</label
                >
                <input
                  type="password"
                  name="password"
                  v-model="password"
                  id="password"
                  placeholder="Mot de passe"
                  :class="['form-control', errors.password ? 'is-invalid' : '']"
                />
                <div v-if="errors.password" class="invalid-feedback">
                  {{ errors.password[0] }}
                </div>
              </div>
              <div class="form-group col-6">
                <label for="password_confirmation" class="font-weight-bold"
                  >Confirmé</label
                >
                <input
                  type="password"
                  name="password_confirmation"
                  v-model="password_confirmation"
                  id="password_confirmation"
                  placeholder="Confirmé mot de passe"
                  class="form-control"
                />
              </div>
              <div class="text-center">
                <div class="col-12 mb-2">
                  <button
                    type="submit"
                    :disabled="processing"
                    class="btn btn-primary btn-block"
                  >
                    {{ processing ? "Please wait" : "S’inscrire" }}
                  </button>
                </div>

              </div>
              <div class="text-center">
                <label
                  >Vous avez déjà un compte?
                  <router-link :to="{ name: 'login' }"
                    >Connectez-vous!</router-link
                  ></label
                >
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import { toast } from "vue3-toastify";

export default {
  name: "register",
  data() {
    return {
        name: "",
        email: "",
        password: "",
        errors: [],
        password_confirmation: "",
        sexe: "",
        phone: "",
        occupation: "",
        age: "",
      validationErrors: {},
      processing: false,
    };
  },
  methods: {
    async register() {
      this.processing = true;
      let { name, email, sexe, phone, occupation, age,password,password_confirmation } = this;

      await axios
        .post("api/register", { name, email, sexe, phone, occupation, age,password,password_confirmation })
        .then((response) => {
          console.log(response.data.token);
          this.errors = [];
          this.$store.dispatch("register", response.data.token);
          toast.success(response.data.message, {
            autoClose: 2000,
          });
          setTimeout(() => {
            window.location.href = "/profile";
          }, "3000");
        })
        .catch(({ response }) => {
          if (response.status === 422) {
            this.errors = response.data.errors;
          } else {
            this.errors = {};
            // alert("successfully");
          }
        })
        .finally(() => {
          this.processing = false;
        });
    },
  },
};
</script>

<style>
.register {
  margin: auto;
  padding: 50px;
  font-family: "Avenir", sans-serif;
  color: #33475b;
}
</style>