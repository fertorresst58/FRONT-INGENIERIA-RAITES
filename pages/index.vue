<template>
  <v-app>
    <!-- BARRA DE ARRIBA -->
    <v-app-bar
      app
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
              max-height="90"
              :src="require('@/assets/logo.png')"
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
              class="mb-12 no-border"
              color="white"
              height="200px"
            >
              <v-card-title class="justify-center" style="font-size: 20px;">
                Ingrese su numero de telefono y correo con el que realizo su registro
              </v-card-title>
              <h4 class="fontTitle">
                Telefono:
              </h4>
              <v-text-field
                v-model="telefono"
                width="50px"
                class="fontTitle"
                dense
                solo
                outlined
              />
              <h4 class="fontTitle">
                Email:
              </h4>
              <v-text-field
                v-model="correo"
                width="50px"
                class="fontTitle"
                dense
                solo
                outlined
              />
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
              class="mb-12 no-border"
              align="center"
              color="white"
              height="200px"
              flat
            >
              <v-card-title class="justify-center" style="font-size: 20px;">
                Hemos enviado un codigo a su correo.
                Por favor ingrese el codigo
              </v-card-title>
              <v-img
                class="justify-center"
                src="data:image/jpeg;base64,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"
                alt="Descripción de la imagen"
                width="100"
                height="100"
                flat
              />
              <h4
                class="fontTitle"
                align="left"
              >
                Codigo:
              </h4>
              <v-text-field
                v-model="telefono"
                width="50px"
                class="fontTitle"
                dense
                solo
                outlined
              />
            </v-card>

            <v-btn color="primary" @click="e1 = 3">
              Continue
            </v-btn>
            <v-btn text @click="showPassword=false">
              Cancel
            </v-btn>
          </v-stepper-content>

          <v-stepper-content step="3">
            <v-card
              class="mb-12 no-border"
              color="white"
              height="200px"
            >
              <v-card-title class="justify-center" style="font-size: 20px;">
                Ingrese su nueva contraseña
              </v-card-title>
              <h4 class="fontTitle">
                Contraseña:
              </h4>
              <v-text-field
                v-model="contrasena"
                width="50px"
                class="fontTitle"
                dense
                solo
                outlined
              />
              <h4 class="fontTitle">
                Confirmar Nueva Contraseña:
              </h4>
              <v-text-field
                v-model="confirmarContrasena"
                width="50px"
                class="fontTitle"
                dense
                solo
                outlined
              />
            </v-card>

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
