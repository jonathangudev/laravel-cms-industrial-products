<template>
  <div>
    <heading class="mb-6">Contact Settings Manager</heading>

    <card class style="min-height: 300px">
      <div class="w-full py-6">
        <div class="border-b flex justify-between px-6 pb-4 border-grey-light">
          <h3 class="flex items-center">Email Recipients</h3>

          <div class="form-group">
            <label for="emailRecipient" class="mr-3">Add an email address to the recipients list:</label>
            <input
              type="email"
              v-model="emailRecipient"
              class="form-control form-input form-input-bordered mr-3"
              placeholder="Enter email"
              @keyup.enter="submitEmailRecipient"
            >
            <button @click.prevent="submitEmailRecipient" class="btn btn-default btn-primary">Add</button>
          </div>
        </div>

        <template v-if="emailRecipients.length === undefined || emailRecipients.length == 0">
          <div class="italic my-8 text-base px-8">No entries in the email recipients list</div>
        </template>

        <template v-else>
          <table class="table table-fixed emails-table w-full mb-8" id="email-recipients">
            <tr v-for="(item, index) in emailRecipients" :key="`${index}`">
              <td class="w-3/4 overflow-x-auto py-0">{{ item }}</td>
              <td class="w-1/4 text-right py-0">
                <button
                  @click="deleteEmailRecipient(index)"
                  class="appearance-none cursor-pointer text-70 hover:text-primary"
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
              </td>
            </tr>
          </table>
        </template>
      </div>

      <div class="w-full py-6">
        <div class="border-b flex justify-between px-6 pb-4 border-grey-light">
          <h3 class="flex items-center">Email CCs List</h3>

          <div class="form-group">
            <label for="emailCc" class="mr-3">Add an email address to the recipients list:</label>
            <input
              type="email"
              v-model="emailCc"
              class="form-control form-input form-input-bordered mr-3"
              placeholder="Enter email"
              @keyup.enter="submitEmailCc"
            >
            <button @click.prevent="submitEmailCc" class="btn btn-default btn-primary">Add</button>
          </div>
        </div>

        <template v-if="emailCcs.length === undefined || emailCcs.length == 0">
          <div class="italic my-8 text-base px-8">No entries in the email CCs list</div>
        </template>
        <template v-else>
          <table class="table table-fixed emails-table w-full mb-8" id="email-ccs">
            <tr v-for="(item, index) in emailCcs" :key="`${index}`">
              <td class="w-3/4 overflow-x-auto py-0">{{ item }}</td>
              <td class="w-1/4 text-right py-0">
                <button
                  @click="deleteEmailCc(index)"
                  class="appearance-none cursor-pointer text-70 hover:text-primary"
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
              </td>
            </tr>
          </table>
        </template>
      </div>

      <div class="w-full py-6">
        <div class="border-b flex justify-between px-6 pb-4 border-grey-light">
          <h3 class="flex items-center">Email BCCs List</h3>

          <div class="form-group">
            <label for="emailBcc" class="mr-3">Add an email address to the recipients list:</label>
            <input
              type="email"
              v-model="emailBcc"
              class="form-control form-input form-input-bordered mr-3"
              placeholder="Enter email"
              @keyup.enter="submitEmailBcc"
            >
            <button @click.prevent="submitEmailBcc" class="btn btn-default btn-primary">Add</button>
          </div>
        </div>

        <template v-if="emailBccs.length === undefined || emailBccs.length == 0">
          <div class="italic my-8 text-base px-8">No entries in the email BCCs list</div>
        </template>
        <template v-else>
          <table class="table table-fixed emails-table w-full mb-8" id="email-bccs">
            <tr v-for="(item, index) in emailBccs" :key="`${index}`">
              <td class="w-3/4 overflow-x-auto py-0">{{ item }}</td>
              <td class="w-1/4 text-right py-0">
                <button
                  @click="deleteEmailBcc(index)"
                  class="appearance-none cursor-pointer text-70 hover:text-primary"
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
              </td>
            </tr>
          </table>
        </template>
      </div>
    </card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      emailRecipient: "",
      emailRecipients: [],
      emailCc: "",
      emailCcs: [],
      emailBcc: "",
      emailBccs: []
    };
  },

  created: function() {
    this.getEmailRecipients();
    this.getEmailCcs();
    this.getEmailBccs();
  },

  methods: {
    /**
     * SUBMIT EMAILS METHODS
     */
    submitEmailRecipient() {
      axios
        .post("/nova-vendor/contact-settings-manager/email-recipient", {
          email: this.emailRecipient
        })
        .then(response => {
          this.getEmailRecipients();
          this.emailRecipient = "";
        })
        .catch(error => {
          this.$toasted.show(error.response.data.message, { type: "error" });
        });
    },

    submitEmailCc() {
      axios
        .post("/nova-vendor/contact-settings-manager/email-cc", {
          email: this.emailCc
        })
        .then(response => {
          this.getEmailCcs();
          this.emailCc = "";
        })
        .catch(error => {
          this.$toasted.show(error.response.data.message, { type: "error" });
        });
    },

    submitEmailBcc() {
      axios
        .post("/nova-vendor/contact-settings-manager/email-bcc", {
          email: this.emailBcc
        })
        .then(response => {
          this.getEmailBccs();
          this.emailBcc = "";
        })
        .catch(error => {
          this.$toasted.show(error.response.data.message, { type: "error" });
        });
    },

    /**
     * GET EMAILS METHODS
     */
    getEmailRecipients() {
      axios
        .get("/nova-vendor/contact-settings-manager/email-recipient")
        .then(response => {
          this.emailRecipients = response.data;
        })
        .catch(error => {
          this.$toasted.show(error.response.data.message, { type: "error" });
        });
    },

    getEmailCcs() {
      axios
        .get("/nova-vendor/contact-settings-manager/email-cc")
        .then(response => {
          this.emailCcs = response.data;
        })
        .catch(error => {
          this.$toasted.show(error.response.data.message, { type: "error" });
        });
    },

    getEmailBccs() {
      axios
        .get("/nova-vendor/contact-settings-manager/email-bcc")
        .then(response => {
          this.emailBccs = response.data;
        })
        .catch(error => {
          this.$toasted.show(error.response.data.message, { type: "error" });
        });
    },

    /**
     * DELETE EMAILS METHODS
     */
    deleteEmailRecipient(index) {
      axios
        .delete(
          `/nova-vendor/contact-settings-manager/email-recipient/${index}`
        )
        .then(response => {
          this.getEmailRecipients();
        })
        .catch(error => {
          this.$toasted.show(error.response.data.message, { type: "error" });
        });
    },

    deleteEmailCc(index) {
      axios
        .delete(`/nova-vendor/contact-settings-manager/email-cc/${index}`)
        .then(response => {
          this.getEmailCcs();
        })
        .catch(error => {
          this.$toasted.show(error.response.data.message, { type: "error" });
        });
    },

    deleteEmailBcc(index) {
      axios
        .delete(`/nova-vendor/contact-settings-manager/email-bcc/${index}`)
        .then(response => {
          this.getEmailBccs();
        })
        .catch(error => {
          this.$toasted.show(error.response.data.message, { type: "error" });
        });
    }
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
