<template>
  <div id="scancontainer">
    <QrStreamExample class="pb"></QrStreamExample>
  <QrCaptureExample class="pb"></QrCaptureExample>
  </div>
  
  <!-- <QrDropzoneExample class="pb"></QrDropzoneExample> -->
</template>

<script >
import { defineComponent } from 'vue';
import QrCaptureExample from './qrcode/Capture.vue'
import QrStreamExample from './qrcode/Stream.vue'
import QrDropzoneExample from './qrcode/Dropzone.vue'
export default defineComponent({
  name: 'App',
  components: {
    QrCaptureExample,
    QrStreamExample,
    QrDropzoneExample
  },
});
</script>

<style>
#scancontainer {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
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