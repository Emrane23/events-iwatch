<template>
  <nav class="">
        <ol class="breadcrumb justify-content-center">
          <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
          <li class="breadcrumb-item active">{{ item_nav }}</li>
        </ol>
      </nav>
</template>

<script>
export default {
    props: ["item_nav"],
}
</script>

<style>

</style>