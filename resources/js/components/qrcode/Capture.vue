<template>
    <div>
      <div class="mb">
        
      </div>
      <QrCapture @decode="onDecode" class="mb"></QrCapture>
      <div class="result" hidden>
        Result: {{data}}
      </div>
    </div>
  </template>
  
  <script>
  import { defineComponent, reactive, toRefs, watch } from 'vue';
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
    },
    methods:{
    //   qrCodeCaptureEvent() {
    //   this.$emit("qrCodeCapture", (this.data));
    // },
    },
    watch:{
      data: function (data, old) {
      if (data) {
        this.$store.commit("setQrCapture", data);
      }
    },
    }

  });
  </script>