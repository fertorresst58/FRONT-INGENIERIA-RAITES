<template>
  <div>
    <v-expansion-panels
      v-model="panel"
      class="expansion-panels"
      multiple
    >
      <!-- Tarjetas para "Viajes sin reseniar"-->
      <v-expansion-panel>
        <v-expansion-panel-header><h2>Viajes sin reseñar</h2></v-expansion-panel-header>
        <v-expansion-panel-content>
          <v-container>
            <v-row>
              <v-col
                v-for="(raite, index) in misViajesSinReseniar"
                :key="index"
                cols="12"
                sm="6"
                md="4"
                lg="3"
              >
                <v-card class="mx-auto my-2" max-width="350">
                  <v-list-item two-line>
                    <v-list-item-content>
                      <v-list-item-title class="text-h5">
                        {{ raite.inicio }}
                      </v-list-item-title>
                      <div style="display: flex; align-items: center;">
                        <v-icon class="mr-2">
                          mdi-calendar-clock
                        </v-icon>
                        <v-list-item-subtitle>{{ raite.fecha }}, {{ raite.hora }}</v-list-item-subtitle>
                      </div>
                    </v-list-item-content>
                  </v-list-item>

                  <v-card-text>
                    <v-row align="center">
                      <v-col cols="2">
                        <v-img
                          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoqzh_OZTGcMc5tZXeC5jNHUjI6B3VEOErabOVMjQ7gQ&s"
                          alt="Sunny image"
                          width="52"
                        />
                      </v-col>
                      <v-col class="text-h4" cols="10">
                        Finalizado
                      </v-col>
                    </v-row>
                  </v-card-text>

                  <v-list-item>
                    <v-list-item-icon>
                      <v-icon>mdi-car-traction-control</v-icon>
                    </v-list-item-icon>
                    <v-list-item-subtitle>Pasar por: {{ raite.destino }}</v-list-item-subtitle>
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-icon>
                      <v-icon>mdi-hand-coin-outline</v-icon>
                    </v-list-item-icon>
                    <v-list-item-subtitle>${{ raite.precio }}.00 MXN</v-list-item-subtitle>
                  </v-list-item>

                  <v-divider />

                  <v-card-actions>
                    <v-btn color="warning" dark @click="showDetalles(raite)">
                      Ver detalles
                    </v-btn>
                    <v-spacer />
                    <v-btn color="warning" dark @click="dialogReviewFunction(raite.id)">
                      Reseñar
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
            </v-row>
          </v-container>
        </v-expansion-panel-content>
      </v-expansion-panel>

    <!-- Tarjetas para "Viajes reseniados"-->
    <v-expansion-panel>
        <v-expansion-panel-header><h2>Viajes reseñados</h2></v-expansion-panel-header>
        <v-expansion-panel-content>
          <v-container>
            <v-row>
              <v-col
                v-for="(raite, index) in misViajesReseniados"
                :key="index"
                cols="12"
                sm="6"
                md="4"
                lg="3"
              >
                <v-card class="mx-auto my-2" max-width="350">
                  <v-list-item two-line>
                    <v-list-item-content>
                      <v-list-item-title class="text-h5">
                        {{ raite.inicio }}
                      </v-list-item-title>
                      <div style="display: flex; align-items: center;">
                        <v-icon class="mr-2">
                          mdi-calendar-clock
                        </v-icon>
                        <v-list-item-subtitle>{{ raite.fecha }}, {{ raite.hora }}</v-list-item-subtitle>
                      </div>
                    </v-list-item-content>
                  </v-list-item>

                  <v-card-text>
                    <v-row align="center">
                      <v-col cols="2">
                        <v-img
                          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoqzh_OZTGcMc5tZXeC5jNHUjI6B3VEOErabOVMjQ7gQ&s"
                          alt="Sunny image"
                          width="52"
                        />
                      </v-col>
                      <v-col class="text-h4" cols="10">
                        Finalizado
                      </v-col>
                    </v-row>
                  </v-card-text>

                  <v-list-item>
                    <v-list-item-icon>
                      <v-icon>mdi-car-traction-control</v-icon>
                    </v-list-item-icon>
                    <v-list-item-subtitle>Pasar por: {{ raite.destino }}</v-list-item-subtitle>
                  </v-list-item>

                  <v-list-item>
                    <v-list-item-icon>
                      <v-icon>mdi-hand-coin-outline</v-icon>
                    </v-list-item-icon>
                    <v-list-item-subtitle>${{ raite.precio }}.00 MXN</v-list-item-subtitle>
                  </v-list-item>

                  <v-divider />

                  <v-card-actions>
                    <v-btn color="warning" block dark @click="showDetalles(raite)">
                      Ver detalles
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
            </v-row>
          </v-container>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>

    <v-dialog v-model="dialogReview" persistent max-width="600px">
      <v-toolbar
        color="#0A263D"
        dark
      >
      <v-card-title class="text-h5">
        Reseña tu viaje
      </v-card-title>
      </v-toolbar>
      <v-card
        class="elevation-16 mx-auto"
        width="auto"
      >
        <v-card-text>
          <div class="text-h6 pa-2">
            Calificacion
          </div>
          <v-rating
            v-model="calificacion"
            color="yellow darken-3"
            background-color="grey darken-1"
            empty-icon="$ratingFull"
            hover
          ></v-rating>
        </v-card-text>
        <v-card-text>
          <div class="text-h6 pa-2">
            Comentarios
          </div>
          <v-textarea
            v-model="comentario"
            outlined
            name="comentario"
            label="¡Sé amable!"
            persistent
          ></v-textarea>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions class="justify-space-between">
          <v-btn text @click="resetReview()">
            No, gracias
          </v-btn>
          <v-btn
            color="primary"
            text
            @click="reviewNow()"
          >
            Calificar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialogDetalles" max-width="600px">
      <v-toolbar color="#0A263D" dark>
        <v-card-title class="text-h5">
          Detalles del viaje
        </v-card-title>
      </v-toolbar>
      <v-card
        class="elevation-16 mx-auto"
        width="auto"
        style="overflow: hidden;"
      >
        <v-row class="mt-2">
          <v-col cols="12" sm="6">
            <v-row align="center" no-gutters>
              <v-col>
                <v-text-field
                  v-model="this.lugarPartida"
                  label="Lugar de inicio"
                  readonly
                  class="pa-3"
                  prepend-icon="mdi mdi-car-arrow-right"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-col>
          <v-col cols="12" sm="6">
            <v-text-field
              v-model="this.lugarDestino"
              label="Lugar de Destino"
              readonly
              class="pa-3"
              prepend-icon="mdi mdi-flag-checkered"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row class="mt-2">
          <v-col cols="8" sm="4">
            <v-row align="center" no-gutters>
              <v-col>
                <v-text-field
                  v-model="this.precioPersona"
                  label="Precio"
                  readonly
                  class="pa-3"
                  prepend-icon="mdi mdi-currency-usd"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-col>
          <v-col cols="12" sm="6">
            <v-text-field
              v-model="this.conductor"
              label="Conductor"
              readonly
              class="pa-3"
              prepend-icon="mdi mdi-card-account-details-outline"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row class="mt-2">
          <v-col cols="8" sm="4">
            <v-row align="center" no-gutters>
              <v-col>
                <v-text-field
                  v-model="this.fechaInicio"
                  label="Fecha"
                  readonly
                  class="pa-3"
                  prepend-icon="mdi mdi-calendar-month"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-col>
          <v-col cols="8" sm="4">
            <v-text-field
              value="10:00"
              v-model="this.horaInicio"
              readonly
              class="pa-3"
              prepend-icon="mdi mdi-clock-outline"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row v-if="this.calificacionPuesto != ''" class="mt-2">
          <v-col cols="8" sm="4">
            <v-row align="center" no-gutters widht="auto">
              <v-col>
                <div class="text-h6 pa-2">
                  Calificacion
                </div>
                <v-rating
                  v-model="this.calificacionPuesto"
                  color="yellow darken-3"
                  background-color="grey darken-1"
                  empty-icon="$ratingFull"
                  hover
                  readonly
                ></v-rating>
              </v-col>
            </v-row>
          </v-col>
          <v-col cols="8" sm="4">
            <v-textarea
              v-model="this.comentarioPuesto"
              outlined
              name="comentario"
              label="Comentario"
              persistent
              readonly
            ></v-textarea>
          </v-col>
        </v-row>
        <v-divider></v-divider>
        <v-card-actions class="justify-space-between">
          <v-btn text block @click="dialogDetalles=false">
            Cerrar
          </v-btn>
          <v-btn color="primary" text>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>

export default {
  layout: 'home',
  auth: true,

  data () {
    return {
      panel: [],
      detallesViaje: {},
      id: [],
      misViajesApartados: [],
      misViajesSinReseniar: [],
      misViajesReseniados: [],
      dialogReview: false,
      comentario: '',
      calificacion: 0,
      viajeID: '',
      dialogDetalles: false,
      lugarPartida: '',
      lugarDestino: '',
      fechaInicio: '',
      horaInicio: '',
      precioPersona: '',
      calificacionPuesto: '4',
      comentarioPuesto: 'Estuvo bien, pero no tan bien',
      conductor: 'Pedrito'
    }
  },

  computed: {
  },

  mounted () {
    this.recuperarDatos()
  },

  methods: {
    showDetalles (raite) {
      this.lugarPartida = raite.inicio
      this.lugarDestino = raite.destino
      this.fechaInicio = raite.fecha
      this.horaInicio = raite.hora
      this.precioPersona = raite.precio
      this.dialogDetalles = true
    },
    dialogReviewFunction (id) {
      this.viajeID = id
      this.dialogReview = true
    },
    resetReview () {
      this.comentario = ''
      this.calificacion = 0
      this.viajeID = ''
      this.dialogReview = false
    },
    reviewNow () {
      if (this.calificacion > 0) {
        // Logica para generar la review
        const ahora = new Date()
        const fechaActual = ahora.toISOString().split('T')[0]
        console.log('Calificacion: ', this.calificacion)
        console.log('Comentario: ', this.comentario)
        console.log('Fecha de hoy: ', fechaActual)
        console.log('Viaje ID: ', this.viajeID)
        this.resetReview()
      }
    },
    recuperarDatos () {
      const url = '/home'
      const id = this.$store.state.user.id
      const params = { id }

      // solicitud get que pasa un objeto con el ID del usuario
      this.$axios.get(url, { params })
        .then((res) => {
          if (res.data.success) {
            this.misViajesApartados = res.data.viajesReservados
            this.filtrarViajesPasados() // Llama a filtrarViajesPasados después de recibir los datos
          }
        })
    },
    filtrarViajesPasados () {
      const misViajesSinReseniar = []
      const misViajesReseniados = []
      const ahora = new Date()
      const fechaActual = ahora.toISOString().split('T')[0] // Formato año-mes-día
      const horaActual = ahora.toTimeString().split(' ')[0] // Formato hora:minuto:segundo

      this.misViajesApartados.forEach((viaje) => {
        if (viaje.fecha < fechaActual || (viaje.fecha === fechaActual && viaje.hora < horaActual)) {
          misViajesSinReseniar.push(viaje)
          misViajesReseniados.push(viaje)
        } else if (viaje.fecha < fechaActual || (viaje.fecha === fechaActual && viaje.hora < horaActual)) {
          console.log('jja')
        }
      })
      this.misViajesSinReseniar = misViajesSinReseniar
      this.misViajesReseniados = misViajesReseniados
    }
  }
}

</script>

<style scoped>
.filtro-button {
  position: absolute;
  top: 20px;
  right: 20px;
  background-color: #ffffff;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 8px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  cursor: pointer;
}

/* Estilos para los controles de filtro */
.filtro-controls {
  position: absolute;
  top: 60px;
  right: 20px;
  background-color: #ffffff;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  z-index: 2000;
}

.filtro-menu {
  background-color: #ffffff;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  z-index: 2000;
}

/* Estilos para los elementos dentro del menú desplegable */
.filtro-menu div {
  margin-bottom: 10px;
  z-index: 2001;
}

.filtro-menu label {
  display: inline-block;
  width: 80px;
  font-weight: bold;
  z-index: 2002;
}

.filtro-menu input {
  width: calc(100% - 90px);
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
  z-index: 2003;
}

/* Estilos opcionales para la tabla */
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #dddddd;
  padding: 8px;
}

th {
  background-color: #f2f2f2;
}

/* Estilos para los diferentes estados de los raites */
.estado-publicado {
  background-color: lightblue;
}

.estado-apartado {
  background-color: yellow;
}

.estado-disponible {
  background-color: lightgreen;
}

.expansion-panels {
  max-width: 90%; /* Cambia esto según el ancho deseado */
  margin: 0 auto; /* Centra el componente horizontalmente */
}

</style>
