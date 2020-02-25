<template>
  <div>
    <table>
      <thead>
        <tr>
          <th>name</th>
          <th>action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{user.name}}</td>
          <td>
            <button v-on:click="follow(user.id)">follow</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { getData,usersURL,getHeader } from '../../config';
export default {
  data() {
    return {
        users:"",
        st_folow: false
    };
  },
  created(){
      this.getUsers()
  },
  methods:{
      async getUsers(){
          let { data } = await axios({
            method: "get",
            url: 'api/users',
            headers: getHeader()
          })
          this.users=data.data;
      },
      async follow(id){
          let {data} = await axios({
              method: 'post',
              url: 'api/users',
              data: {
                  'user_id':id
              },
              headers: getHeader()
          })
          this.st_folow=false
      }
  }
};
</script>

<style lang="scss" scoped>
</style>