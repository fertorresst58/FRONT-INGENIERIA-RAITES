<template>
  <v-stepper v-model="internalStep">
    <slot></slot>
  </v-stepper>
</template>
<script>
export default {
  props: {
    value: {
      type: Number,
      required: true
    }
  },
  data () {
    return {
      internalStep: this.value
    }
  },
  watch: {
    value (newValue) {
      this.internalStep = newValue
    },
    internalStep (newValue) {
      this.$emit('input', newValue)
    }
  }
}
</script>
