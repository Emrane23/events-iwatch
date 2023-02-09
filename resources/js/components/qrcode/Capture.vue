<template>
    <div>
      <div class="mb">
        Qr Capture
      </div>
      <QrCapture @decode="onDecode" class="mb"></QrCapture>
      <div class="result">
        Result: {{data}}
      </div>
    </div>
  </template>
  
  <script>
  import { defineComponent, reactive, toRefs } from 'vue';
  import  {QrCapture}  from 'vue3-qr-reader';
  export default defineComponent({
    name: 'QrCaptureExample',
    components: {
      QrCapture
    },
    setup() {
      const state = reactive({
        data: null
      })
      function onDecode(data) {
        state.data = data
      }
      return {
        ...toRefs(state),
        onDecode
      }
    }
  });
  </script>