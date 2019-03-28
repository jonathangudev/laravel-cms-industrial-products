<template>
  <div>
    <heading class="mb-6">Contact Settings Manager</heading>

    <card class="flex flex-row items-center justify-center" style="min-height: 300px">
      <div>
        <h3>Email Recipients</h3>
        <div>
          <ul id="email-recipients">
            <li v-for="(item, index) in emailRecipients">
              {{ item }}
              <button
                @click="deleteRecipientEmail"
                class="btn btn-default btn-danger"
                v-bind:data-email-recipients-index="index"
              >Delete</button>
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
        </div>31
        <button @click="submitRecipientEmail" class="btn btn-default btn-primary">Add</button>
      </div>

      <div></div>

      <div></div>
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
        });

      this.email = "";
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
