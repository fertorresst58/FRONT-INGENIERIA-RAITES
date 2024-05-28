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
            <v-img
              :src="img"
            />
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
          :to="item.to"
          router
          exact
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
          {{ new Date().getFullYear() }} — <strong>Raites UG by Los Palomeros</strong>
        </v-card-text>
      </v-card>
    </v-footer>
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
      fixed: false,
      items: [
        {
          icon: 'mdi-home',
          title: 'Home',
          to: '/home'
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
      ]
    }
  },

  computed: {
    ...mapState({
      showSnackbar: state => state.showSnackbar,
      token: state => state.token
    })
  },

  watch: {
    showSnackbar () {
      // SE OBSERVA SI HUBO CAMBIOS
    }
  },

  mounted () {
    // SE EJECUTA CUANDO SE CARGA EL COMPONENTE
    // AUTENTICACION
    // if (this.$store.state.token === null) { this.$router.push('/') } else { this.obtenerDatosUsuarios() }

    this.obtenerDatosUsuarios()
  },

  methods: {
    obtenerDatosUsuarios () {
      this.user = this.$store.state.user
      this.token = this.$store.state.token
      this.nombre = this.user.nombre + ' ' + this.user.apaterno + ' ' + this.user.amaterno
      this.img = this.user.img
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
