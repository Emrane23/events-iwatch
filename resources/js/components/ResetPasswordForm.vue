<template>
  <div class="login">
    <div class="row h-100 align-items-center">
      <div class="col-12 col-md-6 offset-md-3">
        <div class="card shadow sm">
          <div class="card-body">
            <h3 class="text-center">Nouveau mot de passe</h3>
            <hr />
            <form
              autocomplete="off"
              @submit.prevent="resetPassword"
              class="row"
              method="post"
            >
              <div class="form-group col-12">
                <label for="email" class="font-weight-bold">Email</label>
                <input
                  type="text"
                  v-model="email"
                  name="email"
                  id="email"
                  :class="['form-control', errors.email ? 'is-invalid' : '']"
                />
                <div v-if="errors.email" class="invalid-feedback">
                  {{ errors.email[0] }}
                </div>
              </div>
              <div class="form-group col-12 my-2">
                <label for="password" class="font-weight-bold"
                  >Nouveau mot de passe</label
                >
                <input
                  type="password"
                  v-model="password"
                  name="password"
                  id="password"
                  :class="['form-control', errors.password ? 'is-invalid' : '']"
                />
                <div v-if="errors.password" class="invalid-feedback">
                  {{ errors.password[0] }}
                </div>
              </div>
              <div class="form-group col-12 my-2">
                <label for="password" class="font-weight-bold"
                  >Confimré mot de passe</label
                >
                <input
                  type="password"
                  v-model="password_confirmation"
                  name="password_confirmation"
                  id="password_confirmation"
                  class="form-control"
                />
              </div>
              <div class="col-12 mb-2">
                <button
                  type="submit"
                  :disabled="processing"
                  class="btn btn-primary btn-block"
                >
                  <div
                    v-if="processing"
                    class="spinner-border spinner-border-sm"
                  ></div>
                  <template v-else>Modifier</template>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
import { toast } from "vue3-toastify";

export default {
  data() {
    return {
      token: null,
      email: null,
      password: null,
      password_confirmation: null,
      errors: [],
      processing: false,
    };
  },
  methods: {
    resetPassword() {
      this.processing = true;
      axios
        .post("/api/reset/password", {
          token: this.$route.params.token,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
        })
        .then((response) => {
          this.processing = false;
          toast.success(response.data.message, {
            autoClose: 3000,
          });
          setTimeout(() => {
            window.location.href = "/login";
          }, "3000");
        })
        .catch(({ response }) => {
          if (response.status === 422) {
            this.processing = false;
            this.errors = response.data.errors;
          } else if (response.status === 498) {
            this.errors = [];
            this.processing = false;
            toast.error(response.data.message, {
              autoClose: 3000,
            });
          } else {
            this.errors = [];
            alert("error 500! something went wrong *.* ");
          }
        });
    },
  },
};
</script>