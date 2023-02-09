<template>
    <div>
      <div class="mb">
        Qr Dropzone
      </div>
      <QrDropzone class="dropzone mb" @decode="onDecode">
        Drop image here.
      </QrDropzone>
      <div class="result">
        Result: {{data}}
      </div>
    </div>
  </template>
  
  <script>
  import { defineComponent, reactive, toRefs } from 'vue';
  import   {QrDropzone}   from 'vue3-qr-reader'
  export default defineComponent({
    name: 'QrDropzoneExample',
    components: {
      QrDropzone
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
  
  <style scoped>
  .dropzone {
    height: 100px; 
    background: lightgray;
    display: flex;
    justify-content: center;
    align-items: center;
    color: gray;
  }
  </style>