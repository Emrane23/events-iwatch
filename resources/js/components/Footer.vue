<template>
  <div>
    <footer class="bg-light text-center text-lg-start" style="">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © {{moment().format('YYYY')}} Copyright:
    <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
  </div>
  <!-- Copyright -->
</footer>
  </div>
</template>

<script>
import moment from "moment"
export default {
data(){
    return{
        moment: moment
    }
}
}
</script>

<style>

</style>