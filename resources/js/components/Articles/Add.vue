<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-push-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1>Add Article</h1>
          </div>
          <div class="panel-body">
            <form v-on:submit.prevent="addArticle()">
              <div class="form-group">
                <label>title</label>
                <input
                  class="form-control"
                  placeholder="Enter your email address"
                  type="text"
                  v-model="title"
                />
              </div>
              <div class="form-group">
                <label>Content</label>
                <textarea
                  class="form-control"
                  placeholder="Enter your email address"
                  type="password"
                  v-model="content"
                ></textarea>
              </div>
              <button class="btn btn-primary">Add</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { getHeader, addArticle } from "../../config";
export default {
  data() {
    return {
      title: "",
      content: ""
    };
  },
  methods: {
    async addArticle() {
      let response = await axios({
        method: "post",
        url: addArticle,
        data: { title: this.title, content: this.content },
        headers: getHeader()
      });
      this.$router.push({ name: "Article" });
    }
  }
};
</script>