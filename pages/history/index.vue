<template>
  <div>
    <v-container>
      <v-row>
        <v-col class="d-flex justify-end">
          <v-btn color="primary" @click="publicarViaje(item)">
            Publicar viaje
          </v-btn>
        </v-col>
      </v-row>

      <v-treeview activatable :items="publicados" open-on-click>
        <template #prepend="{ item, leaf }">
          <v-card v-if="leaf" class="mb-3">
            <v-card-text>
              {{ item.text }}
            </v-card-text>
            <v-card-actions>
              <v-btn color="primary" @click="showDetails(item)">
                Ver detalles
              </v-btn>
              <v-btn color="yellow" @click="accionDos">
                Contactar Conductor
              </v-btn>
            </v-card-actions>
          </v-card>
          <template v-else>
            {{ item.name }}
          </template>
        </template>
      </v-treeview>

      <v-treeview activatable :items="reservados" open-on-click>
        <template #prepend="{ item, leaf }">
          <v-card v-if="leaf" class="mb-3">
            <v-card-text>
              {{ item.text }}
            </v-card-text>
            <v-card-actions>
              <v-btn color="primary" @click="showDetails(item)">
                Ver detalles
              </v-btn>
              <v-btn color="yellow" @click="accionDos">
                Contactar Conductor
              </v-btn>
            </v-card-actions>
          </v-card>
          <template v-else>
            {{ item.name }}
          </template>
        </template>
      </v-treeview>

      <v-treeview activatable :items="historial" open-on-click>
        <template #prepend="{ item, leaf }">
          <v-card v-if="leaf" class="mb-3">
            <v-card-text>
              {{ item.text }}
            </v-card-text>
            <v-card-actions>
              <v-btn color="primary" @click="showDetails(item)">
                Ver detalles
              </v-btn>
              <v-btn color="yellow" @click="accionDos">
                Contactar Conductor
              </v-btn>
            </v-card-actions>
          </v-card>
          <template v-else>
            {{ item.name }}
          </template>
        </template>
      </v-treeview>

      <v-dialog v-model="showDialog" width="800" persistent>
        <v-card>
          <v-card-title class="d-flex justify-center">
            Detalles del viaje
          </v-card-title>
          <v-card-text>
            <v-form>
              <v-row>
                <v-col cols="12">
                  Lugar de salida
                  <v-text-field
                    v-model="dato1"
                    readonly
                    disabled
                    outlined
                  />
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12">
                  Lugar de destino
                  <v-text-field
                    v-model="dato2"
                    readonly
                    disabled
                    outlined
                  />
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="3">
                  Fecha del viaje
                  <v-text-field
                    v-model="dato3"
                    readonly
                    disabled
                    outlined
                  />
                </v-col>
                <v-col cols="3">
                  Hora de salida
                  <v-text-field
                    v-model="dato4"
                    readonly
                    disabled
                    outlined
                  />
                </v-col>
                <v-col cols="3">
                  Precio del viaje
                  <v-text-field
                    v-model="dato5"
                    prefix="$"
                    readonly
                    disabled
                    outlined
                  />
                </v-col>
                <v-col cols="3">
                  Numero de asientos
                  <v-text-field
                    v-model="dato6"
                    readonly
                    disabled
                    outlined
                  />
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12">
                  Detalles adicionales
                  <v-text-field
                    v-model="dato7"
                    readonly
                    disabled
                    outlined
                  />
                </v-col>
              </v-row>
              <v-card-actions>
                <v-btn color="red" width="100px" @click="showDialog = false">
                  Salir
                </v-btn>
              </v-card-actions>
            </v-form>
          </v-card-text>
        </v-card>
      </v-dialog>

      <v-dialog v-model="showDialog2" width="800" persistent>
        <v-card>
          <v-card-title class="d-flex justify-center">
            Detalles del viaje
          </v-card-title>
          <v-card-text>
            <v-form>
              <v-row>
                <v-col cols="12">
                  Lugar de salida
                  <v-text-field
                    v-model="dato1"
                    type="text"
                    outlined
                  />
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12">
                  Lugar de destino
                  <v-text-field
                    v-model="dato2"
                    type="text"
                    outlined
                  />
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="3">
                  Fecha del viaje
                  <v-text-field
                    v-model="dato3"
                    type="date"
                    outlined
                  />
                </v-col>
                <v-col cols="3">
                  Hora de salida
                  <v-text-field
                    v-model="dato4"
                    type="time"
                    outlined
                  />
                </v-col>
                <v-col cols="3">
                  Precio del viaje
                  <v-text-field
                    v-model="dato5"
                    type="number"
                    prefix="$"
                    outlined
                  />
                </v-col>
                <v-col cols="3">
                  Numero de asientos
                  <v-text-field
                    v-model="dato6"
                    type="number"
                    outlined
                  />
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12">
                  Detalles adicionales
                  <v-text-field
                    v-model="dato7"
                    type="text"
                    outlined
                  />
                </v-col>
              </v-row>
              <v-card-actions class="d-flex justify-end">
                <v-btn color="red" @click="showDialog2 = false">
                  Salir
                </v-btn>
              </v-card-actions>
            </v-form>
          </v-card-text>
        </v-card>
      </v-dialog>
    </v-container>
  </div>
</template>

<script>
export default {
  layout: 'home',
  auth: true,
  data () {
    return {
      showDialog: false,
      showDialog2: false,
      dato1: '',
      dato2: '',
      dato3: '',
      dato4: '',
      dato5: '',
      dato6: '',
      dato7: '',
      publicados: [
        {
          name: 'Viajes publicados',
          children: [
            { text: 'Texto' }
          ]
        }
      ],
      reservados: [
        {
          name: 'Viajes reservados',
          children: [
            { text: 'Texto de la tarjeta 1' },
            { text: 'Texto de la tarjeta 2' },
            { text: 'Texto de la tarjeta 3' },
            { text: 'Texto de la tarjeta 4' }
          ]
        }
      ],
      historial: [
        {
          name: 'Historial de viajes',
          children: [
            { text: 'Texto de la tarjeta 1' },
            { text: 'Texto de la tarjeta 2' },
            { text: 'Texto de la tarjeta 3' },
            { text: 'Texto de la tarjeta 4' }
          ]
        }
      ]
    }
  },
  methods: {
    showDetails (item) {
      // Asignar datos del item a los datos del formulario
      this.dato1 = item.text
      // Asigna valores relevantes del item a los otros datos si están disponibles
      this.showDialog = true
    },

    publicarViaje (item) {
      // Lógica para publicar un nuevo viaje
      this.showDialog2 = true
    }
  }
}
</script>

<style scoped>
.v-card {
  margin-bottom: 20px;
}
</style>
