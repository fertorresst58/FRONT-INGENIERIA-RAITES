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
        <v-list-item @click="panicDialog = true">
          <v-list-item-action>
            <v-icon style="color: red;">
              mdi mdi-shield-alert-outline
            </v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title class="fontTitle" style="color: red;">
              Botón de Pánico
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
        <v-img
          :src="require('@/assets/logo.png')"
          height="70px"
          contain
        />
      </v-toolbar-title>

      <v-spacer />

      <v-btn
        elevation="0"
        color="#FFD300"
        icon
        @click="logOut()"
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
          {{ new Date().getFullYear() }} — <strong>BEE RAITES by Los Palomeros</strong>
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
          <v-form
            ref="form"
            v-model="validForm"
          >
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
                  :min="minDate"
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
                  label="Detalles adicionales"
                  type="text"
                  outlined
                />
              </v-col>
            </v-row>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <v-btn color="red" style="color: white;" @click="dialog = false">
            Cancelar
          </v-btn>
          <v-btn color="#8C6E39" style="color: white;" @click="publicarViaje">
            Publicar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- Dialogo para el boton de panico-->
    <v-dialog v-model="panicDialog" max-width="800px">
      <v-card>
        <v-card-title class="pa-3 d-flex justify-center" style="background-color: #0A263D; color: white;">
          ¡Botón de Pánico!
        </v-card-title>
        <v-card-text>
          <v-row justify="center" class="text-center mb-2">
            <v-col cols="12" class="d-flex justify-center">
              <v-img
                src="https://img.freepik.com/vector-premium/signo-exclamacion-blanco-circulo-rojo-aislado-sobre-fondo-blanco_120819-332.jpg"
                max-width="400"
                max-height="400"
                contain
                class="overflow-hidden"
              />
            </v-col>
          </v-row>
          <v-row justify="center" class="text-center mt-0">
            <v-card-text>
              <h1 class="my-1">
                Estás a punto de activar el
              </h1>
              <h1 class="my-2">
                boton de pánico
              </h1>
              <h3 class="my-1">
                Esto hará que tu ubicación sea enviada inmediatamente
              </h3>
              <h3 class="my-1">
                a las fuerzas del orden.
              </h3>
              <h2 class="my-2">
                ¿Estás seguro de que quieres proceder?
              </h2>
            </v-card-text>
          </v-row>
        </v-card-text>

        <v-card-actions>
          <v-row justify="space-between" no-gutters class="w-100">
            <v-col cols="5">
              <v-btn block color="green" style="color: white;" @click="panicDialog = false">
                Cancelar
              </v-btn>
            </v-col>
            <v-col cols="5">
              <v-btn block color="red" style="color: white;" @click="sendDialog = true">
                Activar
              </v-btn>
            </v-col>
          </v-row>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="sendDialog" persistent max-width="800px">
      <v-card>
        <v-card-title class="pa-3 d-flex justify-center" style="background-color: #0A263D; color: white;">
          ¡Enviando Datos!
        </v-card-title>
        <v-card-text>
          <v-row justify="center" class="text-center mb-2">
            <v-col cols="12" class="d-flex justify-center">
              <v-img
                src="https://img.freepik.com/vector-premium/avion-papel-vectorial-viaje-simbolo-ruta-ilustracion-vector-avion-papel-dibujado-mano-aislado-esquema-avion-doodle-dibujado-mano-icono-avion-papel-lineal-negro_379823-1323.jpg"
                max-width="400"
                max-height="400"
                contain
                class="overflow-hidden"
              />
            </v-col>
          </v-row>
          <v-row justify="center" class="text-center mb-2">
            <v-col cols="4" class="d-flex justify-center">
              <v-progress-linear
                color="deep-purple accent-4"
                indeterminate
                rounded
                height="6"
              />
            </v-col>
          </v-row>
          <v-row justify="center" class="text-center mt-0">
            <v-card-text>
              <h1 class="my-1">
                Enviando datos a unidades
              </h1>
              <h1 class="my-2">
                de emergencia
              </h1>
              <h3 class="my-1">
                Por favor, conserva la calma.
              </h3>
              <h3 class="my-1">
                La ayuda está en camino.
              </h3>
            </v-card-text>
          </v-row>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog v-model="resDialog" persistent max-width="800px">
      <v-card>
        <v-card-title class="pa-3 d-flex justify-center" style="background-color: #0A263D; color: white;">
          Respuesta de emergencia
        </v-card-title>
        <v-card-text>
          <v-row justify="center" class="text-center mb-2">
            <v-col cols="12" class="d-flex justify-center">
              <v-img
                src="https://previews.123rf.com/images/petrdlouhy/petrdlouhy1407/petrdlouhy140700066/30115728-polic%C3%ADa-sonriente-joven-en-gafas-de-sol-muestra-los-pulgares-para-arriba.jpg"
                max-width="400"
                max-height="400"
                contain
                class="overflow-hidden"
              />
            </v-col>
          </v-row>
          <v-row justify="center" class="text-center mt-0">
            <v-card-text>
              <h1 class="my-1">
                A las fuerzas del orden
              </h1>
              <h1 class="my-2">
                les valió verga
              </h1>
              <h3 class="my-1">
                Échele ganas, joven.
              </h3>
              <h3 class="my-1">
                Usted puede.
              </h3>
            </v-card-text>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <v-row no-gutters class="w-100">
            <v-btn block color="red" style="color: white;" @click="resDialog = false">
              Cerrar
            </v-btn>
          </v-row>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-app>
</template>

<script>
import moment from 'moment'
import UiSnackbar from '~/components/ui-snackbar.vue'
import 'moment/locale/es'

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
      panicDialog: false,
      sendDialog: false,
      resDialog: false,
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
      token: '',
      nombre: '',
      img: '',

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
      minDate: '',
      Fecha: '',
      HoraSalida: '',
      Precio: '',
      Nasientos: '',
      Detalles: '',
      validForm: false
    }
  },

  computed: {
  },

  watch: {
    sendDialog (val) {
      if (val) {
        setTimeout(() => {
          this.panicDialog = false
          this.sendDialog = false
          this.resDialog = true
        }, 4000)
      }
    },

    isFormValid () {
      return this.Lsalida && this.Ldestino && this.Fecha && this.HoraSalida && this.Precio && this.Nasientos && this.validateHora(this.HoraSalida) === true
    }
  },

  created () {
    // AUTENTICACIÓN
    if (this.$store.state.token !== null || localStorage.getItem('token') !== null) {
      this.obtenerDatosUsuarios()
    } else {
      this.$router.push('/')
    }
    this.minDate = moment().format('YYYY-MM-DD')
    // this.obtenerDatosUsuarios()
  },

  mounted () {
  },

  methods: {
    handleClick (item) {
      if (item.dialog) {
        this.dialog = true
      } else {
        this.$router.push(item.to)
      }
    },

    publicarViaje () {
      this.validForm = this.$refs.form.validate()
      if (this.validForm) {
        const id = this.$store.state.user.id
        const sendData = {
          inicio: this.Lsalida,
          destino: this.Ldestino,
          fecha: this.Fecha,
          precio: this.Precio,
          capacidad: this.Nasientos,
          descripcion: this.Detalles
        }
        const params = { id }

        const url = '/home'
        this.$axios.post(url, sendData, { params })
          .then((res) => {
            this.publicarViaje = false
          })
          .catch((err) => {
            console.log('@@@ err => ', err)
            alert('Ocurrió un error al publicar el viaje. Por favor, inténtalo de nuevo.')
          })
      } else {
        alert('Faltan datos')
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
      this.user = Object.keys(this.$store.state.user).length > 0 ? this.$store.state.user : JSON.parse(localStorage.getItem('user'))
      this.$store.commit('setUser', this.user)
      this.token = this.$store.state.token ? this.$store.state.token : localStorage.getItem('token')
      this.$store.commit('setToken', this.token)
      this.nombre = this.user.nombre + ' ' + this.user.apaterno + ' ' + this.user.amaterno
      this.img = this.user.img
      console.log('🚀 ~ obtenerDatosUsuarios ~ this.$store.state.token:', this.$store.state.token)
      console.log('🚀 ~ obtenerDatosUsuarios ~ this.$store.state.user:', this.$store.state.user)
    },

    logOut () {
      localStorage.clear()
      this.$routes.push('/')
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
