<template>
  <div>
    <heading class="mb-6">Contact Settings Manager</heading>

    <card class="flex flex-col items-center justify-center" style="min-height: 300px">
      <h1 class="text-black text-4xl text-90 font-light mb-6">Set Email Recipients List</h1>

      <form>
        <div class="form-group">
          <label for="recipientEmail">Email address</label>
          <input
            type="email"
            class="form-control form-input form-input-bordered"
            id="recipientEmail"
            name="recipientEmail"
            placeholder="Enter email"
          >
        </div>
        <button @click="submitRecipientEmail" type="submit" class="btn btn-default btn-primary">Add</button>
      </form>
    </card>
  </div>
</template>

<script>
export default {
  methods: {
    submitRecipientEmail() {
      Nova.request()
        .post("/nova-vendor/contact-settings-manager")
        .then(data => {
          alert("Success");
        });
    }
  }
};
</script>

<style>
/* Scoped Styles */
</style>
