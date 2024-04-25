<template>
  <v-app>
    <v-app-bar app justify="center" flat color="#0A263D">
      <v-row align="center" justify="center">
        <v-col cols="6">
          <span style="color: white;">LOGO</span>
        </v-col>
        <v-col cols="2">
          <span style="color: white;">Email</span>
          <v-text-field
            solo
            dense
            label=""
            placeholder="Email"
            elevation="0"
          />
        </v-col>
        <v-col cols="2">
          <span style="color: white;">Password</span>
          <v-text-field
            solo
            flat
            dense
            label=""
            placeholder="Password"
          />
        </v-col>
        <v-col cols="2">
          <v-btn color="#FFD300">
            <span style="text-transform: none; color: white">Login</span>
          </v-btn>
        </v-col>
      </v-row>
    </v-app-bar>

    <!-- Sizes your content based upon application components -->
    <v-main>
      <!-- Provides the application the proper gutter -->
    </v-main>

    <v-footer app>
    <!-- -->
    </v-footer>
  </v-app>
</template>

<script>
export default {
  name: 'Login'
}
</script>
