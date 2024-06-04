<template>
  <div>
    <v-expansion-panels
      v-model="panel"
      class="expansion-panels"
      accordion
    >
      <!-- Tarjetas para "Viajes sin reseniar"-->
      <v-expansion-panel>
        <v-expansion-panel-header class="coyoteBack white--text">
          <h2 class="fontTitle">
            Viajes sin reseñar
          </h2>
        </v-expansion-panel-header>
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
                <v-card class="mx-auto my-2 pa-3 white--text" max-width="350" elevation="0" color="#0A263D" rounded>
                  <v-list-item two-line>
                    <v-list-item-content class="text-center white--text">
                      <v-list-item-title class="fontTitle">
                        <small class="fontText">ORIGEN:</small>
                        <br>
                        <strong style="font-size: 30px;">{{ raite.inicio }}</strong>
                      </v-list-item-title>
                      <v-list-item-subtitle class="fontSubtitle my-4 white--text">
                        <small>
                          {{ formatearFecha(raite.fecha) }}
                          <br>
                          {{ formatearHora(raite.hora) }}
                        </small>
                      </v-list-item-subtitle>

                      <v-list-item-title class="fontTitle">
                        <small class="fontText">DESTINO:</small>
                        <br>
                        <strong style="font-size: 30px;">{{ raite.destino }}</strong>
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                  <v-card-text align="center" class="py-0" style="font-size: 20px;">
                    <v-divider class="my-3 white" />
                    <strong class="mt-5 fontText white--text">$ {{ raite.precio }} MXN</strong>
                    <v-divider class="my-3 white" />

                    <v-row class="mt-4">
                      <v-col cols="12" class="text-center d-flex align-center justify-center">
                        <span class="fontSubtitle d-flex justify-center white--text">
                          <v-icon color="white">mdi mdi-message-draw</v-icon>
                          &nbsp;&nbsp;PENDIENTE
                        </span>
                      </v-col>
                    </v-row>
                  </v-card-text>

                  <v-card-actions class="mt-5">
                    <v-btn
                      color="#FFD300"
                      width="50%"
                      height="38px"
                      class="black--text"
                      @click="showDetalles(raite)"
                    >
                      Detalles
                    </v-btn>
                    <v-btn
                      color="#FFD300"
                      width="50%"
                      height="38px"
                      class="black--text"
                      @click="dialogReviewFunction(raite.id)"
                    >
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
        <v-expansion-panel-header class="coyoteBack white--text">
          <h2 class="fontTitle">
            Viajes reseñados
          </h2>
        </v-expansion-panel-header>
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
                <v-card class="mx-auto my-2 pa-3 white--text" max-width="350" elevation="0" color="#0A263D" rounded>
                  <v-list-item two-line>
                    <v-list-item-content class="text-center white--text">
                      <v-list-item-title class="fontTitle">
                        <small class="fontText">ORIGEN:</small>
                        <br>
                        <strong style="font-size: 30px;">{{ raite.inicio }}</strong>
                      </v-list-item-title>
                      <v-list-item-subtitle class="fontSubtitle my-4 white--text">
                        <small>
                          {{ formatearFecha(raite.fecha) }}
                          <br>
                          {{ formatearHora(raite.hora) }}
                        </small>
                      </v-list-item-subtitle>

                      <v-list-item-title class="fontTitle">
                        <small class="fontText">DESTINO:</small>
                        <br>
                        <strong style="font-size: 30px;">{{ raite.destino }}</strong>
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                  <v-card-text align="center" class="py-0" style="font-size: 20px;">
                    <v-divider class="my-3 white" />
                    <strong class="mt-5 fontText white--text">$ {{ raite.precio }} MXN</strong>
                    <v-divider class="my-3 white" />

                    <v-row class="mt-4">
                      <v-col cols="12" class="text-center d-flex align-center justify-center">
                        <span class="fontSubtitle d-flex justify-center white--text">
                          <v-icon color="white">mdi mdi-flag-checkered</v-icon>
                          &nbsp;&nbsp;RESEÑADO
                        </span>
                      </v-col>
                    </v-row>
                  </v-card-text>

                  <v-card-actions class="mt-5">
                    <v-btn
                      color="#FFD300"
                      block
                      height="38px"
                      class="black--text"
                      @click="showDetalles(raite)"
                    >
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

    <v-dialog
      v-model="dialogReview"
      width="700px"
      class="d-flex align-center justify-center"
      persistent
    >
      <v-card
        class="text-start pa-3"
        elevation="0"
        outlined
      >
        <v-card-title class="fontTitle">
          <strong>RESEÑA TU VIAJE</strong>
        </v-card-title>

        <v-form ref="form" v-model="validForm">
          <v-row class="pa-2">
            <v-col cols="12" md="6">
              <v-row>
                <v-col cols="12" md="6">
                  <v-card height="265px" elevation="0">
                    <v-card-subtitle class="fontSubtitle">
                      Califica tu viaje
                      <v-rating
                        v-model="calificacion"
                        color="yellow darken-3"
                        dense
                        hover
                      />
                    </v-card-subtitle>
                    <v-card-text class="fontText">
                      <v-textarea
                        v-model="comentario"
                        name="comentario"
                        label="¡Sé amable!"
                        rows="3"
                        row-height="25"
                        persistent
                      />
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </v-form>
        <v-card-actions class="justify-space-between">
          <v-btn
            color="#8C6E39"
            elevation="0"
            height="38px"
            class="white--text"
            @click="resetReview()"
          >
            No, gracias
          </v-btn>
          <v-btn
            color="#8C6E39"
            elevation="0"
            height="38px"
            class="white--text"
            @click="reviewNow()"
          >
            Calificar
          </v-btn>
        </v-card-actions>
      </v-card>
      <v-divider />
    </v-dialog>

    <v-dialog
      v-model="dialogDetalles"
      width="700px"
      class="d-flex align-center justify-center"
      persistent
    >
      <v-card
        class="text-start pa-3"
        elevation="0"
        outlined
      >
        <v-card-title class="fontTitle">
          <strong>DETALLES DEL VIAJE</strong>
        </v-card-title>

        <v-card-text class="fontText">
          <small>ORIGEN: </small>
          <strong>{{ lugarPartida }}</strong>
          <br>
          <small>DESTINO: </small>
          <strong>{{ lugarDestino }}</strong>
          <br>
          <small>CONDUCTOR: </small>
          <strong>{{ conductor }}</strong>
          <br>
          <small>FECHA: </small>
          <strong>{{ formatearFecha(fechaInicio) }}</strong>
          <br>
          <small>HORA: </small>
          <strong>{{ formatearHora(horaInicio) }}</strong>
          <br>
          <small>ASIENTOS DISPONIBLES: </small>
          <strong>{{ asientos }}</strong>
          <br>
          <small>PRECIO: </small>
          <strong>${{ precioPersona }}MXN</strong>
          <br>
          <small>DESCRIPCIÓN: </small>
          <strong>{{ descripcion }}</strong>

          <v-divider class="mt-4" />
        </v-card-text>
        <v-row v-if="calificacionPuesto != 0" class="pa-2">
          <v-col cols="12" md="6">
            <v-card-title class="fontTitle">
              <strong>MI REVIEW</strong>
            </v-card-title>
            <v-row>
              <v-col cols="12" md="6">
                <v-card height="265px" elevation="0">
                  <v-card-title class="fontTitle">
                    <v-avatar>
                      <v-img :src="user.imagen" />
                    </v-avatar>
                    <span class="ml-3">{{ user.nombre }} {{ user.apaterno }} {{ user.amaterno }}</span>
                  </v-card-title>
                  <v-card-subtitle class="fontSubtitle">
                    <v-rating :value="calificacionPuesto" color="yellow darken-3" dense readonly />
                  </v-card-subtitle>
                  <v-card-text class="fontText">
                    <p>{{ comentarioPuesto }}</p>
                    <small class="grey--text">{{ formatearFecha(fechaReview) }}</small>
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
        <v-card-actions class="mt-5">
          <v-btn
            color="#8C6E39"
            elevation="0"
            block
            height="38px"
            class="white--text"
            @click="dialogDetalles = false"
          >
            CERRAR
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import moment from 'moment'
import 'moment/locale/es'

export default {
  layout: 'home',
  auth: true,

  data () {
    return {
      user: this.$store.state.user,
      panel: [],
      detallesViaje: {},
      id: [],
      misViajesApartados: [],
      misViajesSinReseniar: [],
      misViajesReseniados: [],
      validForm: false,
      dialogReview: false,
      comentario: '',
      fechaReview: '',
      calificacion: 0,
      viajeID: '',
      dialogDetalles: false,
      lugarPartida: '',
      lugarDestino: '',
      fechaInicio: '',
      horaInicio: '',
      precioPersona: '',
      asientos: '',
      descripcion: '',
      calificacionPuesto: '',
      comentarioPuesto: '',
      conductor: ''
    }
  },

  computed: {
  },

  mounted () {
    this.recuperarDatos()
  },

  methods: {
    formatearFecha (fecha) {
      return fecha ? moment(fecha, 'YYYY-MM-DD').format('dddd, DD [de] MMMM') : ''
    },

    formatearHora (hora) {
      return hora ? moment(hora, 'HH:mm:ss').format('hh:mm A') : ''
    },
    showDetalles (raite) {
      console.log('DATA RAITE => ', raite)
      this.lugarPartida = raite.inicio
      this.lugarDestino = raite.destino
      this.fechaInicio = raite.fecha
      this.horaInicio = raite.hora
      this.precioPersona = raite.precio
      this.conductor = raite.conductor
      this.asientos = raite.capacidad
      this.descripcion = raite.descripcion
      if (raite.review) {
        this.calificacionPuesto = raite.review.puntuacion
        this.fechaReview = raite.review.fecha
        if (raite.review.comentario) {
          this.comentarioPuesto = raite.review.comentario
        }
      } else {
        this.calificacionPuesto = 0
        this.comentarioPuesto = ''
      }
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
        const ahora = new Date()
        const fechaActual = ahora.toISOString().split('T')[0]
        const userID = this.$store.state.user.id
        const sendData = {
          viaje: this.viajeID,
          usuario: userID,
          puntuacion: this.calificacion,
          comentario: this.comentario,
          fecha: fechaActual
        }
        console.log(sendData)
        const url = '/history'
        this.$axios.post(url, sendData)
          .then((res) => {
            if (res.data.success) {
              console.log('REVIEW REGISTRADA EXITOSAMENTE')
            } else {
              console.log('ERROR AL REGISTRAR REVIEW')
            }
          })
          .catch((error) => {
            console.log('ERROR EN REGISTRO => ', error)
          })
        this.resetReview()
      }
    },
    async findReview (viajeId) {
      const userID = this.$store.state.user.id
      const viajeID = viajeId
      const sendData = {
        viaje: viajeID,
        usuario: userID
      }
      const url = '/history/findReview'

      try {
        const res = await this.$axios.post(url, sendData)
        if (res.data.success === true) {
          return res.data
        } else {
          return null
        }
      } catch (error) {
        return null
      }
    },
    async findDriver (viajeId) {
      const viajeID = viajeId
      const sendData = {
        viaje: viajeID
      }
      const url = '/user/findUserByViaje'

      try {
        const res = await this.$axios.post(url, sendData)
        if (res.data.success === true) {
          console.log('Data => ', res.data)
          return res.data
        } else {
          return null
        }
      } catch (error) {
        return null
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
    async filtrarViajesPasados () {
      const misViajesSinReseniar = []
      const misViajesReseniados = []
      const ahora = new Date()
      const fechaActual = ahora.toISOString().split('T')[0] // Formato año-mes-día
      const horaActual = ahora.toTimeString().split(' ')[0] // Formato hora:minuto:segundo

      for (const viaje of this.misViajesApartados) {
        const resultReview = await this.findReview(viaje.id)
        const resultDriver = await this.findDriver(viaje.id)
        console.log('Viaje id => ', viaje.id)
        console.log('Result driver => ', resultDriver)
        if (viaje.fecha < fechaActual || (viaje.fecha === fechaActual && viaje.hora < horaActual)) {
          viaje.review = resultReview.review
          viaje.conductor = resultDriver.user.nombre + ' ' + resultDriver.user.apaterno + ' ' + resultDriver.user.amaterno
          if (resultReview.review === null) {
            misViajesSinReseniar.push(viaje)
          } else {
            misViajesReseniados.push(viaje)
          }
        }
      }
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

.expansion-panels {
  margin-top: 20px;
}

/* Estilos para los controles de filtro */
.filtro-controls {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-bottom: 20px;
}

.filtro-menu {
  background-color: #fff;
  padding: 15px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

.button-container {
  display: flex;
  justify-content: center;
  margin-top: 16px;
}

.button-container .v-btn {
  margin: 0 8px;
}

</style>
