<template>
  <v-app>
    <v-navigation-drawer
      v-model="drawer"
      :mini-variant="miniVariant"
      :clipped="clipped"
      fixed
      app
      width="20%"
    >
      <v-list>
        <v-list-item>
          <v-list-item-avatar>
            <v-img :src="img" />
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title class="fontTitle" color="black">
              {{ nombre }}
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-divider />

        <v-list-item
          v-for="(item, i) in items"
          :key="i"
          :to="!item.dialog ? item.to : null"
          router
          exact
          @click="handleClick(item)"
        >
          <v-list-item-action>
            <v-icon style="color: black;">
              {{ item.icon }}
            </v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title class="fontTitle" style="color: black;">
              {{ item.title }}
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      :clipped-left="clipped"
      absolute
      app
      flat
      color="#0A263D"
    >
      <v-app-bar-nav-icon color="#FFD300" @click.stop="drawer = !drawer" />

      <v-spacer />

      <v-toolbar-title>
        <span style="color: white;">{{ title }}</span>
      </v-toolbar-title>

      <v-spacer />

      <v-btn
        elevation="0"
        color="#FFD300"
        icon
        @click="logOut"
      >
        <v-icon>mdi-logout</v-icon>
      </v-btn>
    </v-app-bar>

    <v-main>
      <v-container>
        <Nuxt />
        <ui-snackbar />
      </v-container>
    </v-main>

    <v-footer dark padless>
      <v-card class="flex" flat tile>
        <v-card-title class="blueBack">
          <v-spacer />
          <v-btn v-for="icon in icons" :key="icon" class="mx-4" dark icon>
            <v-icon size="24px">
              {{ icon }}
            </v-icon>
          </v-btn>
          <v-spacer />
        </v-card-title>

        <v-card-text class="py-2 white--text text-center coyoteBack">
          {{ new Date().getFullYear() }} — <strong>Raites UG by Los Palomeros</strong>
        </v-card-text>
      </v-card>
    </v-footer>

    <!-- Dialogo para Publicar Viaje -->
    <v-dialog v-model="dialog" max-width="800px">
      <v-card>
        <v-card-title class="pa-3 d-flex justify-center" style="background-color: #0A263D; color: white;">
          Publicar Viaje
        </v-card-title>
        <v-card-text class="pt-5">
          <v-form ref="form">
            <v-row>
              <v-col cols="12">
                <v-text-field
                  v-model="Lsalida"
                  label="Lugar de salida"
                  type="text"
                  outlined
                  :rules="[v => !!v || 'Campo requerido']"
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  v-model="Ldestino"
                  label="Lugar de destino"
                  type="text"
                  outlined
                  :rules="[v => !!v || 'Campo requerido']"
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="3">
                <v-text-field
                  v-model="Fecha"
                  label="Fecha del viaje"
                  type="date"
                  outlined
                  :min="minFecha"
                  :rules="[v => !!v || 'Campo requerido']"
                />
              </v-col>
              <v-col cols="3">
                <v-text-field
                  v-model="HoraSalida"
                  label="Hora de salida"
                  type="time"
                  outlined
                  :rules="[v => !!v || 'Campo requerido', validateHora]"
                />
              </v-col>
              <v-col cols="3">
                <v-text-field
                  v-model="Precio"
                  label="Precio"
                  type="number"
                  prefix="$"
                  outlined
                  :rules="[v => !!v || 'Campo requerido']"
                />
              </v-col>
              <v-col cols="3">
                <v-select
                  v-model="Nasientos"
                  label="N° de asientos"
                  :items="options"
                  type="number"
                  outlined
                  :rules="[v => !!v || 'Campo requerido']"
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  v-model="Detalles"
                  label="Comentarios"
                  type="text"
                  outlined
                />
              </v-col>
            </v-row>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <v-btn color="red" style="color: white;" @click="cancelarViaje">
            Cancelar
          </v-btn>
          <v-btn
            color="#8C6E39"
            style="color: white;"
            :disabled="!isFormValid"
            @click="publicarViaje"
          >
            Publicar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-app>
</template>

<script>
import { mapState } from 'vuex'
import UiSnackbar from '~/components/ui-snackbar.vue'

export default {
  name: 'DefaultLayout',

  components: {
    UiSnackbar
  },

  data () {
    return {
      clipped: false,
      drawer: false,
      dialog: false,
      fixed: false,
      items: [
        {
          icon: 'mdi-home',
          title: 'Home',
          to: '/home'
        },
        {
          icon: 'mdi-airplane',
          title: 'Publicar Viaje',
          dialog: true
        },
        {
          icon: 'mdi-account',
          title: 'Mi Perfil',
          to: '/profile'
        },
        {
          icon: 'mdi-routes',
          title: 'Mi Historial',
          to: '/history'
        },
        {
          icon: 'mdi-message',
          title: 'Mis Mensajes',
          to: '/mis-viajes'
        }
      ],
      miniVariant: false,
      right: true,
      rightDrawer: false,
      title: 'RAITES UG',

      // VARIABLES PARA USUARIO
      user: {},
      nombre: '',
      img: '',
      token: '',

      // VARIABLES DE FOOTER
      icons: [
        'mdi-facebook',
        'mdi-twitter',
        'mdi-instagram'
      ],

      options: ['1', '2', '3', '4'],

      // Datos del viaje
      Lsalida: '',
      Ldestino: '',
      Fecha: '',
      HoraSalida: '',
      Precio: '',
      Nasientos: '',
      Detalles: ''
    }
  },

  computed: {
    ...mapState({
      showSnackbar: state => state.showSnackbar,
      token: state => state.token
    }),
    minFecha () {
      return new Date().toISOString().split('T')[0]
    },
    isFormValid () {
      return this.Lsalida && this.Ldestino && this.Fecha && this.HoraSalida && this.Precio && this.Nasientos && this.validateHora(this.HoraSalida) === true
    }
  },

  mounted () {
    // SE EJECUTA CUANDO SE CARGA EL COMPONENTE
    // AUTENTICACION
    if (this.$store.state.token === null) { this.$router.push('/') } else { this.obtenerDatosUsuarios() }

    this.obtenerDatosUsuarios()
  },

  methods: {
    handleClick (item) {
      if (item.dialog) {
        this.dialog = true
      } else {
        this.$router.push(item.to)
      }
    },
    validateHora (value) {
      if (!value) { return true }

      const today = new Date().toISOString().split('T')[0]
      if (this.Fecha !== today) { return true }

      const now = new Date()
      const [hour, minute] = value.split(':')
      const selectedTime = new Date()
      selectedTime.setHours(hour, minute, 0, 0)

      return selectedTime >= now || 'La hora debe ser mayor a la actual'
    },
    publicarViaje () {
      if (!this.$refs.form.validate()) {
        return
      }

      const id = this.$store.state.user.id
      const sendData = {
        inicio: this.Lsalida,
        destino: this.Ldestino,
        fecha: this.Fecha,
        precio: this.Precio,
        hora: this.HoraSalida,
        capacidad: this.Nasientos,
        descripcion: this.Detalles,
        id
      }

      const url = '/registrarviaje'
      // Agregar logs antes de la solicitud
      console.log('URL:', url)
      console.log('Datos enviados:', sendData)

      this.$axios.post(url, sendData)
        .then((res) => {
          if (res.data.success) {
            console.log('REGISTRO EXITOSO')
          } else {
            console.log('ERROR AL REGISTRAR')
          }
          this.resetForm()
          this.dialog = false
        })
        .catch((err) => {
          console.log('@@@ err => ', err)
          alert('Ocurrió un error al publicar el viaje. Por favor, inténtalo de nuevo.')
        })
      this.resetForm()
      this.dialog = false
    },
    cancelarViaje () {
      this.resetForm()
      this.dialog = false
    },
    resetForm () {
      this.Lsalida = ''
      this.Ldestino = ''
      this.Fecha = ''
      this.HoraSalida = ''
      this.Precio = ''
      this.Nasientos = ''
      this.Detalles = ''
    },
    obtenerDatosUsuarios () {
      this.user = this.$store.state.user
      this.token = this.$store.state.token
      this.nombre = this.user.nombre + ' ' + this.user.apaterno + ' ' + this.user.amaterno
      this.img = this.user.img
    },
    logOut () {
      // Lógica para cerrar sesión
    }
  }
}
</script>

<style scoped>
.alerta {
  position: absolute;
  top: 10px;
  right: 10px;
  z-index: 1000;
}
</style>
