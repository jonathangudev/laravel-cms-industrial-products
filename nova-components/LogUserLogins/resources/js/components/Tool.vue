<template>
  <div>
    <table class="table table-fixed emails-table w-full mb-8">
      <tr>
        <td>IP Address</td>
        <td>Login Time</td>
      </tr>
      <tr v-for="(item, index) in logData">
        <td>{{item.ip_address}}</td>
        <td>{{item.created_at}}</td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  props: ["resourceName", "resourceId", "field"],

  data() {
    return {
      logData: {}
    };
  },

  mounted() {
    console.log("/nova-vendor/log-user-logins/user/" + this.resourceId);

    axios
      .get("/nova-vendor/log-user-logins/user/" + this.resourceId)
      .then(response => (this.logData = response.data));
  }
};
</script>

<style>
/* Scoped Styles */

.border-grey-light {
  border-color: #dae1e7;
}

.emails-table td {
  padding-left: 2rem;
  padding-right: 2rem;
}
</style>
