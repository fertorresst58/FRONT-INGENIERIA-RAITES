<template>
  <v-snackbar
    v-model="showSnackbar"
    :color="color"
    :timeout="timeout"
    class="rounded-pill"
  >
    <v-row align="center" justify="center" class="text-center">
      <v-icon>{{ icon }}&nbsp;</v-icon>
      {{ mensaje }}
    </v-row>
  </v-snackbar>
</template>

<script>
import { mapState } from 'vuex'
export default {
  computed: {
    ...mapState({
      showSnackbar: state => state.showSnackbar,
      timeout: state => state.timeout,
      color: state => state.color,
      mensaje: state => state.mensaje,
      icon: state => state.icon
    })
  },
  watch: {
    showSnackbar () {},
    timeout () {},
    color () {},
    mensaje () {},
    icon () {}
  }
}
</script>

<style scoped>

</style>
