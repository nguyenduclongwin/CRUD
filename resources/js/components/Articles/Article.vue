<template>
  <div>
    <h1>Article</h1>
    <router-link to="/add-article">
      <button class="btn btn-primary">Add</button>
    </router-link>
    <Logout></Logout>
    <table class="table table-hover table-condensed">
      <thead>
        <tr>
          <th style="width:20%">Title</th>
          <th style="width:60%">Content</th>
          <th style="width:20%"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in data" :key="item.id">
          <td>{{item.title}}</td>
          <td>{{item.content}}</td>
          <td>
            <button
              class="btn btn-info btn-sm update-article"
              v-on:click="editArticle(item.id)"
            >Edit</button>

            <button
              class="btn btn-danger btn-sm remove-from-article"
              v-on:click="deleteArticle(item.id)"
            >Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { getHeader, showArticle, delArticle } from "../../config";
import Logout from "../auth/logout";
export default {
  components: {
    Logout
  },
  data() {
    return {
      data: ""
    };
  },
  created() {
    this.showArticle();
  },
  methods: {
    async showArticle() {
      let { data } = await axios({
        method: "get",
        url: showArticle,
        headers: getHeader()
      });
      this.data = data.data;
    },

    async deleteArticle(id) {
      if (confirm("Are you sure?")) {
        let del = await axios({
          method: "delete",
          url: delArticle(id),
          headers: getHeader()
        });
        let { data } = await axios({
          method: "get",
          url: showArticle,
          headers: getHeader()
        });
        this.data = data.data;
        this.$router.push({ name: "Article" });
      }
    },

    editArticle(id) {
      this.$router.push("edit-article?id=" + id);
    }
  }
};
</script>

<style lang="scss" scoped>
</style>