<template>
  <div>
    <heading class="mb-6">Contact Settings Manager</heading>

    <card class="flex flex-row items-center justify-center" style="min-height: 300px">
      <div class="w-1/3 p-6">
        <h3>Email Recipients</h3>
        <div>
          <ul class="list-reset" id="email-recipients">
            <li class="flex" v-for="(item, index) in emailRecipients">
              <div class="w-3/4 overflow-x-auto">{{ item }}</div>
              <button
                @click="deleteRecipientEmail"
                class="appearance-none cursor-pointer text-70 hover:text-primary w-1/4"
                v-bind:data-email-recipients-index="index"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  aria-labelledby="delete"
                  role="presentation"
                  class="fill-current"
                >
                  <path
                    fill-rule="nonzero"
                    d="M6 4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6H1a1 1 0 1 1 0-2h5zM4 6v12h12V6H4zm8-2V2H8v2h4zM8 8a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1z"
                  ></path>
                </svg>
              </button>
            </li>
          </ul>
        </div>
        <hr>
        <div class="form-group">
          <label for="recipientEmail">Email address</label>
          <input
            type="email"
            v-model="email"
            class="form-control form-input form-input-bordered"
            id="recipientEmail"
            name="recipientEmail"
            placeholder="Enter email"
          >
        </div>33
        <button @click="submitRecipientEmail" class="btn btn-default btn-primary">Add</button>
      </div>

      <div class="w-1/3">content</div>

      <div class="w-1/3">content</div>
    </card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      emailRecipients: []
    };
  },

  created: function() {
    this.getRecipientEmails();
  },

  methods: {
    submitRecipientEmail() {
      axios
        .post("/nova-vendor/contact-settings-manager/email-recipient", {
          email: this.email
        })
        .then(response => {
          //console.log(response);
          this.getRecipientEmails();
        })
        .catch(error => {
          this.$toasted.show(error.response.data.message, { type: "error" });
        })
        .then(() => {
          this.email = "";
        });
    },

    getRecipientEmails() {
      axios
        .get("/nova-vendor/contact-settings-manager/email-recipient")
        .then(response => {
          this.emailRecipients = response.data;
        });
    },

    deleteRecipientEmail(e) {
      let index = e.currentTarget.getAttribute("data-email-recipients-index");

      axios
        .delete(
          `/nova-vendor/contact-settings-manager/email-recipient/${index}`
        )
        .then(response => {
          console.log(response);
          this.getRecipientEmails();
        });
    }
  }
};
</script>

<style>
/* Scoped Styles */
</style>
