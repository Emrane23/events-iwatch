<template>
    <div>
      <div class="mb">
        Qr Stream
      </div>
      <div class="center stream">
        <QrStream @decode="onDecode" class="mb">
          <div style="color: red;" class="frame"></div>
        </QrStream>
      </div>
      <div class="result">
        Result: {{data}}
      </div>
    </div>
  </template>
  
  <script>
  import { defineComponent, reactive, toRefs } from 'vue';
  import { QrStream, QrCapture, QrDropzone } from 'vue3-qr-reader';
  export default defineComponent({
    name: 'QrStreamExample',
    components: {
      QrStream
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
    watch: {
      data: function(data) {
          //do something when the data changes.
          if (data) {
              console.log('qrcode changed !');;
          }
      }
  }
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