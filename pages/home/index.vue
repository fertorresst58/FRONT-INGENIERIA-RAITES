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
                v-for="(raite, index) in viajesFiltrados(misViajesPublicados)"
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
                    <v-dialog v-model="showStepperpublicados" width="50%" @click:outside="cerrarStepperPublicados" @keydown.esc="cerrarStepperPublicados">
                      <custom-stepper :value="e1" @input="e1 = $event">
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
                                <p v-if="detallesViajep">
                                  Descripcion del viaje: {{ detallesViajep.descripcion }}
                                </p>
                                <p v-if="detallesViajep">
                                  Fecha y hora del viaje: el {{ detallesViajep.fecha }}, a las {{ detallesViajep.hora }}
                                </p>
                                <p v-if="detallesViajep">
                                  Inicio del viaje en: {{ detallesViajep.inicio }}
                                </p>
                                <p v-if="detallesViaje">
                                  Destino del viaje: {{ detallesViaje.destino }}
                                </p>
                                <p v-if="detallesViajep">
                                  Precio del viaje por persona: ${{ detallesViajep.precio }} MXN
                                </p>
                                <p>
                                  Cupo: 4
                                </p>
                              </v-card-text>
                            </v-card>
                            <div class="button-container">
                              <v-btn align="center" justify="center" color="#8C6E39" class="white--text" @click="cerrarStepperPublicados">
                                Salir
                              </v-btn>
                            </div>
                          </v-stepper-content>
                        </v-stepper-items>
                      </custom-stepper>
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
                v-for="(raite, index) in viajesFiltrados(misViajesApartados)"
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
                    <v-dialog v-model="showStepperapartados" width="50%">
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
                                <p v-if="detallesViajea">
                                  Descripcion del viaje: {{ detallesViajea.descripcion }}
                                </p>
                                <p v-if="detallesViajea">
                                  Fecha y hora del viaje: el {{ detallesViajea.fecha }}, a las {{ detallesViajea.hora }}
                                </p>
                                <p v-if="detallesViajea">
                                  Inicio del viaje en: {{ detallesViajea.inicio }}
                                </p>
                                <p v-if="detallesViajea">
                                  Destino del viaje: {{ detallesViajea.destino }}
                                </p>
                                <p v-if="detallesViajea">
                                  Precio del viaje por persona: ${{ detallesViajea.precio }} MXN
                                </p>
                                <p>
                                  Cupo: 4
                                </p>
                                <p>
                                  Luagres reservados: 2
                                </p>
                                <h4>Reseñas</h4>
                                <p v-if="detallesViaje">
                                  Conductor: {{ detallesViaje.conductor }}
                                </p>
                                <div v-if="detallesViaje.avgReview !== undefined">
                                  <v-rating
                                    v-model="detallesViaje.avgReview"
                                    color="yellow darken-3"
                                    background-color="grey darken-1"
                                    empty-icon="$ratingFull"
                                    hover
                                    readonly
                                  />
                                  <p>
                                    Promedio de reseñas: {{ detallesViaje.avgReview.toFixed(2) }} / 5
                                  </p>
                                  <v-expansion-panels>
                                    <v-expansion-panel>
                                      <v-expansion-panel-header>
                                        <h5>Todas las reseñas</h5>
                                      </v-expansion-panel-header>
                                      <v-expansion-panel-content>
                                        <v-col
                                          v-for="(review, idx) in detallesViaje.reviews"
                                          :key="idx"
                                        >
                                          <div>
                                            <v-rating
                                              v-model="review.puntuacion"
                                              color="yellow darken-3"
                                              background-color="grey darken-1"
                                              empty-icon="$ratingFull"
                                              hover
                                              readonly
                                            />
                                          </div>
                                          <p v-if="review.comentario != null">
                                            "{{ review.comentario }}""
                                          </p>
                                        </v-col>
                                      </v-expansion-panel-content>
                                    </v-expansion-panel>
                                  </v-expansion-panels>
                                </div>
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
                v-for="(raite, index) in viajesFiltrados(viajesDisponibles)"
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
                    <v-dialog
                      v-if="showStepper"
                      ref="stepperDialog"
                      v-model="showStepper"
                      width="50%"
                      @click:outside="cerrarStepper"
                      @keydown.esc="cerrarStepper"
                    >
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
                                <h4>Reseñas</h4>
                                <p v-if="detallesViaje">
                                  Conductor: {{ detallesViaje.conductor }}
                                </p>
                                <div v-if="detallesViaje.avgReview !== undefined">
                                  <v-rating
                                    v-model="detallesViaje.avgReview"
                                    color="yellow darken-3"
                                    background-color="grey darken-1"
                                    empty-icon="$ratingFull"
                                    hover
                                    readonly
                                  />
                                  <p>
                                    Promedio de reseñas: {{ detallesViaje.avgReview.toFixed(2) }} / 5
                                  </p>
                                  <v-expansion-panels>
                                    <v-expansion-panel>
                                      <v-expansion-panel-header>
                                        <h5>Todas las reseñas</h5>
                                      </v-expansion-panel-header>
                                      <v-expansion-panel-content>
                                        <v-col
                                          v-for="(review, idx) in detallesViaje.reviews"
                                          :key="idx"
                                        >
                                          <div>
                                            <v-rating
                                              v-model="review.puntuacion"
                                              color="yellow darken-3"
                                              background-color="grey darken-1"
                                              empty-icon="$ratingFull"
                                              hover
                                              readonly
                                            />
                                          </div>
                                          <p v-if="review.comentario != null">
                                            "{{ review.comentario }}""
                                          </p>
                                        </v-col>
                                      </v-expansion-panel-content>
                                    </v-expansion-panel>
                                  </v-expansion-panels>
                                </div>
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
    <!-- Dialogo para detalles del viaje -->
    <v-dialog v-model="dialogDetalles" max-width="600px">
      <v-stepper v-model="pasoActual">
        <v-stepper-header>
          <v-stepper-step :complete="pasoActual > 1" step="1">
            Detalles del viaje
          </v-stepper-step>
          <v-divider />
          <v-stepper-step :complete="pasoActual > 2" step="2">
            Equipaje
          </v-stepper-step>
          <v-divider />
          <v-stepper-step step="3">
            Personas
          </v-stepper-step>
        </v-stepper-header>

        <v-stepper-items>
          <v-stepper-content step="1">
            <v-card>
              <v-card-text>
                <h3 v-if="detallesViaje">
                  {{ detallesViaje.lugarPartida }}
                </h3>
                <p v-if="detallesViaje">
                  Hora de salida: {{ detallesViaje.hora }}
                </p>
                <p v-if="detallesViaje">
                  Fecha: {{ detallesViaje.fecha }}
                </p>
                <p v-if="detallesViaje">
                  Destino: {{ detallesViaje.destino }}
                </p>
                <p v-if="detallesViaje">
                  Precio: ${{ detallesViaje.precio }} MXN
                </p>
              </v-card-text>
              <v-card-actions>
                <v-btn color="primary" @click="pasoActual = 2">
                  Siguiente
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-stepper-content>

          <v-stepper-content step="2">
            <v-card>
              <v-card-text>
                <v-select v-model="equipajeSeleccionado" :items="opcionesEquipaje" label="Selecciona el equipaje" />
              </v-card-text>
              <v-card-actions>
                <v-btn color="primary" @click="pasoActual = 3">
                  Siguiente
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-stepper-content>

          <v-stepper-content step="3">
            <v-card>
              <v-card-text>
                <v-counter v-model="numerPersonas" :rules="reglas" />
              </v-card-text>
              <v-card-actions>
                <v-btn color="primary" @click="dialogDetalles = false">
                  Finalizar
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-stepper-content>
        </v-stepper-items>
      </v-stepper>
    </v-dialog>
  </div>
</template>

<script>
import CustomStepper from '@/components/CustomStepper'

export default {
  components: {
    CustomStepper
  },
  layout: 'home',
  auth: true,
  props: {
    value: {
      type: Number,
      required: true
    }
  },
  data () {
    return {
      internalStep: this.value,
      showStepper: false,
      showStepperpublicados: false,
      showStepperapartados: false,
      detallesViaje: {},
      e1: 1,
      equipaje: 0,
      cupo: 4,
      totalPago: 0,
      viajeDetalles: 'Detalles específicos del viaje...',
      numeroPersonas: 0,
      detallesViajep: null,
      detallesViajea: null,
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

  watch: {
    value (newValue) {
      this.internalStep = newValue
    },
    internalStep (newValue) {
      this.$emit('input', newValue)
    }
  },

  created () {
    this.cargarViajes()
  },

  mounted () {
    this.recuperarDatos()
  },

  methods: {
    handleFocusIn (event) {
      // Maneja el evento focusin aquí
      // Puedes agregar lógica personalizada o dejar este método vacío
      // para evitar cualquier comportamiento no deseado
    },

    openStepper (raite) {
      this.totalPago = raite.precio
      this.numeroPersonas = 1 // O cualquier valor por defecto
      this.showStepper = true
      this.detallesViaje = raite
      this.e1 = 1 // Reiniciar al primer paso cada vez que se abre el stepper
    },

    cerrarStepper () {
      this.showStepper = false
      this.e1 = 1 // Reiniciar al primer paso cuando se cierra
      this.detallesViaje = null
      this.numeroPersonas = 0
      this.equipaje = 0
    },

    mostrarDetallesPublicados (raite) {
      try {
        this.$nextTick(() => {
          this.detallesViajep = raite
          this.showStepperpublicados = true
          this.e1 = 1
        })
      } catch (error) {
        console.error('Error al abrir el stepper:', error)
      }
    },

    cerrarStepperPublicados () {
      try {
        this.$nextTick(() => {
          this.showStepperpublicados = false
          if (this.$refs.stepper) {
            this.$refs.stepper.e1 = 1 // Resetea el stepper al primer paso
          }
        })
      } catch (error) {
        console.error('Error al cerrar el diálogo de detalles:', error)
      }
    },

    mostrarDetallesapartados (raite) {
      this.detallesViajea = raite
      this.showStepperapartados = true
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

    async recuperarDatos () {
      const url = '/home'
      const id = this.$store.state.user.id
      const params = { id }

      try {
        const res = await this.$axios.get(url, { params })
        if (res.data.success) {
          this.misViajesPublicados = res.data.viajesPublicados
          this.misViajesApartados = res.data.viajesReservados
          this.viajesDisponibles = res.data.viajes

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
          console.log('Viajes apartados => ', this.misViajesApartados)
          console.log('Viajes disponibles => ', this.viajesDisponibles)

          // Almacena todos los viajes para restablecer después del filtro
          this.todosViajesPublicados = [...res.data.viajesPublicados]
          this.todosViajesApartados = [...res.data.viajesReservados]
          this.todosViajesDisponibles = [...res.data.viajes]
        }
      } catch (error) {
        console.error('Error al recuperar los datos:', error)
      }
    },

    toggleFiltro (tipo) {
      this.mostrarMenuFiltro[tipo] = !this.mostrarMenuFiltro[tipo]
      if (!this.mostrarMenuFiltro[tipo]) {
        this.restablecerFiltros(tipo)
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
        console.error('Error =>', error)
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
          console.log('Data => ', res.data)
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
