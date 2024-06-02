<template>
  <v-col cols="12">
    <v-row align="center" justify="center">
      <v-card
        elevation="10"
        width="50vw"
        class="pa-5"
      >
        <v-card-title class="mb-10 text-center">
          <v-row>
            <v-col cols="12">
              <strong class="text-center fontTitle" style="font-size: 30px;">INFORMACIÓN DEL USUARIO</strong>
            </v-col>
          </v-row>
        </v-card-title>

        <v-row align="center" justify="center">
          <v-col cols="12" align="center" justify="center">
            <v-avatar
              size="128"
            >
              <v-img
                :src="user.img"
              />
            </v-avatar>
            <h2 class="text-center fontTitle">
              {{ user.nombre }} {{ user.apaterno }} {{ user.amaterno }}
            </h2>
            <p class="text-center fontSubtitle">
              {{ user.email }}
            </p>
          </v-col>
        </v-row>

        <v-card-text>
          <v-row>
            <v-col cols="6">
              <h3 class="text-center fontSubtitle">
                {{ user.sexo }}
              </h3>
            </v-col>

            <v-col cols="6">
              <h3 class="text-center fontSubtitle">
                {{ calculateAge(user.fechaNac) }} Años
              </h3>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12">
              <h3 class="text-center fontSubtitle">
                {{ user.carrera }}
              </h3>
              <h3 class="text-center fontSubtitle">
                <v-icon>mdi-school</v-icon> {{ user.campus }}
              </h3>
            </v-col>
          </v-row>
          <v-row align="center" justify="center">
            <v-col cols="12" class="text-center">
              <h3 class="text-center fontSubtitle">
                {{ user.des }}
              </h3>
            </v-col>
          </v-row>

          <v-divider class="ma-5" />

          <v-row align="center" justify="center">
            <v-col cols="12" class="text-center">
              <h2 class="text-center fontSubtitle pb-5" style="font-size: 18px;">
                CONTACTO:
              </h2>
              <h3 class="text-center fontSubtitle">
                <v-icon>mdi-email</v-icon> {{ user.email }}
              </h3>
              <h3 class="text-center fontSubtitle">
                <v-icon>mdi-phone</v-icon> {{ user.telefono }}
              </h3>
              <h3 class="text-center fontSubtitle">
                <v-icon>mdi-map-marker</v-icon> {{ user.ciudad }}
              </h3>
            </v-col>
          </v-row>
        </v-card-text>

        <v-card-actions>
          <v-spacer />
          <v-btn
            color="#8C6E39"
            height="38px"
            class="white--text"
            @click="dialogProfile = true"
          >
            <span>EDITAR PERFIL</span>
          </v-btn>
          <v-spacer />
        </v-card-actions>
      </v-card>

      <v-dialog v-model="dialogProfile" persistent width="700" class="pa-0 ma-0">
        <edit-profile @closeDialog="closeDialog" />
      </v-dialog>
    </v-row>
  </v-col>
</template>

<script>
import editProfile from '@/components/ui-editprofile.vue'

export default {
  components: {
    editProfile
  },

  layout: 'home',
  auth: true,
  data () {
    return {
      user: {},
      dialogProfile: false
    }
  },

  mounted () {
    // SE EJECUTA CUANDO SE CARGA EL COMPONENTE
    // AUTENTICACIÓN
    // if (this.$store.state.token === null) { this.$router.push('/') } else { this.obtenerDatosUsuarios() }
    this.obtenerDatosUsuarios()
  },

  methods: {
    closeDialog () {
      this.dialogProfile = false
      localStorage.clear()
      location.reload()
    },

    obtenerDatosUsuarios () {
      this.user = this.$store.state.user
      this.token = this.$store.state.token
    },

    calculateAge (birthdate) {
      const today = new Date()
      const birthDate = new Date(birthdate)
      let age = today.getFullYear() - birthDate.getFullYear()
      const month = today.getMonth() - birthDate.getMonth()
      if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
        age--
      }
      return age
    }
  }
}
</script>
