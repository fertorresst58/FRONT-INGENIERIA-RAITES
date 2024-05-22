export const state = () => ({
  color: '',
  showSnackbar: false,
  timeout: null,
  mensaje: '',
  icon: '',
  user: {},
  token: null
})

export const mutations = {
  modifyColor (state, color) {
    state.color = color
  },
  modifyTimeout (state, timeout) {
    state.timeout = timeout
  },
  modifySnackbar (state, showSnackbar) {
    state.showSnackbar = showSnackbar
  },
  modifyText (state, mensaje) {
    state.mensaje = mensaje
  },
  modifyIcon (state, icon) {
    state.icon = icon
  },
  setUser (state, user) {
    state.user = user
  },
  setToken (state, token) {
    state.token = token
  }
}
