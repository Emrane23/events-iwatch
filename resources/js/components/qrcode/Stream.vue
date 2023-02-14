<template>
  <div>
    <div class="center stream">
      <QrStream @decode="onDecode" class="mb">
        <div style="color: red" class="frame"></div>
      </QrStream>
    </div>
    <div class="row mt-3 d-flex justify-content-center">
      <div class="form-group col-md-3 ml-3">
        <select
          :class="['form-select', panels_checked.length == 0 && data!= null? 'is-invalid' : '']"
          v-model="selectedEvent"
        >
          <option disabled selected value="">
            Selectionner un évènement
          </option>
          <option v-for="event in events" :key="event.id" :value="event.id">
            {{ event.name }}
          </option>
        </select>
        <div
          v-if="panels_checked.length == 0"
          class="invalid-feedback"
        >
          Vous devez seletionnné minimum un pannel ! 
        </div>
      </div>

      <div class="form-group col-md-6">
        <!-- <select class="form-control" v-if="disable">
          <option value="" selected="" hidden="" disabled="">
            Selectionner un (des) panel(s)
          </option>
          <option v-for="panel in panels" :key="panel.id" :value="panel.id">
            {{ panel.name }}
          </option>
        </select> -->
        <div class="dropdown">
          <button
            class="btn btn-light dropdown-toggle"
            data-toggle="dropdown"
            type="button"
            id="dropdownMenuButton"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
            :disabled="disable"
          >
            <template v-if="panels_checked.length==0">Selectionner un (des) panel(s) </template>
            <template v-else>Panel(s) sélectionné:  {{ panels_checked.length }}</template>
           
          </button>
          <div v-if="loading" class="spinner-border spinner-border-sm ml-3"></div>

          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li v-for="panel in panels" :key="panel.id">
              <a class="dropdown-item" type="button">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    v-model="panels_checked"
                    :value="panel.id"
                    :id="'Checkme' + panel.id"
                  />
                  <label class="form-check-label" :for="'Checkme' + panel.id">{{
                    panel.name
                  }}</label>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="result">Résultat : {{ data }}   
      <button type="button" @click="participateInEvent()" v-if="data && panels_checked.length>0" class="btn btn-success btn-sm ml-3"> <i class="fa fa-check"></i>Participer</button>
    </div>
  </div>
</template>
  
  <script>
import { defineComponent, reactive, toRefs } from "vue";
import { QrStream, QrCapture, QrDropzone } from "vue3-qr-reader";
import { toast } from "vue3-toastify";

export default defineComponent({
  name: "QrStreamExample",
  components: {
    QrStream,
  },
  props: ["qrCodeCapture"],
  data() {
    return {
      loading:false,
      events: null,
      disable: true,
      selectedEvent: null,
      panels: null,
      errors: [],
      validation:'',
      panels_checked: [],
    };
  },
  setup() {
    const state = reactive({
      data: null,
    });
    function onDecode(data) {
      state.data = data;
    }
    return {
      ...toRefs(state),
      onDecode,
    };
  },
  
  mounted() {
    this.getEvents();
  },
  methods: {
     participateInEvent(){
      this.loading = true ;
      let { panels_checked, data } = this;
      axios
            .post("/api/participateinevent", { panels_checked, data })
            .then((res) => {
              if (res.data.status == "error") {
                this.errors = res.data.errors;
                // this.loading = false;
              } else if (res.data.status == "success") {
                // this.loading =false ;
                this.errors = [];
                toast.success(res.data.message, {
                  autoClose: 3000,
                });
              }
            })
            .catch(({ response }) =>
            
              toast.error(response.data.message, {
                autoClose: 3000,
              }),
              // this.loading =false ,
            )
            .finally(() => {
              this.loading = false
              setTimeout(() => {
                this.data = null;
              }, "4000");
            });
    },
    async getEvents() {
      await axios
        .get("/api/getevent")
        .then((res) => {
          this.events = res.data.events;
        })
        .catch((err) => console.log(err));
    },

  },
  watch: {
    selectedEvent: function (query) {
      if (query) {
        axios
          .get(`/api/searchpanel/${query}`)
          .then((res) => {
            this.panels = res.data.panels;
            this.disable = false;
          })
          .catch((err) => console.log(err));
      }
    },

   
  
    // data: function (data, old) {
    //   console.log(old);
    //   if (data) {
    //     let { panels_checked, data } = this;
    //     console.log(data);
    //     if (panels_checked.lenght == 0) {
    //       this.validation = "Vous devez seletionnné minimum un pannel !"
    //     }
    //     if (data != "") {
    //       axios
    //         .post("/api/participateinevent", { panels_checked, data })
    //         .then((res) => {
    //           if (res.data.status == "error") {
    //             this.errors = res.data.errors;
    //             // this.loading = false;
    //           } else if (res.data.status == "success") {
    //             this.errors = [];
    //             toast.success(res.data.message, {
    //               autoClose: 3000,
    //             });
    //           }
    //         })
    //         .catch(({ response }) =>
    //           toast.error(response.data.message, {
    //             autoClose: 3000,
    //           }),
    //         this.errors = [],
    //         )
    //         .finally(() => {
    //           setTimeout(() => {
    //             this.data = "";
    //           }, "4000");
    //         });
    //     }
    //   }
    // },
  },
});
</script>
  
  <style scoped>
.stream {
  max-height: 500px;
  max-width: 500px;
  margin: auto;
}
.frame {
  border-style: solid;
  border-width: 2px;
  border-color: red;
  height: 200px;
  width: 200px;
  position: absolute;
  top: 0px;
  bottom: 0px;
  right: 0px;
  left: 0px;
  margin: auto;
}
</style>