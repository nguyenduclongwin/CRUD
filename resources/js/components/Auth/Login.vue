<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-push-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>Đăng nhập</strong>
          </div>
          <div class="panel-body">
            <form v-on:submit.prevent="handleLoginFormSubmit()">
              <div class="form-group">
                <label>Địa chỉ Email</label>
                <input
                  class="form-control"
                  placeholder="Enter your email address"
                  type="text"
                  v-model="login.email"
                />
              </div>
              <div class="form-group">
                <label>Mật khẩu</label>
                <input
                  class="form-control"
                  placeholder="Enter your email address"
                  type="password"
                  v-model="login.password"
                />
              </div>
              <p v-if="error" class="alert alert-danger">Sai tên đăng nhập hoặc mật khẩu</p>
              <button class="btn btn-primary">Đăng nhập</button>
              <router-link to="/register">
                <button class="btn btn-primary">Đăng kí</button>
              </router-link>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { loginURL, getHeader, getData, userURL } from "../../config";
export default {
  data() {
    return {
      login: {
        email: "nguyenduclongwin@gmail.com",
        password: "long6868"
      },
      error: false
    };
  },
  methods: {
    async handleLoginFormSubmit() {
      const authUser = {};
      let { status, data } = await axios({
        method: "post",
        url: loginURL,
        data: getData(this.login.email, this.login.password)
      });
      if (status === 200) {
        authUser.access_token = data.access_token;
        authUser.refresh_token = data.refresh_token;
        window.localStorage.setItem("authUser", JSON.stringify(authUser));
        let { data: user } = await axios({
          method: "get",
          url: userURL,
          headers: getHeader()
        });
        authUser.email = user.email;
        authUser.name = user.name;
        window.localStorage.setItem("authUser", JSON.stringify(authUser));
        this.$router.push({ name: "Home" });
      }
    }
  }
};
</script>