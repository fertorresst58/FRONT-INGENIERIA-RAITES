<template>
  <v-app>
    <!-- BARRA DE ARRIBA -->
    <v-app-bar
      app
      absolute
      prominent
      style="height: 146px;"
      flat
      color="#0A263D"
      class="pt-5"
    >
      <v-row>
        <!-- LOGO DE LA APLICACION -->
        <v-col cols="7">
          <v-app-bar-title>
            <v-img
              contain
              max-width="200"
              max-height="100"
              :src="require('@/assets/logo.svg')"
            />
          </v-app-bar-title>
        </v-col>

        <!-- COLUMNA CORREO -->
        <v-col cols="2" style="height: 146px;">
          <v-row>
            <span class="fontTitle" style="color: white; font-size: 16px;">Correo:</span>
          </v-row>
          <v-row>
            <div style="width: 90%;" class="pt-1">
              <v-text-field
                v-model="correoLogin"
                solo
                flat
                dense
                type="email"
                class="fontTitle"
              />
            </div>
          </v-row>
          <v-row justify="start" align="start" class="flex-nowrap">
            <div class="checkbox">
              <input v-model="checkbox" type="checkbox" class="mr-2">
              <label class="fontTitle" style="font-size: 12px; color: white;">Mantenerse logueado</label>
            </div>
          </v-row>
        </v-col>

        <!-- COLUMNA CONTRASEÑA -->
        <v-col cols="2" style="height: 146px;">
          <v-row>
            <span class="fontTitle" style="color: white; font-size: 16px;">Contraseña:</span>
          </v-row>
          <v-row>
            <div style="width: 90%;" class="pt-1">
              <v-text-field
                v-model="contrasenaLogin"
                solo
                flat
                dense
                type="password"
                class="fontTitle"
              />
            </div>
          </v-row>
          <v-row>
            <a
              style="text-decoration: none; color: white; font-size: 12px;"
              class="fontTitle"
              @click="showPassword = !showPassword"
            >
              Olvide mi contraseña
            </a>
          </v-row>
        </v-col>

        <!-- COLUMNA BOTON LOGIN -->
        <v-col cols="1" style="height: 146px;" class="pl-0">
          <div class="pt-4">
            <v-btn block color="#FFD300" height="38px" width="90%" @click="login()">
              <span class="fontTitle" style="text-transform: none; color: black">Log In</span>
            </v-btn>
          </div>
        </v-col>
      </v-row>
    </v-app-bar>

    <!-- MAIN -->
    <v-container fluid>
      <v-main>
        <v-row class="mt-0 pa-0">
          <!-- IMAGEN DE FONDO DEL MAIN -->
          <v-col cols="7">
            <v-img
              :src="require('@/assets/login.jpg')"
              height="1087"
              max-height="1087"
              style="filter: blur(3px);"
            />
            <v-row
              class="textImgLogo text-center"
            >
              <v-col
                cols="12"
                justify="center"
                align="center"
                class="d-flex flex-column"
                style="width: 400px !important;"
              >
                <span
                  class="text-h4 font-weight-bold mb-4 dark fontTitle textLogo"
                  style="font-size: 70px !important;"
                >
                  Raites UG
                </span>
                <span
                  class="subheading fontSubtitle textLogo my-4"
                  style="font-size: 25px !important;"
                >
                  La mejor aplicacion para solicitar tu ride!
                </span>
              </v-col>
            </v-row>
          </v-col>

          <!-- FORMULARIO PARA REGISTRO DE USUARIOS -->
          <v-col cols="5">
            <v-card flat outlined>
              <v-card-title class="fontTitle">
                Registrarse
              </v-card-title>

              <v-card-subtitle class="fontSubtitle">
                Es gratis y siempre lo sera
              </v-card-subtitle>

              <v-divider />

              <v-card-text>
                <v-form
                  ref="formRegistro"
                  v-model="formRegistro"
                  @submit.prevent="submit"
                >
                  <h3 class="fontTitle">
                    Nombre:
                  </h3>
                  <v-text-field
                    v-model="nombre"
                    class="fontTitle"
                    dense
                    solo
                    outlined
                    flat
                    required
                    type="text"
                    :rules="requiredRule"
                  />
                  <h3 class="fontTitle">
                    Apellido Paterno:
                  </h3>
                  <v-text-field
                    v-model="apaterno"
                    class="fontTitle"
                    dense
                    solo
                    outlined
                    flat
                    required
                    type="text"
                    :rules="requiredRule"
                  />
                  <h3 class="fontTitle">
                    Apellido Materno:
                  </h3>
                  <v-text-field
                    v-model="amaterno"
                    class="fontTitle"
                    dense
                    solo
                    outlined
                    flat
                    type="text"
                  />
                  <h3 class="fontTitle">
                    Correo:
                  </h3>
                  <v-text-field
                    v-model="correo"
                    class="fontTitle"
                    dense
                    solo
                    outlined
                    flat
                    required
                    type="email"
                    :rules="correoRule"
                  />
                  <h3 class="fontTitle">
                    Telefono:
                  </h3>
                  <v-text-field
                    v-model="telefono"
                    class="fontTitle"
                    dense
                    solo
                    outlined
                    flat
                    required
                    type="text"
                    :rules="requiredRule"
                  />
                  <h3 class="fontTitle">
                    Carrera:
                  </h3>
                  <v-select
                    v-model="carrera"
                    :items="itemsCarrera"
                    label="Selecciona tu carrera"
                    dense
                    solo
                    outlined
                    flat
                    required
                    type="text"
                    class="fontTitle"
                    :rules="requiredRule"
                  />
                  <h3 class="fontTitle">
                    Contraseña:
                  </h3>
                  <v-text-field
                    v-model="contrasena"
                    class="fontTitle"
                    dense
                    solo
                    outlined
                    flat
                    required
                    type="password"
                    :rules="passwordRule"
                  />
                  <h3 class="fontTitle">
                    Confirmar contraseña:
                  </h3>
                  <v-text-field
                    class="fontTitle"
                    dense
                    solo
                    outlined
                    flat
                    required
                    type="password"
                    :rules="passwordConfirmRule"
                  />
                  <h3 class="fontTitle">
                    Sexo:
                  </h3>
                  <v-select
                    v-model="sexo"
                    :items="itemsGenero"
                    label="Selecciona tu sexo"
                    dense
                    solo
                    outlined
                    flat
                    required
                    class="fontTitle"
                    :rules="requiredRule"
                  />
                  <h3 class="fontTitle">
                    Fecha de nacimiento:
                  </h3>
                  <v-menu
                    v-model="showFechaNacimiento"
                    min-width="290"
                    origin="center center"
                    transition="scale-transition"
                    :close-on-content-click="false"
                  >
                    <template #activator="{ on, attrs }">
                      <v-text-field
                        :value="formatearFecha"
                        class="fontTitle"
                        clearable
                        label="Fecha de nacimiento"
                        v-bind="attrs"
                        dense
                        solo
                        outlined
                        flat
                        required
                        append-icon="mdi-menu-down"
                        :rules="requiredRule"
                        v-on="on"
                        @click:clear="fechaNacimiento = null"
                      />
                    </template>
                    <v-date-picker
                      v-model="fechaNacimiento"
                      elevation="0"
                      color="#8C6E39"
                      header-color="#0A263D"
                      locale="es-mx"
                      :max="maxDate"
                      :show-current="maxDate"
                      @change="showFechaNacimiento = false"
                    />
                  </v-menu>
                </v-form>
              </v-card-text>

              <v-card-actions>
                <v-row class="mb-5">
                  <v-col cols="3" />
                  <v-col cols="6">
                    <v-btn
                      block
                      color="#8C6E39"
                      height="38px"
                      width="90%"
                      @click="signUp()"
                    >
                      <span class="fontTitle" style="text-transform: none; color: white">Registrarse</span>
                    </v-btn>
                  </v-col>
                  <v-col cols="3" />
                </v-row>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-main>
    </v-container>

    <!-- FOOTER -->
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

    <!-- DIALOG PARA OLVIDE MI CONTRASEÑA -->
    <v-dialog v-model="showPassword" width="50%">
      <v-stepper v-model="e1">
        <v-stepper-header>
          <v-stepper-step
            :complete="e1 > 1"
            step="1"
          >
            Identificación
          </v-stepper-step>

          <v-divider />

          <v-stepper-step
            :complete="e1 > 2"
            step="2"
          >
            Verificación
          </v-stepper-step>

          <v-divider />

          <v-stepper-step step="3">
            Cambio de contraseña
          </v-stepper-step>
        </v-stepper-header>

        <v-stepper-items>
          <v-stepper-content step="1">
            <v-card
              class="mb-12"
              color="grey lighten-1"
              height="200px"
            >
              HOLA MUNDO
            </v-card>

            <v-btn
              color="primary"
              @click="e1 = 2"
            >
              Continue
            </v-btn>

            <v-btn text @click="showPassword=false">
              Cancel
            </v-btn>
          </v-stepper-content>

          <v-stepper-content step="2">
            <v-card
              class="mb-12"
              color="grey lighten-1"
              height="200px"
            />

            <v-btn
              color="primary"
              @click="e1 = 3"
            >
              Continue
            </v-btn>

            <v-btn text @click="showPassword=false">
              Cancel
            </v-btn>
          </v-stepper-content>

          <v-stepper-content step="3">
            <v-card
              class="mb-12"
              color="grey lighten-1"
              height="200px"
            />

            <v-btn
              color="primary"
              @click="e1 = 1"
            >
              Continue
            </v-btn>

            <v-btn text @click="showPassword=false">
              Cancel
            </v-btn>
          </v-stepper-content>
        </v-stepper-items>
      </v-stepper>
    </v-dialog>

    <ui-snackbar />
  </v-app>
</template>

<script>
import moment from 'moment'
import { mapState } from 'vuex'
import 'moment/locale/es'
import UiSnackbar from '~/components/ui-snackbar.vue'
moment.locale('es')

export default {
  name: 'IndexPage',
  components: {
    UiSnackbar
  },

  data () {
    return {
      // VARIABLES PARA LOGIN
      correoLogin: null,
      contrasenaLogin: null,
      checkbox: false,

      // VARIABLES PARA FORMULARIO DE REGISTRO
      formRegistro: false,
      nombre: null,
      apaterno: null,
      amaterno: null,
      correo: null,
      telefono: null,
      carrera: null,
      contrasena: null,
      sexo: null,
      maxDate: null,
      fechaNacimiento: null,
      showFechaNacimiento: false,
      itemsGenero: ['Hombre', 'Mujer', 'Otro', 'Prefiero no decir'],
      itemsCarrera: [
        'Arquitectura',
        'Artes Escénicas',
        'Artes Digitales',
        'Artes Visuales',
        'Diseño Gráfico',
        'Diseño de Interiores',
        'Música',
        'Agronegocios',
        'Gestión Empresarial',
        'Administración',
        'Administración Financiera',
        'Administración de la Calidad y la Productividad',
        'Desarrollo Regional',
        'Mercadotecnia',
        'Administración de Recursos Turísticos',
        'Comercio Internacional',
        'Contador Público',
        'Economía',
        'Relaciones Industriales',
        'Sistemas de Información Administrativa',
        'Biología Experimental',
        'Computación Matemática',
        'Ingeniería Química',
        'Matemáticas',
        'Química',
        'Químico Farmacéutico Biólogo',
        'Educación',
        'Enseñanza del Español como Segunda Lengua',
        'Enseñanza del Inglés',
        'Filosofía',
        'Historia',
        'Letras Españolas',
        'Antropología Social',
        'Cultura y Arte',
        'Desarrollo y Gestión del Territorio',
        'Sociología',
        'Trabajo Social',
        'Administración Pública',
        'Ciencia Política',
        'Derecho',
        'Geografía',
        'Física',
        'Ingeniería Biomédica',
        'Ingeniería Física',
        'Ingeniería Química Sustentable',
        'Ingeniería Ambiental',
        'Ingeniería Civil',
        'Ingeniería en Geomática',
        'Ingeniería en Minas',
        'Ingeniería Hidráulica',
        'Ingeniería Metalúrgica',
        'Ingeniero Geólogo',
        'Ingeniería Agroindustrial',
        'Ingeniería en Biotecnología',
        'Ingeniería Agrónica',
        'Ingeniería en Agronomía',
        'Ingeniería en Alimentos',
        'Ingeniería Eléctrica',
        'Ingeniería en Comunicaciones y Electrónica',
        'Ingeniería en Sistemas Computacionales',
        'Ingeniería Mecánica',
        'Ingeniería Mecatrónica',
        'Ingeniería en Energías Renovables',
        'Medicina Veterinaria y Zootecnia',
        'Enfermería y Obstetricia',
        'Nutrición',
        'Psicología Clínica',
        'Fisioterapia',
        'Psicología',
        'Ciencias de la Actividad Física y Salud',
        'Médico Cirujano'
      ],
      requiredRule: [
        v => !!v || 'CAMPO REQUERIDO'
      ],
      passwordRule: [
        v => (v && v.length > 7) || 'LA CONTRASEÑA DEBE DE TENER MINIMO 8 CARACTERES'
      ],
      passwordConfirmRule: [
        v => v === this.contrasena || 'LAS CONTRASEÑAS NO COINCIDEN'
      ],
      correoRule: [
        v => /.+@ugto\.mx$/.test(v) || 'EMAIL INCORRECTO SOLO CORREO INSTITUCIONAL'
      ],

      // VARIABLES DE FOOTER
      icons: [
        'mdi-facebook',
        'mdi-twitter',
        'mdi-instagram'
      ],

      // VARIABLES PARA OLVIDE MI CONTRASEÑA
      showPassword: false,
      e1: 1
    }
  },

  computed: {
    ...mapState({
      showAlert: state => state.showAlert
    }),

    formatearFecha () {
      return this.fechaNacimiento ? moment(this.fechaNacimiento, 'YYYY-MM-DD').format('dddd, DD [de] MMMM [de] YYYY') : ''
    }
  },

  watch: {
    showAlert () {
    }
  },

  created () {
    this.maxDate = moment().subtract(18, 'years').format('YYYY-MM-DD')
  },

  methods: {
    async login () {
      const sendData = {
        email: this.correoLogin,
        password: this.contrasenaLogin
      }

      await this.$auth.loginWith('local', {
        data: sendData
      }).then(async (res) => {
        const result = await res.data
        if (result.message === 'success') {
          this.$store.commit('setToken', result.token)
          this.$store.commit('modifySnackbar', true)
          this.$store.commit('modifyColor', 'green darken-4')
          this.$store.commit('modifyText', 'LOGIN EXITOSO')
          this.$store.commit('modifyTimeout', '1500')
          this.$store.commit('modifyIcon', 'mdi-check')
          setTimeout(() => {
            this.$router.push('/home')
          }, 2000)
        }
      }).catch((error) => {
        // eslint-disable-next-line no-console
        console.log('ERROR -> ', error)
      })
    },

    signUp () {
      this.formRegistro = this.$refs.formRegistro.validate()
      if (this.formRegistro) {
        const data = {
          nombre: this.nombre,
          apaterno: this.apaterno,
          amaterno: this.amaterno,
          sexo: this.sexo,
          email: this.correo,
          password: this.contrasena,
          telefono: this.telefono,
          carrera: this.carrera,
          fechaNac: this.fechaNacimiento
        }
        const url = '/signup'
        this.$axios.post(url, data)
          .then((res) => {
            if (res.data.message === 'USUARIO REGISTRADO SATISFACTORIAMENTE') {
              // eslint-disable-next-line no-console
              console.log('REGISTRADO CORRECTAMENTE')

              this.$store.commit('modifyAlert', true)
              this.$store.commit('modifyColor', 'green darken-4')
              this.$store.commit('modifyIcon', 'mdi-check-circle')
              this.$store.commit('modifyType', 'success')
              this.$store.commit('modifyText', res.data.message)
              // setTimeout(() => {
              //   this.$store.commit('modifyAlert', false)
              //   this.showDialog = false
              // }, 1000)
            } else {
              // eslint-disable-next-line no-console
              console.log('ERROR AL REGISTRARSE')
            }
          })
          .catch((error) => {
            // eslint-disable-next-line no-console
            console.log('ERROR EN REGISTRO => ', error)
          })
      }
    }
  }
}
</script>

<style scoped>
.checkbox {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: center;
  align-content: center;
  align-items: stretch;
}

.textImgLogo {
  position: absolute;
  top: 50%;
  left: 30%;
  transform: translate(-50%, -50%);
}

.textLogo {
  text-shadow: 0 0 20px rgba(0,0,0,0.97);
  color: white;
}

.alerta {
  z-index: 1000;
}
</style>
