<template>
  <div class="container">
    <h1 style="text-align:center">Home!</h1>
    <Logout></Logout>
    <router-link to="/article">
      <button class="btn btn-primary">Article</button>
    </router-link>
  </div>
</template>
<script>
import Logout from "../auth/logout"
export default {
  components:{
    Logout
  }
};
</script>