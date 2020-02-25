<template>
  <div>
    <h1 style="text-align:center">Home!</h1>
    <h3>xin chao {{user}}</h3>
    <Logout></Logout>
    <router-link to="/article">
      <button class="btn btn-primary">Article</button>
    </router-link>
    <Users></Users>
  </div>
</template>
<script>
import Logout from "../auth/logout";
import Users from "../users/Users";
export default {
  components: {
    Logout,
    Users
  },
  data() {
    return {
      user: JSON.parse(window.localStorage.getItem("authUser")).name
    };
  }
};
</script>