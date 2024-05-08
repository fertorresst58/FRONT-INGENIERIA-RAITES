<template>
  <v-app>
    <v-navigation-drawer
      v-model="drawer"
      :mini-variant="miniVariant"
      :clipped="clipped"
      fixed
      app
      width="15%"
    >
      <v-list>
        <v-list-item>
          <v-list-item-avatar>
            <v-img
              :src="require('@/assets/avatar.png')"
            />
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title class="fontTitle" color="black">
              NOMBRE DEL USUARIO
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
      fixed
      app
      flat
      color="#0A263D"
    >
      <v-app-bar-nav-icon color="white" @click.stop="drawer = !drawer" />

      <v-spacer />

      <v-toolbar-title>
        <span style="color: white;">{{ title }}</span>
      </v-toolbar-title>

      <v-spacer />

      <v-btn
        elevation="0"
        color="#FFD300"
      >
        <span class="fontTitle" style="text-transform: none;">Cerrar sesión <v-icon>mdi-logout</v-icon> </span>
      </v-btn>
    </v-app-bar>

    <v-main>
      <v-container>
        <Nuxt />
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
export default {
  name: 'DefaultLayout',
  data () {
    return {
      clipped: false,
      drawer: false,
      fixed: false,
      items: [
        {
          icon: 'mdi-account',
          title: 'Mi Perfil',
          to: '/perfil'
        },
        {
          icon: 'mdi-car',
          title: 'Mis Viajes',
          to: '/mis-viajes'
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

      // VARIABLES DE FOOTER
      icons: [
        'mdi-facebook',
        'mdi-twitter',
        'mdi-instagram'
      ]
    }
  }
}
</script>
