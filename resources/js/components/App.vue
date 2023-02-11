<template>
  <div class="app-bg">
    <header class="app-header">
      <global-component></global-component>
    </header>
    <main class="container">
      <!-- <img
      src="/images/IWatchcover.png"
      alt=""
    > -->
      <router-view></router-view>
    </main>
    <footer>
      <footer-component></footer-component>
    </footer>
  </div>
</template>

<script>
export default {};
</script>

<style>


.app-bg::after {
  content: "";
  position: absolute;
  z-index: -1;
  inset: 0;
  background: pink;
  opacity: 0.1;
  background-image: url("/images/IWatchcover.png");
  background-repeat: no-repeat;
  background-position: absolute;
  background-size:100% auto;
}
/* .app-bg{
  opacity: 0.1;
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: auto;
} */
</style>