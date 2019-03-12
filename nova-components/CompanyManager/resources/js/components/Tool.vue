<template>
  <div>
    <heading class="mb-6">Companies</heading>
    <button
      class="btn btn-default btn-primary inline-flex items-center relative"
      type="button"
      @click.prevent="$router.push({ name: 'index', params: { resourceName: 'companies' }})"
    >
      <span>manage</span>
    </button>
    <div class="flex mt-8">
      <div
        v-for="(company, index) in companies"
        :key="company.uuid"
        class="w-1/6"
        :class="{'ml-2': index !== 0}"
        @click="$router.push({name: 'detail', params: { resourceName: 'companies', resourceId: company.id }})"
      >
        <card class="p-4 flex justify-center shadow-md cursor-pointer">
          <img :src="`/catalog/asset/${company.logo}`" :alt="company.name" class="h-12 w-auto">
        </card>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      companies: []
    };
  },
  mounted() {
    axios.get("/nova-vendor/company-manager/companies").then(response => {
      this.companies = response.data;
    });
  }
};
</script>

<style>
/* Scoped Styles */
</style>
