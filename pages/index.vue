<template>
  <v-container fluid>
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
            <span style="color: white;">LOGO</span>
          </v-col>

          <v-col cols="2" style="height: 146px;">
            <v-row>
              <span class="fontTitle" style="color: white; font-size: 16px;">Email</span>
            </v-row>
            <v-row>
              <div style="width: 90%;" class="pt-1">
                <v-text-field
                  v-model="email"
                  solo
                  flat
                  dense
                  type="email"
                  class="fontTitle"
                />
              </div>
            </v-row>
            <v-row justify="start" align="start" class="flex-nowrap">
              <!-- <v-checkbox dark color="white" label="Mantenerme Logueado" label-class="custom-label" /> -->
              <div class="checkbox">
                <input v-model="checkbox" type="checkbox" class="mr-2">
                <label class="fontTitle" style="font-size: 12px; color: white;">Mantenerse logueado</label>
              </div>
            </v-row>
          </v-col>

          <v-col cols="2" style="height: 146px;">
            <v-row>
              <span class="fontTitle" style="color: white; font-size: 16px;">Password</span>
            </v-row>
            <v-row>
              <div style="width: 90%;" class="pt-1">
                <v-text-field
                  v-model="password"
                  solo
                  flat
                  dense
                  type="password"
                  class="fontTitle"
                />
              </div>
            </v-row>
            <v-row>
              <a href="" style="text-decoration: none; color: white; font-size: 12px;" class="fontTitle">Olvide mi contraseña</a>
            </v-row>
          </v-col>

          <v-col cols="1" style="height: 146px;" class="pl-0">
            <div class="pt-4">
              <v-btn block color="#8C6E39" height="38px" width="90%" @click="login()">
                <span class="fontTitle" style="text-transform: none; color: white">Log In</span>
              </v-btn>
            </div>
          </v-col>
        </v-row>
      </v-app-bar>

      <v-main>
        <v-row class="mt-0 pa-0">
          <v-col cols="7">
            IMAGEN RANDOM
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
                    Apellidos:
                  </h3>
                  <v-text-field
                    v-model="apellidos"
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
                    v-model="confirmContrasena"
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
                    v-model="genero"
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
                  <v-select
                    v-model="nacimiento"
                    :items="itemsGenero"
                    label="Fecha de nacimiento"
                    dense
                    solo
                    outlined
                    flat
                    class="fontTitle"
                  />
                </v-form>
              </v-card-text>

              <v-card-actions>
                <v-row class="mb-4">
                  <v-col cols="3" />
                  <v-col cols="6">
                    <v-btn block color="#FFD300" height="38px" width="90%" @click="signUp()">
                      <span class="fontTitle" style="text-transform: none; color: black">Registrarse</span>
                    </v-btn>
                  </v-col>
                  <v-col cols="3" />
                </v-row>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-main>
    </v-app>
  </v-container>
</template>

<script>
export default {
  name: 'Login',
  data () {
    return {
      email: null,
      password: null,
      checkbox: false,
      itemsGenero: ['Hombre', 'Mujer', 'Otro', 'Prefiero no decir']
    }
  },

  methods: {
    login () {
      console.log('EMAIL => ', this.email)
      console.log('PASSWORD => ', this.password)
      console.log('CHECKBOX => ', this.checkbox)
    }
  }
}
</script>

<style scoped>
.custom-label {
  font-size: 12px;
  color: white;
}

.checkbox {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: center;
  align-content: center;
  align-items: stretch;
}
</style>
