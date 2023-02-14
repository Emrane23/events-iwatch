<template>
  <div class="row justify-content-center">
      <div class="col-md-6 text-center mt-5 mb-4">
        <h2 class="heading-section">Enregistrer a l'évenement</h2>
      </div>
    </div>
  <div class="card mb-4 mt-2">
    <div class="card-body">
      <div id="scancontainer">
        <QrStreamExample class="pb"></QrStreamExample>
        <add-participant @qrImage="visible= $event"></add-participant>
        <QrCaptureExample class="pb" v-if="visible"></QrCaptureExample>
      </div>
    </div>
  </div>
  
  <!-- <QrDropzoneExample class="pb"></QrDropzoneExample> -->
</template>

<script >
import { defineComponent } from "vue";
import QrCaptureExample from "./qrcode/Capture.vue";
import QrStreamExample from "./qrcode/Stream.vue";
import QrDropzoneExample from "./qrcode/Dropzone.vue";
export default defineComponent({
  name: "App",
  data(){
    return{
      visible : false,
      qrCodeCapture : null,
    }
    },
  components: {
    QrCaptureExample,
    QrStreamExample,
    QrDropzoneExample,
  },
});
</script>

<style>
#scancontainer {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
.mb {
  margin-bottom: 10px;
}
.center {
  display: flex;
  align-items: center;
  justify-content: center;
}
.result {
  width: 100%;
  text-align: left;
}
</style>