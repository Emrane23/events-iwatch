<template>
  <div>
    <div class="container my-4 mt-4 mb-4">
      <button
        class="btn btn-primary text-white mr-1"
        type="button"
        @click="visible = !visible"
      >
        <i class="fa fa-plus"></i> Créé un participant
      </button>

      <button class="btn btn-primary text-white" @click="qrImage()">
        <i class="fa fa-qrcode" aria-hidden="true"></i> Enregistrer Avec fichier
        QrCode
      </button>

      <div class="mt-4 mb-4" v-if="visible">
        <div class="card card-body">
          <form action="javascript:void(0)" class="row" method="post">
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Nom complet</label>
                  <input
                    v-model="name"
                    type="text"
                    :class="['form-control', errors.name ? 'is-invalid' : '']"
                    id="inputPassword4"
                    placeholder="Nom"
                  />
                  <div
                    v-if="errors.name"
                    class="invalid-feedback"
                  >
                    {{ errors.name[0] }}</div
                  >
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Email</label>
                  <input
                    v-model="email"
                    type="email"
                    :class="['form-control', errors.email ? 'is-invalid' : '']"
                    id="inputEmail4"
                    placeholder="Email"
                  />
                  <div
                    v-if="errors.email"
                    class="invalid-feedback"
                    >{{ errors.email[0] }}
                </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputPro">Profession</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="occupation"
                    id="inputPro"
                    placeholder="Profession"
                  />
                </div>
                <div class="form-group col-md-6">
                  <label for="inputsex">Sexe</label>
                  <select
                    id="inputsex"
                    :class="['form-select', errors.sexe ? 'is-invalid' : '']"
                    v-model="sexe"
                  >
                    <option disabled selected value="">Choisir...</option>
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                    <option value="Autre">Autre</option>
                  </select>
                  <div
                    v-if="errors.sexe"
                    class="invalid-feedback"
                  >{{ errors.sexe[0] }}
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputCity">Télephone</label>
                  <input
                    type="text"
                    v-model="phone"
                    class="form-control"
                    id="inputCity"
                    placeholder="Télephone"
                  />
                </div>
                <div class="form-group col-md-3">
                  <label for="inputAge">Âge</label>
                  <input
                    type="number"
                    v-model="age"
                    class="form-control"
                    id="inputAge"
                    placeholder="Âge"
                  />
                </div>
              </div>
              <div class="form-group col-md-3" v-if="qrcode">
                <img
                  width="130"
                  height="130"
                  :src="'/temp/' + qrcode"
                  class="img-thumbnail img-fluid"
                  alt=""
                />
              </div>
              <button
                @click="saveParticipant"
                type="submit"
                :disabled="loading"
                class="btn btn-primary text-white"
              >
                <div
                  v-if="loading"
                  class="spinner-border spinner-border-sm"
                ></div>
                <template v-else><i class="fa fa-plus"></i> Add Card</template>
              </button>
            </div>
          </form>
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
      visible: false,
      qrcode: false,
      alert: false,
      loading: false,
      qrcode: null,
      name: "",
      email: "",
      errors: [],
      sexe: "",
      phone: "",
      occupation: "",
      age: "",
      moderator: localStorage.getItem("userToken"),
    };
  },
  components: {},
  methods: {
    qrImage() {
      this.$emit("qrImage", (this.qrcode = !this.qrcode));
    },
    async saveParticipant() {
      this.loading = true;
      let { name, email, sexe, phone, occupation, age, moderator } = this;
      axios
        .post("api/register", {
          name,
          email,
          sexe,
          phone,
          occupation,
          age,
          moderator,
        })
        .then((res) => {
         if (res.data.status == "success") {
            this.errors = [];

            this.loading = false;
            (this.name = ""),
              (this.email = ""),
              (this.sexe = ""),
              (this.phone = ""),
              (this.occupation = ""),
              (this.age = ""),
              (this.qrcode = res.data.qr_code),
              toast.success(res.data.message, {
                autoClose: 3000,
              });
            setTimeout(() => {
              this.forceFileDownload(res.data.qr_code);
            }, 4000);
          }
        })
        .catch(({ response })=> {
          this.errors = response.data.errors;
            this.loading = false;
        });
    },

    forceFileDownload(file) {
      const url = window.location.origin + "/temp/" + file;
      const link = document.createElement("a");
      link.href = url;
      link.setAttribute("download", file);
      document.body.appendChild(link);
      link.click();
    },
  },
};
</script>

<style>
</style>