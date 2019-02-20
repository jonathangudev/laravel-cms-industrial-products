<template>
  <div class="flex items-center border-b border-40">
    <div class="w-1/4 py-4">
      <h4 class="font-normal text-80">{{attribute.name}}</h4>
    </div>
    <div class="w-1/2 py-4">
      <input type="text" placeholder="Name" class="w-full form-control form-input form-input-bordered" v-model="attribute.value">
      <!-- <p class="text-90">{{attribute.value}}</p> -->
    </div>
    <div class="w-1/2 py-4 text-right">
      <button type="button" class="btn btn-default btn-primary">Save</button>
    </div>
  </div>
</template>

<script>
export default {
  props: ['attribute'],
  data () {
    return {};
  }
}
</script>
