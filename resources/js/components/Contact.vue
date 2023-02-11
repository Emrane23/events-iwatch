<template>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-4 mt-5">
          <h2 class="heading-section">Contactez-nous</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="wrapper">
            <div class="row no-gutters mb-5">
              <div class="col-md-7">
                <div class="contact-wrap w-100 p-md-5 p-4">
                  <h3 class="mb-4">Contactez-nous</h3>

                  <form
                    method="POST"
                    id="contactForm"
                    name="contactForm"
                    class="contactForm"
                    :model="form" @submit.prevent="submit"
                  >
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label" for="subject">Sujet</label>
                          <input
                            type="text"
                            class="form-control"
                            name="subject"
                            id="subject"
                            placeholder="Sujet"
                          />
                        </div>
                      </div>
                      <vue-recaptcha
                        ref="recaptcha"
                        @verify="onVerify"
                        sitekey="6Lez4W4kAAAAAFM986_mUYWVtLEC-mcNOnXkTO0G"
                      >
                      </vue-recaptcha>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="label" for="#">Message</label>
                          <textarea
                            name="message"
                            class="form-control"
                            id="message"
                            cols="30"
                            rows="4"
                            placeholder="Message"
                          ></textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <input
                            type="submit"
                            value="Envoyer"
                            class="btn btn-primary"
                          />
                          <div class="submitting"></div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-5 d-flex align-items-stretch">
                <div id="map">
                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3192.6473672836787!2d10.146856314123834!3d36.85092057993817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd3462dc4b116d%3A0xb21b90d2e68fd33e!2zSSBXQVRDSCBPcmdhbmlzYXRpb24gLSDZhdmG2LjZkdmF2Kkg2KPZhtinINmK2YLYuA!5e0!3m2!1sfr!2stn!4v1676035786324!5m2!1sfr!2stn"
                    width="500"
                    height="450"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                  ></iframe>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="dbox w-100 text-center">
                  <div
                    class="
                      icon
                      d-flex
                      align-items-center
                      justify-content-center
                    "
                  >
                    <span class="fa fa-map-marker"></span>
                  </div>
                  <div class="text">
                    <p>
                      <span>Address:</span> 198 West 21th Street, Suite 721 New
                      York NY 10016
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="dbox w-100 text-center">
                  <div
                    class="
                      icon
                      d-flex
                      align-items-center
                      justify-content-center
                    "
                  >
                    <span class="fa fa-phone"></span>
                  </div>
                  <div class="text">
                    <p>
                      <span>Phone:</span>
                      <a href="tel://1234567920">+ 1235 2355 98</a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="dbox w-100 text-center">
                  <div
                    class="
                      icon
                      d-flex
                      align-items-center
                      justify-content-center
                    "
                  >
                    <span class="fa fa-paper-plane"></span>
                  </div>
                  <div class="text">
                    <p>
                      <span>Email:</span>
                      <a href="mailto:info@yoursite.com">info@yoursite.com</a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="dbox w-100 text-center">
                  <div
                    class="
                      icon
                      d-flex
                      align-items-center
                      justify-content-center
                    "
                  >
                    <span class="fa fa-globe"></span>
                  </div>
                  <div class="text">
                    <p><span>Website</span> <a href="#">yoursite.com</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import {VueRecaptcha} from 'vue-recaptcha';

export default {
    data() {
    return {
      form: {
        
        robot: false
      }
    }
  },
  methods: {
    submit: function() {
      if (this.form.robot) {
        
      }
    },
    onVerify: function (response) {
      if (response) this.form.robot = true;
    },
  },
  components: {
    'vue-recaptcha': VueRecaptcha
  },
};
</script>
<style>
.contact-wrap {
  background: #e8edf0;
}
#map {
  width: 100%;
}
@media (max-width: 767.98px) {
  #map {
    height: 300px;
  }
}
.dbox .icon {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: #2553b8;
  margin: 0 auto;
  margin-bottom: 20px;
}
.dbox .icon span {
  font-size: 20px;
  color: #fff;
}
.dbox .text {
  width: 100%;
}
</style>