<template>
  <v-app>
    <v-app-bar
      app
      prominent
      style="height: 146px;"
      flat
      color="#0A263D"
      class="pt-5"
    >
      <v-row>
        <v-col cols="7">
          <v-app-bar-title>
            <v-img
              contain
              max-width="200"
              max-height="90"
              :src="require('@/assets/logo.png')"
            />
          </v-app-bar-title>
        </v-col>

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

        <v-col cols="1" style="height: 146px;" class="pl-0">
          <div class="pt-4">
            <v-btn block color="#FFD300" height="38px" width="90%" @click="login()">
              <span class="fontTitle" style="text-transform: none; color: black">Log In</span>
            </v-btn>
          </div>
        </v-col>
      </v-row>
    </v-app-bar>

    <v-container fluid>
      <v-main>
        <v-row class="mt-0 pa-0">
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
              >
                <h1 class="text-h4 font-weight-bold mb-4 dark fontTitle">
                  Raites UG
                </h1>
                <h4 class="subheading">
                  La mejor aplicacion para solicitar tu ride, foraneo!
                </h4>
              </v-col>
            </v-row>
          </v-col>

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
                <v-form>
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
                    class="fontTitle"
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
                  />
                  <h3 class="fontTitle">
                    Confirmar contraseña:
                  </h3>
                  <v-text-field
                    v-model="confirmarContrasena"
                    class="fontTitle"
                    dense
                    solo
                    outlined
                    flat
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
                    class="fontTitle"
                  />
                  <h3 class="fontTitle">
                    Fecha de necimiento:
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
                        append-icon="mdi-menu-down"
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
            />

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
  </v-app>
</template>

<script>
import moment from 'moment'
import 'moment/locale/es'
moment.locale('es')

export default {
  name: 'Login',
  data () {
    return {
      correoLogin: null,
      contrasenaLogin: null,
      checkbox: false,

      nombre: null,
      apaterno: null,
      amaterno: null,
      correo: null,
      telefono: null,
      carrera: null,
      contrasena: null,
      confirmarContrasena: null,
      sexo: null,
      maxDate: null,
      fechaNacimiento: null,
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
      icons: [
        'mdi-facebook',
        'mdi-twitter',
        'mdi-instagram'
      ],
      showPassword: false,
      showFechaNacimiento: false,
      e1: 1
    }
  },

  computed: {
    formatearFecha () {
      return this.fechaNacimiento ? moment(this.fechaNacimiento, 'YYYY-MM-DD').format('dddd, DD [de] MMMM [de] YYYY') : ''
    }
  },

  created () {
    this.maxDate = moment().subtract(18, 'years').format('YYYY-MM-DD')
  },

  methods: {
    login () {
      // eslint-disable-next-line no-console
      console.log('EMAIL => ', this.correoLogin)
      // eslint-disable-next-line no-console
      console.log('PASSWORD => ', this.contrasenaLogin)
      // eslint-disable-next-line no-console
      console.log('CHECKBOX => ', this.checkbox)
    },

    signUp () {
      const newUser = [
        // eslint-disable-next-line camelcase
        {
          usu_nombre: this.nombre,
          usu_apaterno: this.apaterno,
          usu_amaterno: this.amaterno,
          usu_correo: this.correo,
          usu_telefono: this.telefono,
          usu_carrera: this.carrera,
          usu_password: this.constrasena,
          usu_sexo: this.sexo,
          usu_fechaNacimiento: this.fechaNacimiento
        }
      ]

      // eslint-disable-next-line no-console
      console.log('NUEVO USUARIO => ', newUser[0])
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
</style>
