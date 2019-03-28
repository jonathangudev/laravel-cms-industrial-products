<template>
  <div>
    <heading class="mb-6">Contact Settings Manager</heading>

    <card class="flex flex-col items-center justify-center" style="min-height: 300px">
      <h1 class="text-black text-4xl text-90 font-light mb-6">Set Email Recipients List</h1>
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
      </div>18
      <button @click="submitRecipientEmail" class="btn btn-default btn-primary">Add</button>
    </card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: ""
    };
  },

  methods: {
    submitRecipientEmail() {
      axios
        .post("/nova-vendor/contact-settings-manager/email-recipient", {
          email: this.email
        })
        .then(response => {
          console.log(response);
        });
    }
  }
};
</script>

<style>
/* Scoped Styles */
</style>
