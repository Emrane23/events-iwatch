<template>
  <div>

<footer class="text-white text-center text-lg-start" style="background-color: #23242a;">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row mt-4">
      <!--Grid column-->
      <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">À PROPOS DE LA SOCIÉTÉ</h5>

        <p>
          I-techrity la première startup ICT4D en Tunisie. Nous avons enregistré légalement la société pour la matinée. 
          détenue à 100% par <a class="text-white" href="https://www.iwatch.tn/" target="_blank"> l'organisation I WATCH. </a>
        </p>

        <p>
          L'objectif de la création d'iTechrity est de créer des solutions technologiques pour résoudre les problèmes 
          dans notre domaine de travail .
        </p>

        <div class="mt-4">
          <!-- Facebook -->
          <a type="button" class="rounded-circle btn btn-floating btn-warning "><i class="fa fa-facebook"></i></a>
          <!-- Dribbble -->
          <a type="button" class="rounded-circle btn btn-floating btn-warning "><i class="fa fa-dribbble"></i></a>
          <!-- Twitter -->
          <a type="button" class="rounded-circle btn btn-floating btn-warning "><i class="fa fa-twitter"></i></a>
          <!-- Google + -->
          <a type="button" class="rounded-circle btn btn-floating btn-warning "><i class="fa fa-google"></i></a>
          <!-- Linkedin -->
        </div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
        

        <div class="form-outline form-white mb-4">
          
        <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 48.8px;"></div><div class="form-notch-trailing"></div></div></div>

        <ul class="fa-ul" style="margin-left: 1.65em;">
          <li class="mb-3">
            <span class="fa-li"><i class="fa fa-home"></i></span><span class="ms-2">105 Av. Taher Ben Ammar, Tunis</span>
          </li>
          <li class="mb-3">
            <span class="fa-li"><i class="fa fa-envelope"></i></span><span class="ms-2">contact@iwatch.tn</span>
          </li>
          <li class="mb-3">
            <span class="fa-li"><i class="fa fa-phone"></i></span><span class="ms-2">+216 70 867 014</span>
          </li>
          <li class="mb-3">
            <span class="fa-li"><i class="fa fa-print"></i></span><span class="ms-2">+ +216 70 201 280</span>
          </li>
        </ul>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">Opening hours</h5>

        <table class="table text-center text-white">
          <tbody class="font-weight-normal">
            <tr>
              <td>Mon - Thu:</td>
              <td>8am - 9pm</td>
            </tr>
            <tr>
              <td>Fri - Sat:</td>
              <td>8am - 1am</td>
            </tr>
            <tr>
              <td>Sunday:</td>
              <td>9am - 10pm</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © {{moment().format('YYYY')}} Copyright:
    <a class="text-white" href="https://i-techrity.tn" target="_blank"> By i-techrity </a>
  </div>
  <!-- Copyright -->
</footer>

</div>
<!-- End of .container -->
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