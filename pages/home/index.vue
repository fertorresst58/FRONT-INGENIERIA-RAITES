<template>
  <div>
    <v-expansion-panels
      v-model="panel"
      class="expansion-panels"
      multiple
    >
      <!-- Tarjetas para "Mis viajes publicados"-->
      <v-expansion-panel>
        <v-expansion-panel-header>
          <h2 class="fontTitle">
            Mis viajes publicados
          </h2>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <v-container>
            <v-row>
              <v-col
                v-for="(raite, index) in misViajesPublicados"
                :key="index"
                cols="12"
                sm="6"
                md="4"
                lg="3"
              >
                <v-card class="mx-auto my-2 fontText" max-width="350" elevation="0">
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

                  <v-divider />

                  <v-card-text>
                    <v-row align="center">
                      <v-col cols="2">
                        <v-img
                          src="https://icones.pro/wp-content/uploads/2021/04/icone-cercle-rempli-bleu.png"
                          alt="Sunny image"
                          width="52"
                        />
                      </v-col>
                      <v-col class="text-h4" cols="10">
                        {{ raite.disponible }}
                      </v-col>
                      <v-divider />
                    </v-row>
                  </v-card-text>

                  <v-divider />

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
                    <v-btn color="warning" dark @click="mostrarDetallesPublicados(raite)">
                      Ver detalles
                    </v-btn>
                    <v-dialog v-model="dialogPublicados" width="50%" @click:outside="cerrarStepperPublicados" @keydown.esc="cerrarStepperPublicados">
                      STEPPER
                    </v-dialog>
                    <v-spacer />
                    <v-btn color="warning" dark>
                      Contactar
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
            </v-row>
          </v-container>
        </v-expansion-panel-content>
      </v-expansion-panel>

      <!-- Tarjetas para "Mis viajes apartados"-->
      <v-expansion-panel>
        <v-expansion-panel-header>
          <h2 class="fontTitle">
            Mis viajes apartados
          </h2>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <v-container>
            <v-row>
              <v-col
                v-for="(raite, index) in misViajesApartados"
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
                          src="https://somosrecreoaguasanta.cl/wp-content/uploads/2023/03/Circulo-Amarillo.png"
                          alt="Sunny image"
                          width="52"
                        />
                      </v-col>
                      <v-col class="text-h4" cols="10">
                        {{ raite.disponible }}
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
                    <v-btn color="warning" dark @click="mostrarDetallesapartados(raite)">
                      Ver detalles
                    </v-btn>
                    <v-dialog v-model="dialogApartados" width="50%">
                      STEPPER
                    </v-dialog>
                    <v-spacer />
                    <v-btn color="warning" dark>
                      Contactar
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
            </v-row>
          </v-container>
        </v-expansion-panel-content>
      </v-expansion-panel>

      <!-- Tarjetas para "Viajes Disponibles"-->
      <v-expansion-panel>
        <v-expansion-panel-header class="coyoteBack white--text">
          <h2 class="fontTitle">
            Viajes disponibles
          </h2>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <v-container>
            <v-col cols="12" class="d-flex flex-column align-center justify-center mb-5">
              <v-row>
                <h4 class="fontTitle">
                  Buscar destino:
                </h4>
              </v-row>
              <v-row>
                <v-text-field
                  v-model="search"
                  class="fontTitle"
                  prepend-inner-icon="mdi-magnify"
                  dense
                  solo
                  flat
                  outlined
                  type="text"
                  hide-details
                  @change="filtroDisponibles()"
                />
              </v-row>
            </v-col>
            <v-row>
              <v-col
                v-for="(raite, index) in filtroDisponibles()"
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
                          <v-icon color="white">mdi-check-bold</v-icon>
                          &nbsp;&nbsp;DISPONIBLE
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
                      @click="mostrarDetallesDisponibles(raite)"
                    >
                      Ver detalles
                    </v-btn>
                  </v-card-actions>
                </v-card>

                <!-- STEPPER DISPONIBLES -->
                <v-dialog
                  v-model="dialogDisponibles"
                  max-width="800px"
                >
                  <v-stepper v-model="stepperDisponibles">
                    <v-stepper-header
                      class="blueBack black--text"
                    >
                      <v-stepper-step
                        :complete="stepperDisponibles > 1"
                        step="1"
                        complete-icon="mdi-check-bold"
                        color="#8C6E39"
                      >
                        <strong class="fontTitle white--text">DETALLES</strong>
                        <small class="fontSubtitle white--text">Verifica la información</small>
                      </v-stepper-step>

                      <v-divider />

                      <v-stepper-step
                        :complete="stepperDisponibles > 2"
                        step="2"
                        complete-icon="mdi-check-bold"
                        color="#8C6E39"
                      >
                        <strong class="fontTitle white--text">EQUIPAJE Y ASIENTOS</strong>
                        <small class="fontSubtitle white--text">Selecciona tu equipaje</small>
                      </v-stepper-step>

                      <v-divider />

                      <v-stepper-step
                        step="3"
                        complete-icon="mdi-check-bold"
                        color="#8C6E39"
                      >
                        <strong class="fontTitle white--text">REALIZA TU PAGO</strong>
                        <small class="fontSubtitle white--text">Solo se permiten tarjetas</small>
                      </v-stepper-step>
                    </v-stepper-header>

                    <v-stepper-items>
                      <v-stepper-content step="1" align="center" justify="center">
                        <v-card
                          class="mb-12 text-start"
                          elevation="0"
                          outlined
                          width="500px"
                        >
                          <v-card-title class="fontTitle">
                            <strong>DETALLES DEL VIAJE</strong>
                          </v-card-title>

                          <v-card-text class="fontText">
                            <small>ORIGEN: </small>
                            <strong>{{ raiteDisponibleSelected.inicio }}</strong>
                            <br>
                            <small>DESTINO: </small>
                            <strong>{{ raiteDisponibleSelected.destino }}</strong>
                            <br>
                            <small>CONDUCTOR: </small>
                            <strong>{{ raiteDisponibleSelected.conductor }}</strong>
                            <br>
                            <small>FECHA: </small>
                            <strong>{{ formatearFecha(raiteDisponibleSelected.fecha) }}</strong>
                            <br>
                            <small>HORA: </small>
                            <strong>{{ formatearHora(raiteDisponibleSelected.hora) }}</strong>
                            <br>
                            <small>ASIENTOS DISPONIBLES: </small>
                            <strong>{{ raiteDisponibleSelected.capacidad }}</strong>
                            <br>
                            <small>PRECIO: </small>
                            <strong>$ {{ raiteDisponibleSelected.precio }} MXN</strong>
                            <br>
                            <small>DESCRIPCIÓN: </small>
                            <strong>{{ raiteDisponibleSelected.descripcion }}</strong>

                            <v-divider class="mt-4"/>

                            <v-card-title class="fontTitle">
                              <strong>REVIEWS</strong>
                            </v-card-title>

                            <v-row>
                              <v-col cols="12">
                                <v-card>
                                  <v-card-title class="fontTitle">
                                    <span>Promedio de Reseñas</span>
                                  </v-card-title>
                                  <v-card-text>
                                    <v-rating :value="raiteDisponibleSelected.avgReview" color="yellow darken-3" dense readonly />
                                  </v-card-text>
                                </v-card>
                              </v-col>
                            </v-row>
                            <v-row>
                              <v-col v-for="review in raiteDisponibleSelected.reviews" :key="review.id" cols="12" md="6">
                                <v-card>
                                  <v-card-title class="fontTitle">
                                    <v-avatar>
                                      <v-img src="https://i.pravatar.cc/58" />
                                    </v-avatar>
                                    <span class="ml-3">{{ review.nombre }} {{ review.apaterno }} {{ review.amaterno }}</span>
                                  </v-card-title>
                                  <v-card-subtitle class="fontSubtitle">
                                    <v-rating :value="review.puntuacion" color="yellow darken-3" dense readonly />
                                  </v-card-subtitle>
                                  <v-card-text class="fontText">
                                    <p>{{ review.comentario }}</p>
                                    <small class="grey--text">{{ formatearFecha(review.fecha) }}</small>
                                  </v-card-text>
                                </v-card>
                              </v-col>
                            </v-row>
                          </v-card-text>
                        </v-card>
                        <v-btn
                          color="#FFD300"
                          class="fontTitle"
                          @click="stepperDisponibles = 2"
                        >
                          <span style="text-transform: none;">Continuar</span>
                        </v-btn>

                        <v-btn text @click="cerrarDialogDisponibles()">
                          <span style="text-transform: none;">Atrás</span>
                        </v-btn>
                      </v-stepper-content>

                      <v-stepper-content step="2" align="center" justify="center">
                        <v-card
                          class="mb-12 text-start"
                          elevation="0"
                          outlined
                          width="500px"
                        >
                          <v-card-text class="fontText">
                            <v-col cols="12">
                              <v-row class="d-flex flex-column">
                                <h3 class="fontTitle mb-10">
                                  Selecciona la cantidad de asientos:
                                </h3>
                                <v-slider
                                  v-model="asientos"
                                  color="#0A263D"
                                  thumb-label
                                  :thumb-size="24"
                                  :max="raiteDisponibleSelected.capacidad"
                                  ticks="always"
                                  step="1"
                                  @input="actualizarEquipajes()"
                                />
                              </v-row>

                              <v-row v-for="(equipaje, index) in equipajes" :key="index" class="d-flex flex-column">
                                <h3 class="fontTitle">
                                  Pasajero {{ index + 1 }}
                                </h3>
                                <v-combobox
                                  v-model="equipajes[index]"
                                  :items="equipajeItems"
                                  label="Seleccione equipaje"
                                  outlined
                                  multiple
                                  dense
                                  solo
                                  flat
                                  class="fontText"
                                />
                              </v-row>
                            </v-col>
                          </v-card-text>
                        </v-card>
                        <v-btn
                          color="#FFD300"
                          class="fontTitle"
                          @click="stepperDisponibles = 3"
                        >
                          <span style="text-transform: none;">Continuar</span>
                        </v-btn>

                        <v-btn text @click="stepperDisponibles = 1">
                          <span style="text-transform: none;">Atrás</span>
                        </v-btn>
                      </v-stepper-content>

                      <v-stepper-content step="3">
                        <v-card
                          class="mb-12"
                          color="grey lighten-1"
                          height="200px"
                        />

                        <v-btn
                          color="#FFD300"
                          class="fontTitle"
                          @click="realizarPago()"
                        >
                          <span style="text-transform: none;">Continuar</span>
                        </v-btn>

                        <v-btn text @click="stepperDisponibles = 2">
                          <span style="text-transform: none;">Atrás</span>
                        </v-btn>
                      </v-stepper-content>
                    </v-stepper-items>
                  </v-stepper>
                </v-dialog>
              </v-col>
            </v-row>
          </v-container>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>

    <!-- Dialogo para detalles del viaje -->
    <v-dialog v-model="dialogDetalles" max-width="600px">
      HOLA
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
      // DIALOG DETALLES DE VIAJE
      dialogDetalles: false,

      // DIALOG PUBLICADOS
      dialogPublicados: false,

      // DIALOG APARTADOS
      dialogApartados: false,

      // EXPANSION PANEL
      panel: [0, 1, 2],

      detallesViaje: {},
      e1: 1,
      equipaje: 0,
      cupo: 4,
      totalPago: 0,
      viajeDetalles: 'Detalles específicos del viaje...',
      numeroPersonas: 0,
      detallesViajep: null,
      detallesViajea: null,
      id: [],
      viajes: [],
      misViajesPublicados: [],
      misViajesApartados: [],

      // VIAJES DISPONIBLES
      viajesDisponibles: [],
      search: '',
      raiteDisponibleSelected: [],

      // DIALOG DISPONIBLES
      dialogDisponibles: false,
      stepperDisponibles: 1,
      asientos: 0,
      equipajes: [],
      equipajeItems: [
        'Sin equipaje ($0)',
        'Bolso de mano ($5)',
        'Maleta de mano ($10)',
        'Maleta de viaje ($15)'
      ]
    }
  },

  computed: {
    totalPrice () {
      const costoPorPersonas = Number(this.numeroPersonas) * Number(this.totalPago)
      const costoPorEquipaje = Number(this.equipaje) * 5
      return costoPorPersonas + costoPorEquipaje
    }
  },

  watch: {
    value (newValue) {
      this.internalStep = newValue
    },
    internalStep (newValue) {
      this.$emit('input', newValue)
    }
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

    // FILTROS
    filtroDisponibles () {
      return this.viajesDisponibles.filter(viaje =>
        viaje.destino.toLowerCase().includes(this.search.toLowerCase())
      )
    },

    async recuperarDatos () {
      const url = '/home'
      const id = this.$store.state.user.id
      const params = { id }

      try {
        const res = await this.$axios.get(url, { params })
        if (res.data.success) {
          this.misViajesPublicados = res.data.viajesPublicados
          this.misViajesApartados = res.data.viajesReservados

          const today = new Date()
          const formattedToday = today.toISOString().split('T')[0]

          this.viajesDisponibles = res.data.viajes.filter(viaje => viaje.fecha >= formattedToday)

          // Procesar cada viaje para obtener su promedio de reseñas
          for (const viaje of [...this.misViajesApartados, ...this.viajesDisponibles]) {
            const reviews = await this.findAllReviews(viaje.id)
            const avgReview = this.calculateAverageReview(reviews)
            const resultDriver = await this.findDriver(viaje.id)
            const conductor = resultDriver.user.nombre + ' ' + resultDriver.user.apaterno + ' ' + resultDriver.user.amaterno
            // const driver = resultDriver.user.nombre + ' ' + resultDriver.user.apaterno + ' ' + resultDriver.user.amaterno
            this.$set(viaje, 'reviews', reviews)
            this.$set(viaje, 'avgReview', avgReview) // Asigna el promedio de reseñas al objeto viaje
            this.$set(viaje, 'conductor', conductor)
          }

          // Almacena todos los viajes para restablecer después del filtro
          this.todosViajesPublicados = [...res.data.viajesPublicados]
          this.todosViajesApartados = [...res.data.viajesReservados]
          this.todosViajesDisponibles = [...res.data.viajes]
        }
      } catch (error) {
        console.error('Error al recuperar los datos:', error)
      }
    },

    async findAllReviews (viajeId) {
      const sendData = { viaje: viajeId }
      const url = '/history/findAllReviews'
      try {
        const res = await this.$axios.post(url, sendData)
        if (res.data.success === true) {
          return res.data.reviews
        } else {
          return []
        }
      } catch (error) {
        // eslint-disable-next-line no-console
        console.error('NO SE ENCONTRARON RESEÑAS')
        return []
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
          return res.data
        } else {
          return null
        }
      } catch (error) {
        return null
      }
    },

    calculateAverageReview (reviews) {
      if (reviews.length === 0) {
        return 0
      }
      const total = reviews.reduce((sum, review) => sum + review.puntuacion, 0)
      return total / reviews.length
    },

    mostrarDetallesDisponibles (raite) {
      this.raiteDisponibleSelected = raite
      this.dialogDisponibles = true
    },

    cerrarDialogDisponibles () {
      this.dialogDisponibles = false
      this.asiento = 0
      this.raiteDisponibleSelected = []
      this.equipaje = []
    },

    actualizarEquipajes () {
      if (this.asientos > this.equipajes.length) {
        for (let i = this.equipajes.length; i < this.asientos; i++) {
          this.equipajes.push(null)
        }
      } else {
        this.equipajes.splice(this.asientos)
      }
    },

    realizarPago () {
      console.log('EQUIPAJES => ', this.equipajes)
    }
  }
}
</script>

<style scoped>
.filtro-button {
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  background-color: #8C6E39;
  padding: 10px;
  border-radius: 5px;
  color: white;
  margin-bottom: 10px;
}

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

.expansion-panels {
  margin-top: 20px;
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
