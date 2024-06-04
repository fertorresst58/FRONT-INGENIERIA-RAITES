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
      <v-row class="d-flex justify-space-around align-content-center">
        <!-- LOGO DE LA APLICACION -->
        <v-col md="6" class="logo">
          <v-app-bar-title>
            <v-img
              max-width="360"
              max-height="100"
              class="logo-img"
              :src="require('@/assets/logo.png')"
            />
          </v-app-bar-title>
        </v-col>

        <!-- COLUMNA CORREO -->
        <v-col md="2" sm="4" style="height: 146px; margin-left: 20px">
          <v-row>
            <span class="fontTitle" style="color: white; font-size: 16px;">Correo:</span>
          </v-row>
          <v-row>
            <div style="width: 90%;" class="pt-1">
              <v-form
                ref="formLogin"
                v-model="validLogin"
                lazy-validation
              >
                <v-text-field
                  v-model="correoLogin"
                  solo
                  flat
                  dense
                  required
                  type="email"
                  class="fontTitle"
                  :rules="correoRule"
                />
              </v-form>
            </div>
          </v-row>
          <v-row justify="start" align="start" class="flex-nowrap">
            <div class="checkbox">
              <input v-model="checkboxLogin" type="checkbox" class="mr-2">
              <label class="fontTitle" style="font-size: 12px; color: white;">Mantenerse logueado</label>
            </div>
          </v-row>
        </v-col>

        <!-- COLUMNA CONTRASEÑA -->
        <v-col md="2" sm="4" style="height: 146px;">
          <v-row>
            <span class="fontTitle" style="color: white; font-size: 16px;">Contraseña:</span>
          </v-row>
          <v-row>
            <div style="width: 90%;" class="pt-1">
              <v-form
                ref="formLogin"
                v-model="validLogin"
                lazy-validation
              >
                <v-text-field
                  v-model="contrasenaLogin"
                  solo
                  flat
                  dense
                  required
                  type="password"
                  class="fontTitle"
                  :rules="passwordRule"
                />
              </v-form>
            </div>
          </v-row>
          <v-row>
            <a
              style="text-decoration: none; color: white; font-size: 12px;"
              class="fontTitle"
              @click="dialogForgotPassword = true"
            >Olvidé mi contraseña</a>
          </v-row>
        </v-col>

        <!-- COLUMNA BOTON LOGIN -->
        <v-col md="1" sm="2" style="height: 146px;" class="pl-0">
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
        <v-row class="blueBack hidden-md-only hidden-lg-only hidden-xl-only">
          <v-col sm="12" align="center" justify="center">
            <v-img
              max-width="360"
              max-height="100"
              :src="require('@/assets/logo.png')"
            />
          </v-col>
        </v-row>
        <v-row class="mt-0 pa-0">
          <!-- IMAGEN DE FONDO DEL MAIN -->
          <v-col cols="7" class="logo">
            <v-img
              :src="require('@/assets/login.jpg')"
              height="1263"
              max-height="1263"
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
                  style="font-size: 70px !important; line-height: 65px;"
                >
                  BEE RAITES
                </span>
                <span
                  class="subheading fontSubtitle textLogo my-4"
                  style="font-size: 25px !important;"
                >
                  La mejor aplicación para solicitar tu ride!
                </span>
              </v-col>
            </v-row>
          </v-col>

          <!-- FORMULARIO PARA REGISTRO DE USUARIOS -->
          <v-col md="5" sm="12">
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
                  lazy-validation
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
                    :rules="requiredRule"
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
                    Teléfono:
                  </h3>
                  <v-text-field
                    v-model="telefono"
                    v-mask="'##########'"
                    class="fontTitle"
                    dense
                    solo
                    outlined
                    flat
                    required
                    :rules="requiredRule"
                    max="9999999999"
                  />
                  <h3 class="fontTitle">
                    Campus:
                  </h3>
                  <v-select
                    v-model="campus"
                    :items="itemsCampus"
                    label="Selecciona tu campus"
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
                    Ciudad de residencia:
                  </h3>
                  <v-text-field
                    v-model="ciudad"
                    class="fontTitle"
                    dense
                    solo
                    outlined
                    flat
                    type="text"
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
          {{ new Date().getFullYear() }} — <strong>BEE RAITES by Los Palomeros</strong>
        </v-card-text>
      </v-card>
    </v-footer>

    <!-- DIALOG PARA OLVIDE MI CONTRASEÑA -->
    <v-dialog v-model="dialogForgotPassword" max-width="600px">
      <v-card elevation="0">
        <v-card-title>
          <span class="headline">Olvidé mi contraseña</span>
        </v-card-title>
        <v-card-text>
          <v-stepper v-model="step">
            <v-stepper-header>
              <v-stepper-step :complete="step > 1" step="1" color="#0A263D">
                Correo Electrónico
              </v-stepper-step>
              <v-divider />
              <v-stepper-step :complete="step > 2" step="2" color="#0A263D">
                Código de Verificación
              </v-stepper-step>
              <v-divider />
              <v-stepper-step step="3" color="#0A263D">
                Nueva Contraseña
              </v-stepper-step>
            </v-stepper-header>

            <v-stepper-items>
              <v-stepper-content step="1">
                <v-form ref="formForgotPassword" v-model="validForgotPassword" lazy-validation>
                  <h3 class="fontTitle">
                    Introduce tu correo electrónico:
                  </h3>
                  <v-text-field
                    v-model="email"
                    solo
                    flat
                    dense
                    outlined
                    required
                    :rules="correoRule"
                  />
                </v-form>
                <transition name="fade">
                  <p v-if="errorMessageusuario" class="error">
                    <v-icon class="error-icon">
                      mdi-alert-circle
                    </v-icon>
                    {{ errorMessageusuario }}
                  </p>
                </transition>
                <v-btn
                  color="#8C6E39"
                  height="38px"
                  class="white--text"
                  @click="sendResetEmail"
                >
                  Enviar
                </v-btn>
              </v-stepper-content>

              <v-stepper-content step="2">
                <v-form ref="formVerificationCode" v-model="validVerificationCode" lazy-validation>
                  <v-text-field
                    v-model="verificationCodeInput"
                    label="Código de Verificación"
                    required
                  />
                </v-form>
                <transition name="fade">
                  <p v-if="errorMessageCodigo" class="errorcodigo">
                    <v-icon class="error-iconcodigo">
                      mdi-alert-circle
                    </v-icon>
                    {{ errorMessageCodigo }}
                  </p>
                </transition>
                <v-btn
                  color="#8C6E39"
                  height="38px"
                  class="white--text"
                  :disabled="!validVerificationCode"
                  @click="verifyCode"
                >
                  Verificar
                </v-btn>
                <v-btn
                  color="blue darken-1"
                  :disabled="!codigoVerificado"
                  @click="codigoVerificado = true; step = 3"
                >
                  Continuar
                </v-btn>
                <v-btn
                  color="#8C6E39"
                  height="38px"
                  class="white--text"
                  @click="sendResetEmail"
                >
                  Reenviar código
                </v-btn>
              </v-stepper-content>

              <v-stepper-content step="3">
                <v-form ref="formNewPassword" v-model="validNewPassword" lazy-validation>
                  <v-text-field
                    v-model="email"
                    label="Correo Electrónico"
                    required
                    :rules="correoRule"
                  />
                  <v-text-field
                    v-model="newPassword"
                    label="Nueva Contraseña"
                    type="password"
                    required
                    :rules="passwordRulenueva"
                  />
                </v-form>
                <v-btn
                  color="#8C6E39"
                  height="38px"
                  class="white--text"
                  :disabled="!isPasswordValid"
                  @click="resetPassword"
                >
                  Cambiar Contraseña
                </v-btn>
              </v-stepper-content>
            </v-stepper-items>
          </v-stepper>
        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <v-btn
            color="#8C6E39"
            height="38px"
            class="white--text"
            @click="dialogForgotPassword = false"
          >
            Cancelar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <ui-snackbar />
  </v-app>
</template>

<script>
import moment from 'moment'
import '@mdi/font/css/materialdesignicons.css'
import emailjs from 'emailjs-com'
import { mask } from 'vue-the-mask'
import { mapState } from 'vuex'
import 'moment/locale/es'
import UiSnackbar from '~/components/ui-snackbar.vue'
moment.locale('es')

export default {
  name: 'IndexPage',
  components: {
    UiSnackbar
  },

  directives: {
    mask
  },

  data () {
    return {
      // VARIABLES PARA LOGIN
      validLogin: false,
      correoLogin: 'admin@ugto.mx',
      contrasenaLogin: 'adminadmin',
      checkboxLogin: false,

      // VARIABLES PARA FORMULARIO DE REGISTRO
      formRegistro: false,
      nombre: null,
      apaterno: null,
      amaterno: null,
      correo: null,
      telefono: null,
      campus: null,
      carrera: null,
      contrasena: null,
      sexo: null,
      maxDate: null,
      fechaNacimiento: null,
      ciudad: null,
      showFechaNacimiento: false,
      itemsGenero: ['Hombre', 'Mujer', 'Otro', 'Prefiero no decir'],
      itemsCampus: [
        'Celaya-Salvatierra',
        'Guanajuato',
        'Irapuato-Salamanca',
        'Leon'
      ],
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
      passwordRulenueva: [
        v => !!v || 'La contraseña es requerida',
        v => (v && v.length >= 8) || 'La contraseña debe tener al menos 8 caracteres'
      ],
      passwordConfirmRule: [
        v => v === this.contrasena || 'LAS CONTRASEÑAS NO COINCIDEN'
      ],
      dialogForgotPassword: false,
      step: 1,
      email: '',
      verificationCode: '',
      verificationCodeInput: '',
      newPassword: '',
      validForgotPassword: false,
      validVerificationCode: false,
      validNewPassword: false,
      codigoVerificado: false,
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
      e1: 1,
      telefonoRecuperacion: '',
      correoRecuperacion: '',
      contrasenaRecuperacion: '',
      confirmarContrasenaRecuperacion: '',
      otp: '',
      errorMessageusuario: null,
      errorMessageCodigo: ''
    }
  },

  computed: {
    ...mapState({
      showSnackbar: state => state.showSnackbar
    }),

    formatearFecha () {
      return this.fechaNacimiento ? moment(this.fechaNacimiento, 'YYYY-MM-DD').format('dddd, DD [de] MMMM [de] YYYY') : ''
    },
    isPasswordValid () {
      return this.newPassword && this.newPassword.length >= 8
    }
  },

  watch: {
    showSnackbar () {},
    contrasena () {}
  },

  created () {
    this.maxDate = moment().subtract(18, 'years').format('YYYY-MM-DD')

    if (localStorage.getItem('token')) {
      this.$router.push('/home')
    }
  },

  methods: {
    async sendResetEmail () {
      const url = '/userfind/' + this.email
      const email = this.email
      const params = { email }
      try {
        const res = await this.$axios.get(url, { params })
        if (res.data.success) {
          try {
            const verificationCode = Math.floor(100000 + Math.random() * 900000) // Generar un código de verificación aleatorio de 6 dígitos

            const templateParams = {
              to_email: this.email,
              verification_code: verificationCode
            }

            this.verificationCode = verificationCode // Guardar el código de verificación para la validación

            const response = await emailjs.send('service_qccslyk', 'template_m1zhp89', templateParams, 'Vl2L6MP3-0OOpT5oV')
            if (response.status === 200) {
              this.step = 2
            } else {
              console.error('Error enviando el correo:', response.text)
            }
          } catch (error) {
            console.error('Error enviando el correo:', error)
          }
        }
      } catch (error) {
        console.error('Error al recuperar los datos:', error)
        this.errorMessageusuario = 'Correo no encontrado'
      }
    },
    verifyCode () {
      if (this.verificationCodeInput === '') {
        this.$store.commit('modifySnackbar', true)
        this.$store.commit('modifyColor', 'red darken-4')
        this.$store.commit('modifyIcon', 'mdi-check-circle')
        this.$store.commit('modifyText', 'CÓDIGO DE VERIFICACIÓN VACIÓ')
        return // Salir de la función si el código de verificación está vacío
      }

      if (this.verificationCode.toString() === this.verificationCodeInput.toString()) {
        this.codigoVerificado = true
        this.errorMessageCodigo = ''
        this.step = 3
      } else {
        this.$store.commit('modifySnackbar', true)
        this.$store.commit('modifyColor', 'red darken-4')
        this.$store.commit('modifyIcon', 'mdi-check-circle')
        this.$store.commit('modifyText', 'CODIGO DE VERIFICACIÓN INCORRECTO')
      }
    },

    resetPassword () {
      if (!this.newPassword) {
        console.error('Por favor, ingresa una nueva contraseña')
        return
      }

      if (this.newPassword) {
        // Aquí podrías implementar la lógica para cambiar la contraseña, p.ej., actualizar el estado en tu aplicación
        this.$store.commit('modifySnackbar', true)
        this.$store.commit('modifyColor', 'green darken-4')
        this.$store.commit('modifyIcon', 'mdi-check-circle')
        this.$store.commit('modifyText', 'CONTRASEÑA CAMBIADA CORRECTAMENTE')
        this.step = 1
        this.dialogForgotPassword = false
      } else {
        this.$store.commit('modifySnackbar', true)
        this.$store.commit('modifyColor', 'red darken-4')
        this.$store.commit('modifyIcon', 'mdi-check-circle')
        this.$store.commit('modifyText', 'POR FAVOR, INGRESA UNA NUEVA CONTRASEÑA')
      }

      const url = '/updatePassword'
      const params = { email: this.email, password: this.newPassword }

      this.$axios.put(url, params)
        .then((res) => {
          if (res.data.success) {
            console.log('Contraseña cambiada correctamente')
            this.step = 1
            this.dialogForgotPassword = false
          } else {
            console.error('Error al cambiar la contraseña:', res.data.message)
          }
        })
        .catch((error) => {
          console.error('Error al recuperar los datos:', error)
        })
    },

    async login () {
      this.validLogin = this.$refs.formLogin.validate()

      if (this.validLogin) {
        const sendData = {
          email: this.correoLogin,
          password: this.contrasenaLogin
        }

        await this.$auth.loginWith('local', {
          data: sendData
        }).then(async (res) => {
          const result = await res.data
          if (result.success) {
            this.$store.commit('setUser', result.user)
            this.$store.commit('setToken', result.token)
            if (this.checkboxLogin) {
              localStorage.setItem('token', result.token)
              localStorage.setItem('user', JSON.stringify(result.user))
            }
            this.$store.commit('modifySnackbar', true)
            this.$store.commit('modifyColor', 'green darken-4')
            this.$store.commit('modifyIcon', 'mdi-check-circle')
            this.$store.commit('modifyText', 'LOGIN EXITOSO')
            this.$router.push('/home')
          }
        }).catch((error) => {
        // eslint-disable-next-line no-console
          console.log('ERROR -> ', error)
        })
      } else {
        this.$store.commit('modifySnackbar', true)
        this.$store.commit('modifyColor', 'red darken-4')
        this.$store.commit('modifyIcon', 'mdi-alert-circle')
        this.$store.commit('modifyText', 'FALTAN DATOS POR LLENAR')
      }
    },

    signUp () {
      this.formRegistro = this.$refs.formRegistro.validate()
      if (this.formRegistro) {
        const data = {
          nombre: this.nombre.toUpperCase(),
          apaterno: this.apaterno.toUpperCase(),
          amaterno: this.amaterno.toUpperCase(),
          sexo: this.sexo.toUpperCase(),
          email: this.correo,
          password: this.contrasena,
          telefono: this.telefono,
          campus: this.campus.toUpperCase(),
          carrera: this.carrera.toUpperCase(),
          fechaNac: this.fechaNacimiento,
          ciudad: this.ciudad.toUpperCase()
        }
        const url = '/signup'
        this.$axios.post(url, data)
          .then((res) => {
            if (res.data.success) {
              this.$store.commit('modifySnackbar', true)
              this.$store.commit('modifyColor', 'green darken-4')
              this.$store.commit('modifyIcon', 'mdi-check-circle')
              this.$store.commit('modifyText', res.data.message)
            }
          })
          .catch((error) => {
            // eslint-disable-next-line no-console
            console.log('ERROR EN REGISTRO => ', error)
            this.$store.commit('modifySnackbar', true)
            this.$store.commit('modifyColor', 'red darken-4')
            this.$store.commit('modifyIcon', 'mdi-alert-circle')
            this.$store.commit('modifyText', 'EL CORREO YA ESTA REGISTRADO, INTENTE DE NUEVO')
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

@media (max-width: 960px) {
  .logo {
    display: none;
  }
}

.logo-img {
  position: relative;
  top: 50%;
}

.error {
  color: white;
  font-size: 16px;
  font-weight: bold;
  margin-top: 10px;
  display: flex;
  align-items: center;
  transition: opacity 0.3s ease-in-out;
}

.error-icon {
  margin-right: 8px;
  font-size: 20px;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease-in-out;
}
.fade-enter, .fade-leave-to /* .fade-leave-active en versiones <2.1.8 */ {
  opacity: 0;
}

.errorcodigo {
  color: white;
  background-color: red;
  padding: 10px;
  border-radius: 5px;
  display: flex;
  align-items: center;
}

.error-iconcodigo {
  margin-right: 8px;
}
</style>
