<template>
  <button v-on:click="logout" class="btn btn-primary">Đăng xuất</button>
</template>

<script>
export default {
  name: "logout",
  methods: {
    logout() {
      localStorage.removeItem("authUser");
      location.reload();
    }
  }
};
</script>

<style lang="scss" scoped>
</style>