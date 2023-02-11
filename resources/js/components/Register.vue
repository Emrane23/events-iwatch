<template>
  <div class="login">
    <div class="row h-100 align-items-center">
      <div class="col-12 col-md-6 offset-md-3">
        <div class="card shadow sm">
          <div class="card-body">
            <h1 class="text-center">Register</h1>
            <hr />
            <form
              action="javascript:void(0)"
              @submit="register"
              class="row"
              method="post"
            >
              <div
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
              </div>
              <div class="form-group col-12">
                <label for="name" class="font-weight-bold">Name</label>
                <input
                  type="text"
                  name="name"
                  v-model="user.name"
                  id="name"
                  placeholder="Enter name"
                  class="form-control"
                />
              </div>
              <div class="form-group col-12 my-2">
                <label for="email" class="font-weight-bold">Email</label>
                <input
                  type="text"
                  name="email"
                  v-model="user.email"
                  id="email"
                  placeholder="Enter Email"
                  class="form-control"
                />
              </div>
              <div class="form-group col-12">
                <label for="password" class="font-weight-bold">Password</label>
                <input
                  type="password"
                  name="password"
                  v-model="user.password"
                  id="password"
                  placeholder="Enter Password"
                  class="form-control"
                />
              </div>

              <div class="col-12 mb-2">
                <button
                  type="submit"
                  :disabled="processing"
                  class="btn btn-primary btn-block"
                >
                  {{ processing ? "Please wait" : "Register" }}
                </button>
              </div>
              <div class="col-12 text-center">
                <label
                  >Already have an account?
                  <router-link :to="{ name: 'login' }"
                    >Login Now!</router-link
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
export default {
  name: "register",
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
      },
      validationErrors: {},
      processing: false,
    };
  },
  methods: {
    async register() {
      this.processing = true;

      await axios
        .post("api/register", this.user)
        .then((response) => {
          console.log(response.data.token);
          this.validationErrors = {};
          this.$store.dispatch("register", response.data.token);
        })
        .catch(({ response }) => {
          if (response.status === 422) {
            this.validationErrors = response.data.errors;
          } else {
            this.validationErrors = {};
            alert("successfully");
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