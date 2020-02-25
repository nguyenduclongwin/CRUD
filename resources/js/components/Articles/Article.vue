<template>
  <div>
    <h1>Article</h1>
    <router-link to="/add-article">
      <button class="btn btn-primary">Add</button>
    </router-link>
    <button v-on:click="exportArticle(current_page)" class="btn btn-primary">Export To Excel</button>
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
    <!-- Pagination -->
    <nav>
      <ul class="pagination">
        <li v-if="current_page > 1">
          <a href="#" aria-label="Previous" @click.prevent="changePage(current_page - 1)">
            <span aria-hidden="true">«</span>
          </a>
        </li>
        <li
          v-for="page in pagesNumber"
          :key="page"
          v-bind:class="[ page == current_page ? 'active' : '']"
        >
          <a href="#" @click.prevent="changePage(page)">{{ page }}</a>
        </li>
        <li v-if="current_page < last_page">
          <a href="#" aria-label="Next" @click.prevent="changePage(current_page + 1)">
            <span aria-hidden="true">»</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import { getHeader, delArticle, loginURL, exportURL } from "../../config";
import Logout from "../auth/logout";
export default {
  components: {
    Logout
  },
  data() {
    return {
      data: "",
      total: 0,
      per_page: 2,
      from: 1,
      last_page: 1,
      to: 0,
      current_page: 1,
      offset: 4,
      url: ""
    };
  },
  computed: {
    pagesNumber: function() {
      if (!this.to) {
        return [];
      }
      var from = this.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + this.offset * 2;
      if (to >= this.last_page) {
        to = this.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  created() {
    this.showArticle();
  },
  methods: {
    async showArticle(page) {
      let { data: datas } = await axios({
        method: "get",
        url: "api/article?page=" + page,
        headers: getHeader()
      });

      let {
        data,
        total,
        current_page,
        per_page,
        last_page,
        from,
        to
      } = datas.data;
      // console.log(data);
      this.data = data;
      this.total = total;
      this.current_page = current_page;
      this.per_page = per_page;
      this.last_page = last_page;
      this.from = from;
      this.to = to;
    },

    async deleteArticle(id) {
      if (confirm("Are you sure?")) {
        let del = await axios({
          method: "delete",
          url: delArticle(id),
          headers: getHeader()
        });
        this.showArticle(this.current_page);
      }
    },

    editArticle(id) {
      this.$router.push("edit-article?id=" + id);
    },
    changePage: function(page) {
      this.current_page = page;
      this.showArticle(page);
    },
    async exportArticle(page) {
      // console.log(page)
      let { data } = await axios({
        method: "get",
        url: "api/export-article?page=" + page,
        headers: getHeader()
      });
      let { url } = data.data;
      location.href=url;

    }
  }
};
</script>

<style lang="scss" scoped>
.active {
  background: lightgreen;
}
nav li {
  padding: 5px 5px;
  margin: 10px 10px;
}
</style>