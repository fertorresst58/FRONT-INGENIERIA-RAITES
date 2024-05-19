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
    <v-card
      class="mx-auto"
      max-width="350"
    >
      <v-list-item two-line>
        <v-list-item-content>
          <v-list-item-title class="text-h5">
            SILAO
          </v-list-item-title>
          <v-list-item-subtitle>Jueves 04 de mayo, 15:00 PM</v-list-item-subtitle>
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
          <v-col
            class="text-h4"
            cols="10"
          >
            PUBLICADO
          </v-col>
        </v-row>
      </v-card-text>

      <v-list-item>
        <v-list-item-icon>
          <v-icon>mdi mdi-car-traction-control</v-icon>
        </v-list-item-icon>
        <v-list-item-subtitle>Puentes gemelos, central de Silao</v-list-item-subtitle>
      </v-list-item>

      <v-list-item>
        <v-list-item-icon>
          <v-icon>mdi mdi-hand-coin-outline</v-icon>
        </v-list-item-icon>
        <v-list-item-subtitle>$10.00MXN</v-list-item-subtitle>
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
    <!-- Finalizando  mi trabajo-->

    <!-- Tabla de raites filtrados -->
    <div>
      <!-- Tabla de "Mis viajes publicados" -->
      <h2>Mis viajes publicados</h2>
      <table>
        <thead>
          <tr>
            <th>Estado</th>
            <th>Lugar de Partida</th>
            <th>Hora</th>
            <th>Fecha</th>
            <th>Destino</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="(raite, index) in raitesFiltrados">
            <tr v-if="raite.estado === 'Publicado'" :key="index">
              <td :class="getClassForEstado(raite.estado)">
                {{ raite.estado }}
              </td>
              <td>{{ raite.lugarPartida }}</td>
              <td>{{ raite.hora }}</td>
              <td>{{ raite.fecha }}</td>
              <td>{{ raite.destino }}</td>
            </tr>
          </template>
        </tbody>
      </table>

      <!-- Tabla de "Mis viajes apartados" -->
      <h2>Mis viajes apartados</h2>
      <table>
        <thead>
          <tr>
            <th>Estado</th>
            <th>Lugar de Partida</th>
            <th>Hora</th>
            <th>Fecha</th>
            <th>Destino</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="(raite, index) in raitesFiltrados">
            <tr v-if="raite.estado === 'Apartado'" :key="index">
              <td :class="getClassForEstado(raite.estado)">
                {{ raite.estado }}
              </td>
              <td>{{ raite.lugarPartida }}</td>
              <td>{{ raite.hora }}</td>
              <td>{{ raite.fecha }}</td>
              <td>{{ raite.destino }}</td>
            </tr>
          </template>
        </tbody>
      </table>

      <!-- Tabla de "Viajes disponibles" -->
      <h2>Viajes disponibles</h2>
      <table>
        <thead>
          <tr>
            <th>Estado</th>
            <th>Lugar de Partida</th>
            <th>Hora</th>
            <th>Fecha</th>
            <th>Destino</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="(raite, index) in raitesFiltrados">
            <tr v-if="raite.estado === 'Disponible'" :key="index">
              <td :class="getClassForEstado(raite.estado)">
                {{ raite.estado }}
              </td>
              <td>{{ raite.lugarPartida }}</td>
              <td>{{ raite.hora }}</td>
              <td>{{ raite.fecha }}</td>
              <td>{{ raite.destino }}</td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  layout: 'home',
  auth: true,

  data () {
    return {
      raites: [
        { estado: 'Publicado', lugarPartida: 'A', hora: '08:00', fecha: '2024-05-09', destino: 'B' },
        { estado: 'Publicado', lugarPartida: 'C', hora: '09:30', fecha: '2024-05-10', destino: 'D' },
        { estado: 'Apartado', lugarPartida: 'E', hora: '10:45', fecha: '2024-05-11', destino: 'F' },
        { estado: 'Apartado', lugarPartida: 'G', hora: '12:15', fecha: '2024-05-12', destino: 'H' },
        { estado: 'Disponible', lugarPartida: 'T', hora: '12:15', fecha: '2024-05-12', destino: 'K' },
        { estado: 'Disponible', lugarPartida: 'Y', hora: '12:15', fecha: '2024-05-12', destino: 'L' }
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
