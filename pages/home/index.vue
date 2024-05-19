<template>
  <v-app id="app">
    <v-container>
      <!-- Barra de herramientas con el ícono de filtro -->
      <v-toolbar flat>
        <v-toolbar-title>Viajes</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn color="blue" class="mr-3" @click="nuevoViaje">
          Nuevo Viaje
        </v-btn>
        <v-menu
          offset-y
          bottom
          :close-on-content-click="false"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn icon v-bind="attrs" v-on="on">
              <v-icon>mdi-filter-variant</v-icon>
            </v-btn>
          </template>
          <v-card>
            <v-list>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title>Filtrar por Fecha</v-list-item-title>
                  <v-container>
                    <v-row>
                      <v-col>
                        <v-text-field
                          label="Desde"
                          type="date"
                          class="date-field"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col>
                        <v-text-field
                          label="Hasta"
                          type="date"
                          class="date-field"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-list-item-content>
              </v-list-item>
              <v-divider></v-divider>
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title>Filtrar por Destino</v-list-item-title>
                  <v-text-field label="Destino"></v-text-field>
                </v-list-item-content>
              </v-list-item>
              <!-- Agrega más opciones de filtro según sea necesario -->
            </v-list>
          </v-card>
        </v-menu>
      </v-toolbar>

      <v-card class="treeview-card">
        <v-card-title>
          <span class="treeview-titlemvp">Mis Viajes Publicados</span>
        </v-card-title>
        <v-card-text>
          <v-treeview :items="publicadosData">
            <template #prepend="{ item }">
              <v-icon>{{ item.icon }}</v-icon>
            </template>
            <template #label="{ item }">
              {{ item.name }}
            </template>
          </v-treeview>
        </v-card-text>
      </v-card>

      <v-card class="treeview-card">
        <v-card-title>
          <span class="treeview-titlemva">Mis Viajes Apartados</span>
        </v-card-title>
        <v-card-text>
          <v-treeview :items="apartadosData">
            <template #prepend="{ item }">
              <v-icon>{{ item.icon }}</v-icon>
            </template>
            <template #label="{ item }">
              {{ item.name }}
            </template>
          </v-treeview>
        </v-card-text>
      </v-card>

      <v-card class="treeview-card">
        <v-card-title>
          <span class="treeview-titlemvd">Mis Viajes Disponibles</span>
        </v-card-title>
        <v-card-text>
          <v-treeview :items="disponiblesData">
            <template #prepend="{ item }">
              <v-icon>{{ item.icon }}</v-icon>
            </template>
            <template #label="{ item }">
              {{ item.name }}
            </template>
          </v-treeview>
        </v-card-text>
      </v-card>
    </v-container>
  </v-app>
</template>

<script>
export default {
  layout: 'home',
  data () {
    return {
      publicadosData: [
        {
          id: 1,
          name: 'Viaje Publicado 1',
          icon: 'mdi-folder',
          children: [
            { id: 2, name: 'Detalle 1', icon: 'mdi-file-outline' },
            { id: 3, name: 'Detalle 2', icon: 'mdi-file-outline' }
          ]
        }
      ],
      apartadosData: [
        {
          id: 4,
          name: 'Viaje Apartado 1',
          icon: 'mdi-folder',
          children: [
            { id: 5, name: 'Detalle 1', icon: 'mdi-file-outline' },
            { id: 6, name: 'Detalle 2', icon: 'mdi-file-outline' }
          ]
        }
      ],
      disponiblesData: [
        {
          id: 7,
          name: 'Viaje Disponible 1',
          icon: 'mdi-folder',
          children: [
            { id: 8, name: 'Detalle 1', icon: 'mdi-file-outline' },
            { id: 9, name: 'Detalle 2', icon: 'mdi-file-outline' }
          ]
        }
      ]
    }
  },
  methods: {
    nuevoViaje () {
      // Acción para el botón "Nuevo Viaje"
      console.log('Nuevo Viaje')
    }
  }
}
</script>

<style scoped>
.treeview-card {
  margin-bottom: 20px;
}

.treeview-titlemvp {
  color: blue;
}

.treeview-titlemva {
  color: rgb(255, 98, 0);
}

.treeview-titlemvd {
  color: rgb(17, 231, 21);
}

.v-treeview-node {
  font-size: 16px;
}

.v-treeview-node__label {
  color: #333;
}

.v-list-item + .v-divider {
  margin: 0;
}

.v-list-item {
  margin-bottom: 16px;
}
</style>
