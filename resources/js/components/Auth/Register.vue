<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-push-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>Đăng kí</strong>
          </div>
          <div class="panel-body">
            <form v-on:submit.prevent="handleRegisterFormSubmit()">
              <div class="form-group">
                <label>Họ và tên</label>
                <input
                  class="form-control"
                  placeholder="Enter your name"
                  type="text"
                  v-model="name"
                />
              </div>
              <div class="form-group">
                <label>Địa chỉ Email</label>
                <input
                  class="form-control"
                  placeholder="Enter your email address"
                  type="text"
                  v-model="email"
                />
              </div>

              <div class="form-group">
                <label>Mật khẩu</label>
                <input
                  class="form-control"
                  placeholder="Enter your password"
                  type="password"
                  v-model="password"
                />
              </div>
              <div class="form-group">
                <label>Nhập lại Mật khẩu</label>
                <input
                  class="form-control"
                  placeholder="Enter your repassword"
                  type="password"
                  v-model="repassword"
                />
              </div>
              <p v-if="status_register" class="alert alert-danger">Đăng kí không thành công</p>
              <button class="btn btn-primary">Đăng kí</button>
              <router-link to="/login">
                <button class="btn btn-primary">Đăng nhập</button>
              </router-link>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { loginURL, getHeader, userURL, getData } from "../../config";
export default {
  data() {
    return {
      name: "Long",
      email: "long6868@gmail.com",
      password: "long6868",
      repassword: "long6868",
      status_register: false
    };
  },
  methods: {
    async handleRegisterFormSubmit() {
      let register = await axios.post("api/register", {
        name: this.name,
        email: this.email,
        password: this.password,
        repassword: this.repassword
      });

      const authUser = {};
      let { status, data } = await axios({
        method: "post",
        url: loginURL,
        data: getData(this.email, this.password)
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