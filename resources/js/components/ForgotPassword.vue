<template>
  <div class="login">
    <div class="row h-100 align-items-center">
      <div class="col-12 col-md-6 offset-md-3">
        <div class="card shadow sm">
          <div class="card-body">
            <h3 class="text-center">Trouver votre compte</h3>
            <hr />
            <div class="mb-3">
              Veuillez entrer votre adresse email pour rechercher votre compte.
            </div>
            <form
              autocomplete="off"
              @submit.prevent="requestResetPassword"
              method="post"
            >
              <div class="form-group">
                <label for="email">E-mail</label>
                <input
                  type="email"
                  id="email"
                  class="form-control"
                  placeholder="Ex: exemple@exemple.com"
                  v-model="email"
                  required
                />
              </div>
              <button
                type="submit"
                :disabled="processing"
                class="btn btn-primary"
              >
                <div
                  v-if="processing"
                  class="spinner-border spinner-border-sm"
                ></div>
                <template v-else>
                  Envoyer un lien de réinitialisation du mot de passe</template
                >
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="container">
      <div class="row justify-content-center">
        <div class="col-6">
          <div class="card card-default">
            <div class="card-header">Reset Password</div>
            <div class="card-body">
              <form autocomplete="off" @submit.prevent="requestResetPassword" method="post">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div> -->
</template>
  
  <script>
import { toast } from 'vue3-toastify';

export default {
  data() {
    return {
      email: null,
      processing: false,
    };
  },
  methods: {
    requestResetPassword() {
      this.processing = true;
      axios
        .post("/api/reset-password", { email: this.email })
        .then((response) => {
          this.processing = false;
          toast.success(response.data.message, {
            autoClose: 3000,
          });
          setTimeout(() => {
            window.location.href = "/";
          }, "4000");
        })
        .catch(({ response }) => {
            this.processing = false;
          if (response.status === 403) {
            toast.error(response.data.message, {
              autoClose: 2000,
            });
          } else {
            alert("error 500! something went wrong *.* ");
          }
        });
    },
  },
};
</script>