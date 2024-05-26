<template>
  <div>
    <div class="filtro-button" @click="toggleFiltro">
      <i class="fas fa-filter" /> Filtrar
    </div>
    <!-- Controles de filtro -->
    <div v-show="mostrarFiltro" class="filtro-controls">
      <div class="filtro-menu">
        <div>
          <label for="hora">Hora:</label>
          <input id="hora" v-model="filtroHora" type="text" @input="filtrarRaites">
        </div>
        <div>
          <label for="fecha">Fecha:</label>
          <input id="fecha" v-model="filtroFecha" type="text" @input="filtrarRaites">
        </div>
        <div>
          <label for="destino">Destino:</label>
          <input id="destino" v-model="filtroDestino" type="text" @input="filtrarRaites">
        </div>
      </div>
    </div>

    <!-- Aniadiendo mi trabajo-->
    <!-- Tarjetas para "Mis viajes publicados"-->
    <h2>Mis viajes publicados</h2>
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
                  {{ raite.lugarPartida }}
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
                  {{ raite.estado }}
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
              <v-btn color="warning" dark>
                Ver detalles
              </v-btn>
              <v-spacer />
              <v-btn color="warning" dark>
                Contactar
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>

    <!-- Tarjetas para "Mis viajes apartados"-->
    <h2>Mis viajes apartados</h2>
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
                  {{ raite.lugarPartida }}
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
                  {{ raite.estado }}
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
              <v-btn color="warning" dark>
                Ver detalles
              </v-btn>
              <v-spacer />
              <v-btn color="warning" dark>
                Contactar
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>

    <!-- Tarjetas para "Viajes Disponibles"-->
    <h2>Viajes Disponibles</h2>
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
                  {{ raite.lugarPartida }}
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
                  {{ raite.estado }}
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
              <v-btn color="warning" dark @click="abrirDialogoDetalles(raite)">
                Ver detalles
              </v-btn>
              <v-spacer />
              <v-btn color="warning" dark>
                Contactar
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
    <v-dialog v-model="dialogDetalles" max-width="600px">
    <v-stepper v-model="pasoActual">
      <v-stepper-header>
        <v-stepper-step :complete="pasoActual > 1" step="1">Detalles del viaje</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :complete="pasoActual > 2" step="2">Equipaje</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step step="3">Personas</v-stepper-step>
      </v-stepper-header>

      <v-stepper-items>
        <v-stepper-content step="1">
          <v-card>
            <v-card-text>
              <h3 v-if="detallesViaje">{{ detallesViaje.lugarPartida }}</h3>
              <p v-if="detallesViaje">Hora de salida: {{ detallesViaje.hora }}</p>
              <p v-if="detallesViaje">Fecha: {{ detallesViaje.fecha }}</p>
              <p v-if="detallesViaje">Destino: {{ detallesViaje.destino }}</p>
              <p v-if="detallesViaje">Precio: ${{ detallesViaje.precio }} MXN</p>
            </v-card-text>
            <v-card-actions>
              <v-btn color="primary" @click="pasoActual = 2">Siguiente</v-btn>
            </v-card-actions>
          </v-card>
        </v-stepper-content>

        <v-stepper-content step="2">
          <v-card>
            <v-card-text>
              <v-select v-model="equipajeSeleccionado" :items="opcionesEquipaje" label="Selecciona el equipaje"></v-select>
            </v-card-text>
            <v-card-actions>
              <v-btn color="primary" @click="pasoActual = 3">Siguiente</v-btn>
            </v-card-actions>
          </v-card>
        </v-stepper-content>

        <v-stepper-content step="3">
          <v-card>
            <v-card-text>
              <v-counter v-model="numerPersonas" :rules="reglas"></v-counter>
            </v-card-text>
            <v-card-actions>
              <v-btn color="primary" @click="dialogDetalles = false">Finalizar</v-btn>
            </v-card-actions>
          </v-card>
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
  </v-dialog>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  layout: 'home',
  auth: true,

  data () {
    return {
      dialogDetalles: false,
      pasoActual: 1,
      detallesViaje: {},
      equipajeSeleccionado: null,
      opcionesEquipaje: ['Equipaje de mano', 'Maleta grande', 'Maleta mediana'],
      numerPersonas: 1,
      reglas: [
        value => value > 0 || 'El número de personas debe ser mayor a 0'
      ],
      raites: [
        { estado: 'Publicado', lugarPartida: 'Mérida', hora: '13:14', fecha: '2024-06-07', destino: 'Oaxaca', precio: 500 },
        { estado: 'Publicado', lugarPartida: 'Puebla', hora: '05:49', fecha: '2024-05-26', destino: 'Oaxaca', precio: 450 },
        { estado: 'Publicado', lugarPartida: 'Cancún', hora: '10:13', fecha: '2024-05-13', destino: 'Oaxaca', precio: 550 },
        { estado: 'Publicado', lugarPartida: 'Zacatecas', hora: '06:34', fecha: '2024-06-04', destino: 'Monterrey', precio: 350 },
        { estado: 'Publicado', lugarPartida: 'Oaxaca', hora: '19:23', fecha: '2024-05-24', destino: 'Veracruz', precio: 400 },
        { estado: 'Apartado', lugarPartida: 'Oaxaca', hora: '01:18', fecha: '2024-05-11', destino: 'Tijuana', precio: 600 },
        { estado: 'Apartado', lugarPartida: 'Veracruz', hora: '16:33', fecha: '2024-05-20', destino: 'Monterrey', precio: 400 },
        { estado: 'Apartado', lugarPartida: 'Mérida', hora: '02:43', fecha: '2024-05-31', destino: 'Zacatecas', precio: 480 },
        { estado: 'Apartado', lugarPartida: 'Monterrey', hora: '13:52', fecha: '2024-05-09', destino: 'Veracruz', precio: 420 },
        { estado: 'Apartado', lugarPartida: 'Puebla', hora: '15:08', fecha: '2024-06-05', destino: 'Ciudad de México', precio: 350 },
        { estado: 'Disponible', lugarPartida: 'Mérida', hora: '09:57', fecha: '2024-05-13', destino: 'Veracruz', precio: 450 },
        { estado: 'Disponible', lugarPartida: 'Cancún', hora: '06:19', fecha: '2024-05-12', destino: 'Mérida', precio: 500 },
        { estado: 'Disponible', lugarPartida: 'Puebla', hora: '05:34', fecha: '2024-05-21', destino: 'Mazatlán', precio: 550 },
        { estado: 'Disponible', lugarPartida: 'Mazatlán', hora: '02:30', fecha: '2024-05-27', destino: 'Puebla', precio: 350 },
        { estado: 'Disponible', lugarPartida: 'Durango', hora: '05:26', fecha: '2024-05-18', destino: 'Oaxaca', precio: 500 }
        // Agrega más objetos de raites según sea necesario
      ],
      filtroHora: '',
      filtroFecha: '',
      filtroDestino: '',
      mostrarFiltro: false,

      // References
      labels: ['SU', 'MO', 'TU', 'WED', 'TH', 'FR', 'SA'],
      time: 0,
      forecast: [
        { day: 'Tuesday', icon: 'mdi-white-balance-sunny', temp: '24\xB0/12\xB0' },
        { day: 'Wednesday', icon: 'mdi-white-balance-sunny', temp: '22\xB0/14\xB0' },
        { day: 'Thursday', icon: 'mdi-cloud', temp: '25\xB0/15\xB0' }
      ]
    }
  },

  computed: {
    ...mapState({
      token: state => state.token
    }),
    misViajesPublicados () {
      return this.raites.filter(raite => raite.estado === 'Publicado')
    },
    misViajesApartados () {
      return this.raites.filter(raite => raite.estado === 'Apartado')
    },
    viajesDisponibles () {
      return this.raites.filter(raite => raite.estado === 'Disponible')
    },
    raitesFiltrados () {
      let raitesFiltrados = this.raites

      // Filtrar por hora
      if (this.filtroHora) {
        raitesFiltrados = raitesFiltrados.filter(raite => raite.hora.includes(this.filtroHora))
      }

      // Filtrar por fecha
      if (this.filtroFecha) {
        raitesFiltrados = raitesFiltrados.filter(raite => raite.fecha.includes(this.filtroFecha))
      }

      // Filtrar por destino
      if (this.filtroDestino) {
        raitesFiltrados = raitesFiltrados.filter(raite => raite.destino.includes(this.filtroDestino))
      }
      return raitesFiltrados
    }
  },

  mounted () {

  },

  methods: {
    abrirDialogoDetalles (raite) {
      this.detallesViaje = raite
      this.dialogDetalles = true
    },
    filtrarRaites () {
      // Método de filtro ejecutado cuando cambian los valores de los controles de filtro
    },
    toggleFiltro () {
      this.mostrarFiltro = !this.mostrarFiltro
    },
    getClassForEstado (estado) {
      switch (estado) {
        case 'Publicado':
          return 'estado-publicado'
        case 'Apartado':
          return 'estado-apartado'
        case 'Disponible':
          return 'estado-disponible'
        default:
          return ''
      }
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
}

.filtro-menu {
  background-color: #ffffff;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

/* Estilos para los elementos dentro del menú desplegable */
.filtro-menu div {
  margin-bottom: 10px;
}

.filtro-menu label {
  display: inline-block;
  width: 80px;
  font-weight: bold;
}

.filtro-menu input {
  width: calc(100% - 90px);
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
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
</style>
