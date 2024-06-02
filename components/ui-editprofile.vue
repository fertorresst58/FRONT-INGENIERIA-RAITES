<template>
  <v-card class="pa-10">
    <v-card-title class="mb-10 text-center d-flex justify-center">
      <strong class="text-center fontTitle" style="font-size: 30px;">ACTUALIZAR PERFIL</strong>
    </v-card-title>

    <v-card-text>
      <v-form
        ref="formActualizar"
        v-model="formActualizar"
        lazy-validation
        @submit.prevent="submit"
      >
        <h3 class="fontTitle">
          Foto de perfil (Solo URL):
        </h3>
        <v-text-field
          v-model="foto"
          class="fontTitle"
          dense
          solo
          outlined
          flat
          required
          type="url"
          :rules="requiredRule"
        />
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
          class="fontTitle"
          dense
          solo
          outlined
          flat
          required
          type="tel"
          :rules="requiredRule"
        />
        <h3 class="fontTitle">
          Campus:
        </h3>
        <v-combobox
          v-model="campus"
          :items="itemsCampus"
          label="Selecciona tu campus"
          hide-selected
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
        <v-combobox
          v-model="carrera"
          :items="itemsCarrera"
          label="Selecciona tu carrera"
          hide-selected
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
          Sexo:
        </h3>
        <v-select
          v-model="sexo"
          :items="itemsGenero"
          label="Selecciona tu sexo"
          hide-selected
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
          Descripción:
        </h3>
        <v-textarea
          v-model="description"
          class="fontTitle"
          dense
          solo
          outlined
          flat
          type="text"
          :rules="requiredRule"
        />
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
            @click="update()"
          >
            <span class="fontTitle" style="text-transform: none; color: white">ACTUALIZAR</span>
          </v-btn>
        </v-col>
        <v-col cols="3" />
      </v-row>
    </v-card-actions>
  </v-card>
</template>

<script>
import moment from 'moment'
import 'moment/locale/es'

export default {
  name: 'UiEditProfile',

  data () {
    return {
      formActualizar: false,
      foto: null,
      description: null,
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
        'Irapauto-Salamanca',
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
      correoRule: [
        v => /.+@ugto\.mx$/.test(v) || 'EMAIL INCORRECTO SOLO CORREO INSTITUCIONAL'
      ]
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
    async update () {
      try {
        const url = '/updateUser'
        const data = {
          id: this.$store.state.user.id,
          nombre: this.nombre.toUpperCase(),
          apaterno: this.apaterno.toUpperCase(),
          amaterno: this.amaterno.toUpperCase(),
          sexo: this.sexo.toUpperCase(),
          email: this.correo,
          telefono: this.telefono,
          carrera: this.carrera.toUpperCase(),
          fecha_nac: this.fechaNacimiento,
          des: this.description.toUpperCase(),
          img: this.foto,
          ciudad: this.ciudad.toUpperCase(),
          campus: this.campus.toUpperCase()
        }
        const response = await this.$axios.put(url, data)

        if (response.data.message === 'success') {
          this.closeDialog()
        } else {
          console.error('Error al actualizar información del usuario:', response.data.message)
        }
      } catch (error) {
        console.error('Error al enviar solicitud de actualización:', error)
      }
    },

    closeDialog () {
      this.$emit('closeDialog')
    }
  }
}
</script>

<style lang="scss" scoped>

</style>
