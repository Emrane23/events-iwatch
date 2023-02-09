<template>
  <div>
    <div class="w-60 mt-2 alert alert-success" v-if="alert" role="alert">
      <i class="fa fa-check" aria-hidden="true"></i>
      Participant saved successfully!
    </div>
    <div class="container my-4 mt-4 mb-4">
      <button
        class="btn btn-info text-white mr-1"
        type="button"
        @click="visible = !visible"
      >
        <i class="fa fa-plus"></i> Add New Card
      </button>

      <a href="id-card.php" class="btn btn-info text-white">
        <i class="fa fa-address-card"></i> Generate ID Card
      </a>

      <div class="mt-4 mb-4" v-if="visible">
        <div class="card card-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity">Participant Name</label>
              <input
                v-model="details.name"
                type="text"
                name="name"
                class="form-control"
                id="inputCity"
              />
            </div>
            <div class="form-group col-md-4">
              <label for="inputState">Panel</label>
              <select name="grade" class="form-control" v-model="details.panel">
                <option selected>Choose...</option>
                <option value="1st">1st</option>
                <option value="2nd">2nd</option>
                <option value="3rd">3rd</option>
                <option value="4th">4th</option>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="inputZip">Date Of Birth</label>
              <input
                type="date"
                name="dob"
                class="form-control"
                v-model="details.dob"
              />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity">Address</label>
              <input
                type="text"
                name="address"
                class="form-control"
                v-model="details.adress"
              />
            </div>
            <div class="form-group col-md-6">
              <label for="inputState">Email</label>
              <input
                type="text"
                name="email"
                class="form-control"
                v-model="details.email"
              />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="id_no"></label>
              <input
                class="form-control"
                id="id_no"
                name="id_no"
                v-model="details.cin"
              />
            </div>
            <div class="form-group col-md-3">
              <label for="phone">Phone Number</label>
              <input
                class="form-control"
                id="phone"
                name="phone"
                v-model="details.phone"
              />
            </div>
            <!-- <div class="form-group col-md-4">
                        <label for="photo">Photo</label>
                        <input type="file" name="image" />
                    </div> -->
          </div>

          <button
            @click="saveParticipant"
            type="submit"
            :disabled="loading"
            class="btn btn-info text-white"
          >
          <div v-if="loading" class="spinner-border spinner-border-sm"></div>
           <template v-else><i class="fa fa-plus"></i> Add Card</template> 
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
    return {
      visible: false,
      alert: false,
      loading: false,
      details: {
        name: "",
        dob: "",
        adress: "",
        email: "",
        cin: "",
        phone: "",
      },
    };
  },
  components: {
    
  },
  methods: {
    async saveParticipant() {
      this.loading = true;
      axios
        .post("api/participant", this.details)
        .then((res) => {
          if (res.data.status == "error") {
            // this.errors = res.data.errors;
            this.loading = false;
          } else if (res.data.status == "success") {
            // this.errors = [];
            this.loading = false;
            this.details = {
              email: "",
              name: "",
              dob: "",
              phone: "",
              cin: "",
              adress: "",
            };
            this.alert = true;
            setTimeout(() => {
              this.alert = false;
            }, 3000);
            
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
}
</script>

<style>

</style>