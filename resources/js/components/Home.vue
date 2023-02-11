<template>
    <div class="w-60 mt-2 alert alert-warning text-center" v-if="alertMessage" role="alert">
      <i class="fa fa-check" aria-hidden="true"></i>
      {{ alertMessage }}
    </div>
  <div class="cont">
    <h1>Integrity Mall VI | 2023 مؤتمر النزاهة</h1>

    <!--Centered Image Start-->

    <div class="image">
      <img
        width="400"
        src="https://mall-mac.iwatch.tn/assets/images/banner/integrity.jpg"
      />
    </div>
    <router-link to="/register" class="d-flex justify-content-center" v-if="!isLogged"
      >Join Us</router-link
    >
    <!--Centered Image End-->

    <p>
      تتشرف منظمة أنا يقظ بدعوتكم لحضور ومواكبة فعاليات أكبر تظاهرة ضد الفساد في
      تونس: فضاء النزاهة Integrity Mall يضم برنامج التظاهرة هذه السنة ورشات
      وحلقات نقاش تتمحور حول الإفلات من العقاب/ حوكمة قطاع الصحة/ أزمة النفايات/
      البنوك والمالية العمومية. إلى جانب عروض فنية تجمع فناني الراب، هواة
      السينما🎬، المسرح والكوميديا.🎭 كما سنستمع إلى مرافعات ضد الفساد وأحكام
      قضاة المستقبل في قضايا فساد. فضاء النزاهة سيخصص مكان تنشيطي للأطفال 🤸‍♂️
      إضافة إلى معرض للصور الفوتوغرافية 📸 والقصص المصورة. تنتظم هذه التظاهرة
      يومي 4 و 5 فيفري 2023 بمدينة الثقافة بالعاصمة. فضاء النزاهة مفتوح للجميع،
      حضوركم يشرفنا.
    </p>
  </div>
</template>

<script>
export default {
  computed: {
    isLogged() {
      return this.$store.getters.isLogged;
    },
    computed:{
    alertMessage(){
        return this.$store.getters.getAlert ;
    },
  },
  },
};
</script>

<style>
.cont {
  margin: auto;
  width: 700px;
  padding: 50px;
  font-family: "Avenir", sans-serif;
  color: #33475b;
}

.image {
  display: flex;
  justify-content: center;
  margin-bottom: 50px;
}
</style>