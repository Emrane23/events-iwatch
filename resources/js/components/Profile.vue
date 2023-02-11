<template>
  <div class="card"></div>
  <div class="row justify-content-center">
    <div class="col-md-6 text-center mb-4 mt-5">
      <h2 class="heading-section">Profile</h2>
    </div>
  </div>
  <div class="card shadow sm mb-5">
    <form action="javascript:void(0)" class="row" method="post">
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputPassword4">Nom complet</label>
            <input
              v-model="user.name"
              type="text"
              class="form-control"
              id="inputPassword4"
              placeholder="Nom"
            />
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input
              v-model="user.email"
              type="email"
              class="form-control"
              id="inputEmail4"
              placeholder="Email"
            />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputPro">Profession</label>
            <input
              type="text"
              class="form-control"
              v-model="user.occupation"
              id="inputPro"
              placeholder="Profession"
            />
          </div>
          <div class="form-group col-md-6">
            <label for="inputsex">Sexe</label>
            <select
              id="inputsex"
              class="form-control"
              v-model="$store.state.user.sexe"
            >
              <option disabled :selected="user.sexe == null ? true : false">
                Choose...
              </option>
              <option
                value="Homme"
                :selected="user.sexe == 'Homme' ? true : false"
              >
                Homme
              </option>
              <option
                value="Femme"
                :selected="user.sexe == 'Femme' ? true : false"
              >
                Femme
              </option>
              <option
                value="Autre"
                :selected="user.sexe == 'Autre' ? true : false"
              >
                Autre
              </option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity">Télephone</label>
            <input
              type="text"
              v-model="user.phone"
              class="form-control"
              id="inputCity"
              placeholder="Télephone"
            />
          </div>
          <div class="form-group col-md-3">
            <label for="inputAge">Âge</label>
            <input
              type="number"
              v-model="user.age"
              class="form-control"
              id="inputAge"
              placeholder="Âge"
            />
          </div>
          <div class="form-group col-md-3">
            <img
              width="130"
              height="130"
              src="/temp/test57ca366ccfda16be6de473fd21a744d0.png"
              class="img-thumbnail img-fluid"
              alt=""
            />
          </div>
        </div>
        <button
          type="submit"
          class="btn btn-primary"
          :disabled="processing"
          @click="updateProfile"
        >
          <div v-if="processing" class="spinner-border spinner-border-sm"></div>
          <template v-else> Sauvegarder</template>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

export default {
  data() {
    return {
      processing: false,
      oldCredentials: null,
    };
  },
  computed: {
    user() {
      return this.$store.getters.currentUserLogged;
    },
  },
  mounted() {
    if (this.user) {
      localStorage.setItem("oldCredentials", JSON.stringify(this.user));
      this.oldCredentials = localStorage.getItem("oldCredentials");
    }
  },
  methods: {
    async updateProfile() {
      this.processing = true;
      let { name, email, sexe, phone, occupation, age } = this.user;
      await axios
        .post("/api/updateprofile", {
          name,
          email,
          sexe,
          phone,
          occupation,
          age,
        })
        .then((res) => {
          this.processing = false;
          this.$store.commit("setUser", res.data.user);
          toast.success("Votre profile est mettre à jour avec succès!", {
            autoClose: 3000,
          });
        })
        .catch((err) => console.log(err));
      this.body = "";
    },
  },
};
</script>

<style>
</style>