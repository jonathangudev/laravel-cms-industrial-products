<template>
  <div>
    <table class="table table-fixed ips-table w-full">
      <tr class="border-top-transparent">
        <td class="border-top-transparent">
          <h4 class="font-normal text-80">IP Address</h4>
        </td>
        <td>
          <h4 class="font-normal text-80">Login Time</h4>
        </td>
      </tr>
      <tr v-for="(item, index) in entries">
        <td>{{item.ip_address}}</td>
        <td>{{item.created_at}}</td>
      </tr>
    </table>
    <div class="rounded-b mt-3">
      <nav class="flex justify-between items-center">
        <button
          class="btn btn-link py-3 px-4 text-80 opacity-50"
          @click.prevent="getPrevLoginsPage"
        >Previous</button>
        <span class="font-normal text-80">{{currPage}} / {{lastPage}}</span>
        <button
          class="btn btn-link py-3 px-4 text-80 opacity-50"
          @click.prevent="getNextLoginsPage"
        >Next</button>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  props: ["resourceName", "resourceId", "field"],

  data() {
    return {
      logData: {},
      entries: {},
      prevLink: "",
      nextLink: "",
      currPage: "",
      lastPage: ""
    };
  },

  mounted() {
    axios
      .get("/nova-vendor/log-user-logins/user/" + this.resourceId)
      .then(response => {
        this.entries = response.data.data;
        this.logData = response.data;
        this.currPage = this.logData.current_page;
        this.lastPage = this.logData.last_page;
        this.nextLink = this.logData.next_page_url;
        this.prevLink = this.logData.last_page_url;
      })
      .catch(error => {
        this.$toasted.show(error.response.data.message, { type: "error" });
      });
  },

  methods: {
    getNextLoginsPage() {
      if (this.nextLink) {
        axios
          .get(this.nextLink)
          .then(response => {
            this.entries = response.data.data;
            this.logData = response.data;
            this.currPage = this.logData.current_page;
            this.lastPage = this.logData.last_page;
            this.nextLink = this.logData.next_page_url;
            this.prevLink = this.logData.prev_page_url;
          })
          .catch(error => {
            this.$toasted.show(error.response.data.message, { type: "error" });
          });
      }
    },

    getPrevLoginsPage() {
      if (this.prevLink) {
        axios
          .get(this.prevLink)
          .then(response => {
            this.entries = response.data.data;
            this.logData = response.data;
            this.currPage = this.logData.current_page;
            this.lastPage = this.logData.last_page;
            this.nextLink = this.logData.next_page_url;
            this.prevLink = this.logData.prev_page_url;
          })
          .catch(error => {
            this.$toasted.show(error.response.data.message, { type: "error" });
          });
      }
    }
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
