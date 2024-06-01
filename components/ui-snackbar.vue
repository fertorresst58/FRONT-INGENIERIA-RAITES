<template>
  <v-snackbar
    :value="showSnackbar"
    :color="color"
    :timeout="timeout"
    class="rounded-pill"
    @input="toggleSnackbar(false)"
  >
    <v-row class="d-flex align-center align-content-center justify-center text-center px-5">
      <v-icon>{{ icon }}</v-icon>
      <strong class="ml-2">{{ mensaje }}</strong>
    </v-row>
  </v-snackbar>
</template>

<script>
export default {
  computed: {
    showSnackbar () {
      return this.$store.state.showSnackbar
    },
    timeout () {
      return this.$store.state.timeout
    },
    color () {
      return this.$store.state.color
    },
    mensaje () {
      return this.$store.state.mensaje
    },
    icon () {
      return this.$store.state.icon
    }
  },
  methods: {
    toggleSnackbar (value) {
      this.$store.commit('modifySnackbar', value)
    }
  }
}
</script>

<style scoped>

</style>
