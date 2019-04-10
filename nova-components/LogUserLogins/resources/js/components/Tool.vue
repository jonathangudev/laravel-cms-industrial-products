<template>
  <div>
    <table class="table table-fixed ips-table w-full mb-8">
      <tr class="border-top-transparent">
        <td class="border-top-transparent">
          <h4 class="font-normal text-80">IP Address</h4>
        </td>
        <td>
          <h4 class="font-normal text-80">Login Time</h4>
        </td>
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
    axios
      .get("/nova-vendor/log-user-logins/user/" + this.resourceId)
      .then(response => (this.logData = response.data))
      .catch(error => {
        this.$toasted.show(error.response.data.message, { type: "error" });
      });
  }
};
</script>

<style>
/* Scoped Styles */

.ips-table td {
  padding-left: 2rem;
  padding-right: 2rem;
}

.ips-table td {
  border-top-width: 0px;
}
</style>
