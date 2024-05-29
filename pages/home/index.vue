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
          <h2>Mis viajes publicados</h2>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <div v-if="panel.includes(0)">
            <div class="filtro-button" @click="toggleFiltro('publicados')">
              <v-icon>mdi-filter</v-icon> Filtrar
            </div>
            <div v-show="mostrarMenuFiltro.publicados" class="filtro-controls">
              <div class="filtro-menu">
                <div>
                  <label for="horaPublicados">Hora:</label>
                  <input id="horaPublicados" v-model="filtroHoraPublicados" type="text" @input="filtrarViajes('publicados')">
                </div>
                <div>
                  <label for="fechaPublicados">Fecha:</label>
                  <input id="fechaPublicados" v-model="filtroFechaPublicados" type="text" @input="filtrarViajes('publicados')">
                </div>
                <div>
                  <label for="destinoPublicados">Destino:</label>
                  <input id="destinoPublicados" v-model="filtroDestinoPublicados" type="text" @input="filtrarViajes('publicados')">
                </div>
                <div>
                  <label for="precioPublicados">Precio:</label>
                  <input id="precioPublicados" v-model="filtroPrecioPublicados" type="text" @input="filtrarViajes('publicados')">
                </div>
              </div>
            </div>
          </div>
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
                          src="https://icones.pro/wp-content/uploads/2021/04/icone-cercle-rempli-bleu.png"
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
                    <v-btn color="warning" dark @click="mostrarDetalles(raite)">
                      Ver detalles
                    </v-btn>
                    <v-dialog v-model="showStepperpublicados" width="50%">
                      <v-stepper v-model="e1">
                        <v-stepper-header>
                          <v-stepper-step :complete="e1 > 1" step="1" color="#0A263D">
                            Detalles del viaje
                          </v-stepper-step>
                        </v-stepper-header>

                        <v-stepper-items>
                          <!-- Paso 1: Detalles del viaje -->
                          <v-stepper-content step="1">
                            <v-card class="no-border" color="white" elevation="0">
                              <v-card-title class="fontTitle">
                                Detalles del viaje
                              </v-card-title>
                              <v-card-text>
                                <!-- Aquí puedes agregar más detalles específicos del viaje -->
                                <p v-if="detallesViaje">
                                  Descripcion del viaje: {{ detallesViaje.descripcion }}
                                </p>
                                <p v-if="detallesViaje">
                                  Fecha y hora del viaje: el {{ detallesViaje.fecha }}, a las {{ detallesViaje.hora }}
                                </p>
                                <p v-if="detallesViaje">
                                  Inicio del viaje en: {{ detallesViaje.inicio }}
                                </p>
                                <p v-if="detallesViaje">
                                  Destino del viaje: {{ detallesViaje.destino }}
                                </p>
                                <p v-if="detallesViaje">
                                  Precio del viaje por persona: ${{ detallesViaje.precio }} MXN
                                </p>
                                <p>
                                  Cupo: 4
                                </p>
                              </v-card-text>
                            </v-card>
                            <div class="button-container">
                              <v-btn align="center" justify="center" color="#8C6E39" class="white--text" @click="showStepperpublicados = false">
                                Salir
                              </v-btn>
                            </div>
                          </v-stepper-content>
                        </v-stepper-items>
                      </v-stepper>
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
          <h2>Mis viajes apartados</h2>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <div v-if="panel.includes(1)">
            <div class="filtro-button" @click="toggleFiltro('apartados')">
              <v-icon>mdi-filter</v-icon> Filtrar
            </div>
            <div v-show="mostrarMenuFiltro.apartados" class="filtro-controls">
              <div class="filtro-menu">
                <div>
                  <label for="horaApartados">Hora:</label>
                  <input id="horaApartados" v-model="filtroHoraApartados" type="text" @input="filtrarViajes('apartados')">
                </div>
                <div>
                  <label for="fechaApartados">Fecha:</label>
                  <input id="fechaApartados" v-model="filtroFechaApartados" type="text" @input="filtrarViajes('apartados')">
                </div>
                <div>
                  <label for="destinoApartados">Destino:</label>
                  <input id="destinoApartados" v-model="filtroDestinoApartados" type="text" @input="filtrarViajes('apartados')">
                </div>
                <div>
                  <label for="precioApartados">Precio:</label>
                  <input id="precioApartados" v-model="filtroPrecioApartados" type="text" @input="filtrarViajes('apartados')">
                </div>
              </div>
            </div>
          </div>
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
                    <v-btn color="warning" dark @click="mostrarDetalles(raite)">
                      Ver detalles
                    </v-btn>
                    <v-dialog v-model="showStepperpublicados" width="50%">
                      <v-stepper v-model="e1">
                        <v-stepper-header>
                          <v-stepper-step :complete="e1 > 1" step="1" color="#0A263D">
                            Detalles del viaje
                          </v-stepper-step>
                        </v-stepper-header>

                        <v-stepper-items>
                          <!-- Paso 1: Detalles del viaje -->
                          <v-stepper-content step="1">
                            <v-card class="no-border" color="white" elevation="0">
                              <v-card-title class="fontTitle">
                                Detalles del viaje
                              </v-card-title>
                              <v-card-text>
                                <!-- Aquí puedes agregar más detalles específicos del viaje -->
                                <p v-if="detallesViaje">
                                  Descripcion del viaje: {{ detallesViaje.descripcion }}
                                </p>
                                <p v-if="detallesViaje">
                                  Fecha y hora del viaje: el {{ detallesViaje.fecha }}, a las {{ detallesViaje.hora }}
                                </p>
                                <p v-if="detallesViaje">
                                  Inicio del viaje en: {{ detallesViaje.inicio }}
                                </p>
                                <p v-if="detallesViaje">
                                  Destino del viaje: {{ detallesViaje.destino }}
                                </p>
                                <p v-if="detallesViaje">
                                  Precio del viaje por persona: ${{ detallesViaje.precio }} MXN
                                </p>
                                <p>
                                  Cupo: 4
                                </p>
                                <p>
                                  Luagres reservados: 2
                                </p>
                              </v-card-text>
                            </v-card>
                            <div class="button-container">
                              <v-btn align="center" justify="center" color="#8C6E39" class="white--text" @click="showStepperpublicados = false">
                                Salir
                              </v-btn>
                            </div>
                          </v-stepper-content>
                        </v-stepper-items>
                      </v-stepper>
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
        <v-expansion-panel-header>
          <h2>Viajes disponibles</h2>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <div v-if="panel.includes(2)">
            <div class="filtro-button" @click="toggleFiltro('disponibles')">
              <v-icon>mdi-filter</v-icon> Filtrar
            </div>
            <div v-show="mostrarMenuFiltro.disponibles" class="filtro-controls">
              <div class="filtro-menu">
                <div>
                  <label for="horaDisponibles">Hora:</label>
                  <input id="horaDisponibles" v-model="filtroHoraDisponibles" type="text" @input="filtrarViajes('disponibles')">
                </div>
                <div>
                  <label for="fechaDisponibles">Fecha:</label>
                  <input id="fechaDisponibles" v-model="filtroFechaDisponibles" type="text" @input="filtrarViajes('disponibles')">
                </div>
                <div>
                  <label for="destinoDisponibles">Destino:</label>
                  <input id="destinoDisponibles" v-model="filtroDestinoDisponibles" type="text" @input="filtrarViajes('disponibles')">
                </div>
                <div>
                  <label for="precioDisponibles">Precio:</label>
                  <input id="precioDisponibles" v-model="filtroPrecioDisponibles" type="text" @input="filtrarViajes('disponibles')">
                </div>
              </div>
            </div>
          </div>
          <v-container>
            <v-row>
              <v-col
                v-for="(raite, index) in viajesDisponibles"
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
                          src="https://icones.pro/wp-content/uploads/2021/04/icone-cercle-rempli-vert.png"
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
                    <v-btn color="warning" dark @click="openStepper(raite)">
                      Ver detalles
                    </v-btn>
                    <v-dialog v-model="showStepper" width="50%">
                      <v-stepper v-model="e1">
                        <v-stepper-header>
                          <v-stepper-step :complete="e1 > 1" step="1" color="#0A263D">
                            Detalles del viaje
                          </v-stepper-step>
                          <v-divider />
                          <v-stepper-step :complete="e1 > 2" step="2" color="#0A263D">
                            Información del pasajero
                          </v-stepper-step>
                          <v-divider />
                          <v-stepper-step step="3" color="#0A263D">
                            Resumen de pago
                          </v-stepper-step>
                        </v-stepper-header>

                        <v-stepper-items>
                          <!-- Paso 1: Detalles del viaje -->
                          <v-stepper-content step="1">
                            <v-card class="no-border" color="white" elevation="0">
                              <v-card-title class="fontTitle">
                                Detalles del viaje
                              </v-card-title>
                              <v-card-text>
                                <!-- Aquí puedes agregar más detalles específicos del viaje -->
                                <p v-if="detallesViaje">
                                  Descripcion del viaje: {{ detallesViaje.descripcion }}
                                </p>
                                <p v-if="detallesViaje">
                                  Fecha y hora del viaje: el {{ detallesViaje.fecha }}, a las {{ detallesViaje.hora }}
                                </p>
                                <p v-if="detallesViaje">
                                  Inicio del viaje en: {{ detallesViaje.inicio }}
                                </p>
                                <p v-if="detallesViaje">
                                  Destino del viaje: {{ detallesViaje.destino }}
                                </p>
                                <p v-if="detallesViaje">
                                  Precio del viaje por persona: ${{ detallesViaje.precio }} MXN
                                </p>
                              </v-card-text>
                            </v-card>
                            <div class="button-container">
                              <v-btn align="center" justify="center" color="#8C6E39" class="white--text" @click="e1 = 2">
                                Continuar
                              </v-btn>
                            </div>
                          </v-stepper-content>

                          <!-- Paso 2: Información del pasajero -->
                          <v-stepper-content step="2">
                            <v-card class="no-border" color="white" elevation="0">
                              <v-card-title class="fontTitle">
                                Información del pasajero
                              </v-card-title>
                              <v-card-text>
                                <v-text-field v-model="numeroPersonas" label="Número de personas" type="number" />
                                <v-text-field v-model="equipaje" label="Cantidad de equipaje (kg)" type="number" />
                              </v-card-text>
                            </v-card>
                            <div class="button-container">
                              <v-btn color="#8C6E39" class="white--text" @click="e1 = 1">
                                Atrás
                              </v-btn>
                              <v-btn color="#8C6E39" class="white--text" @click="e1 = 3">
                                Continuar
                              </v-btn>
                            </div>
                          </v-stepper-content>

                          <!-- Paso 3: Resumen de pago -->
                          <v-stepper-content step="3">
                            <v-card class="no-border" color="white" elevation="0">
                              <v-card-title class="fontTitle">
                                Resumen de pago
                              </v-card-title>
                              <v-card-text>
                                <p>Número de personas: {{ numeroPersonas }}</p>
                                <p>Equipaje: {{ equipaje }} kg</p>
                                <p>Precio total: ${{ totalPrice }} MXN</p>
                                <!-- Aquí puedes agregar más detalles sobre el pago -->
                              </v-card-text>
                            </v-card>
                            <div class="button-container">
                              <v-btn color="#8C6E39" class="white--text" @click="e1 = 2">
                                Atrás
                              </v-btn>
                              <v-btn color="#8C6E39" class="white--text" @click="realizarPago">
                                Pagar
                              </v-btn>
                              <v-btn color="#8C6E39" class="white--text" @click="showStepper = false">
                                Cancelar
                              </v-btn>
                            </div>
                          </v-stepper-content>
                        </v-stepper-items>
                      </v-stepper>
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
    </v-expansion-panels>
  </div>
</template>

<script>
export default {
  layout: 'home',
  auth: true,
  data () {
    return {
      showStepper: false,
      showStepperpublicados: false,
      e1: 1,
      equipaje: 0,
      cupo: 4,
      totalPago: 0,
      viajeDetalles: 'Detalles específicos del viaje...',
      numeroPersonas: 0,
      mostrarMenuFiltro: {
        publicados: false,
        apartados: false,
        disponibles: false
      },
      panel: [0, 1, 2],
      filtroHoraPublicados: '',
      filtroFechaPublicados: '',
      filtroDestinoPublicados: '',
      filtroPrecioPublicados: '',
      filtroHoraApartados: '',
      filtroFechaApartados: '',
      filtroDestinoApartados: '',
      filtroPrecioApartados: '',
      filtroHoraDisponibles: '',
      filtroFechaDisponibles: '',
      filtroDestinoDisponibles: '',
      filtroPrecioDisponibles: '',
      misViajesPublicadosOriginal: [],
      misViajesApartadosOriginal: [],
      viajesDisponiblesOriginal: [],
      id: [],
      viajes: [],
      misViajesPublicados: [],
      misViajesApartados: [],
      viajesDisponibles: [],
      todosViajesPublicados: [],
      todosViajesApartados: [],
      todosViajesDisponibles: []
    }
  },
  computed: {
    totalPrice () {
      const costoPorPersonas = Number(this.numeroPersonas) * Number(this.totalPago)
      const costoPorEquipaje = Number(this.equipaje) * 5
      return costoPorPersonas + costoPorEquipaje
    }
  },
  created () {
    this.cargarViajes()
  },
  mounted () {
    this.recuperarDatos()
  },
  methods: {
    openStepper (raite) {
      this.totalPago = raite.precio
      this.numeroPersonas = 1 // O cualquier valor por defecto
      this.showStepper = true
      this.detallesViaje = raite
    },
    mostrarDetalles (raite) {
      this.detallesViaje = raite
      this.showStepperpublicados = true
    },
    cargarViajes () {
      const viajesPublicados = [/* ...datos de viajes publicados... */]
      const viajesApartados = [/* ...datos de viajes apartados... */]
      const viajesDisponibles = [/* ...datos de viajes disponibles... */]

      this.misViajesPublicados = viajesPublicados
      this.misViajesApartados = viajesApartados
      this.viajesDisponibles = viajesDisponibles

      // Guardamos las listas originales
      this.misViajesPublicadosOriginal = [...viajesPublicados]
      this.misViajesApartadosOriginal = [...viajesApartados]
      this.viajesDisponiblesOriginal = [...viajesDisponibles]
    },
    filtrarViajes (tipo) {
      let viajes = []
      switch (tipo) {
        case 'publicados':
          viajes = this.misViajesPublicados
          break
        case 'apartados':
          viajes = this.misViajesApartados
          break
        case 'disponibles':
          viajes = this.viajesDisponibles
          break
      }

      const viajesFiltrados = viajes.filter((viaje) => {
        const hora = this[`filtroHora${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`]
        const fecha = this[`filtroFecha${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`]
        const destino = this[`filtroDestino${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`]
        const precio = this[`filtroPrecio${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`]

        // Aplicar filtros si están definidos
        if (hora && !viaje.hora.toLowerCase().includes(hora.toLowerCase())) {
          return false
        }
        if (fecha && !viaje.fecha.toLowerCase().includes(fecha.toLowerCase())) {
          return false
        }
        if (destino && !viaje.destino.toLowerCase().includes(destino.toLowerCase())) {
          return false
        }
        if (precio && !viaje.precio.toString().includes(precio)) {
          return false
        }
        return true
      })

      switch (tipo) {
        case 'publicados':
          this.misViajesPublicados = viajesFiltrados
          break
        case 'apartados':
          this.misViajesApartados = viajesFiltrados
          break
        case 'disponibles':
          this.viajesDisponibles = viajesFiltrados
          break
      }
    },
    realizarPago () {
      // Lógica para realizar el pago
      console.log('Pago realizado')
      this.showStepper = false
    },
    recuperarDatos () {
      const url = '/home'
      const id = this.$store.state.user.id
      const params = {
        id
      }
      // solicitud get que pasa un objeto con el ID del usuario
      this.$axios.get(url, { params })
        .then((res) => {
          if (res.data.success) {
            this.misViajesPublicados = res.data.viajesPublicados
            this.misViajesPublicados = res.data.viajesPublicados
            this.misViajesApartados = res.data.viajesReservados
            this.viajesDisponibles = res.data.viajes
            this.viajes = [...res.data.viajesPublicados, ...res.data.viajesReservados, ...res.data.viajes]
            // Almacena todos los viajes para restablecer después del filtro
            this.todosViajesPublicados = [...res.data.viajesPublicados]
            this.todosViajesApartados = [...res.data.viajesReservados]
            this.todosViajesDisponibles = [...res.data.viajes]
          }
        })
    },
    toggleFiltro (tipo) {
      this.mostrarMenuFiltro[tipo] = !this.mostrarMenuFiltro[tipo]
      if (!this.mostrarMenuFiltro[tipo]) {
        this.restablecerFiltros(tipo)
      }
    },
    restablecerViajes (tipo) {
      if (tipo === 'publicados') {
        this.misViajesPublicados = [...this.misViajesPublicadosOriginal]
      } else if (tipo === 'apartados') {
        this.misViajesApartados = [...this.misViajesApartadosOriginal]
      } else if (tipo === 'disponibles') {
        this.viajesDisponibles = [...this.viajesDisponiblesOriginal]
      }
    },
    restablecerFiltros (tipo) {
      this[`filtroHora${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`] = ''
      this[`filtroFecha${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`] = ''
      this[`filtroDestino${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`] = ''
      this[`filtroPrecio${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`] = ''

      switch (tipo) {
        case 'publicados':
          this.misViajesPublicados = [...this.todosViajesPublicados]
          break
        case 'apartados':
          this.misViajesApartados = [...this.todosViajesApartados]
          break
        case 'disponibles':
          this.viajesDisponibles = [...this.todosViajesDisponibles]
          break
      }
    },
    getClassForEstado (tipo) {
      let viajesFiltrados = []
      switch (tipo) {
        case 'publicados':
          viajesFiltrados = this.misViajesPublicados
          break
        case 'apartados':
          viajesFiltrados = this.misViajesApartados
          break
        case 'disponibles':
          viajesFiltrados = this.viajesDisponibles
          break
      }
      return viajesFiltrados
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
