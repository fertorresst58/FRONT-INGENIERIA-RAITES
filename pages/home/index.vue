<template>
  <div>
    <v-expansion-panels
      v-model="panel"
      class="expansion-panels"
      accordion
    >
      <!-- Tarjetas para "Mis viajes publicados" -->
      <v-expansion-panel>
        <v-expansion-panel-header class="coyoteBack white--text">
          <h2 class="fontTitle">
            Mis viajes publicados
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
                  v-model="searchPublicados"
                  class="fontTitle"
                  prepend-inner-icon="mdi-magnify"
                  dense
                  solo
                  flat
                  outlined
                  type="text"
                  hide-details
                />
              </v-row>
            </v-col>
            <v-row>
              <v-col
                v-for="(raite, index) in filtroPublicados()"
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
                          <v-icon color="white">mdi-circle</v-icon>
                          &nbsp;&nbsp;PUBLICADO
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
                      @click="mostrarDetallesPublicado(raite)"
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

      <!-- Tarjetas para "Mis viajes apartados"-->
      <v-expansion-panel>
        <v-expansion-panel-header class="coyoteBack white--text">
          <h2 class="fontTitle">
            Mis viajes apartados
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
                  v-model="searchApartados"
                  class="fontTitle"
                  prepend-inner-icon="mdi-magnify"
                  dense
                  solo
                  flat
                  outlined
                  type="text"
                  hide-details
                />
              </v-row>
            </v-col>
            <v-row>
              <v-col
                v-for="(raite, index) in filtroApartados()"
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
                          <v-icon color="white">mdi-triangle</v-icon>
                          &nbsp;&nbsp;APARTADO
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
                      @click="mostrarDetallesApartados(raite)"
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
                  v-model="searchDisponibles"
                  class="fontTitle"
                  prepend-inner-icon="mdi-magnify"
                  dense
                  solo
                  flat
                  outlined
                  type="text"
                  hide-details
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
              </v-col>
            </v-row>
          </v-container>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>

    <!-- DIALOG PUBLICADOS -->
    <v-dialog
      v-model="dialogPublicados"
      width="500px"
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
          <strong>{{ raitePublicadoSelected.inicio }}</strong>
          <br>
          <small>DESTINO: </small>
          <strong>{{ raitePublicadoSelected.destino }}</strong>
          <br>
          <small>CONDUCTOR: </small>
          <strong>{{ raitePublicadoSelected.conductor }}</strong>
          <br>
          <small>FECHA: </small>
          <strong>{{ formatearFecha(raitePublicadoSelected.fecha) }}</strong>
          <br>
          <small>HORA: </small>
          <strong>{{ formatearHora(raitePublicadoSelected.hora) }}</strong>
          <br>
          <small>ASIENTOS DISPONIBLES: </small>
          <strong>{{ raitePublicadoSelected.capacidad }}</strong>
          <br>
          <small>PRECIO: </small>
          <strong>$ {{ raitePublicadoSelected.precio }} MXN</strong>
          <br>
          <small>DESCRIPCIÓN: </small>
          <strong>{{ raitePublicadoSelected.descripcion }}</strong>

          <v-divider class="mt-4" />
        </v-card-text>

        <v-card-actions class="mt-5">
          <v-btn
            color="#8C6E39"
            elevation="0"
            block
            height="38px"
            class="white--text"
            @click="dialogPublicados = false"
          >
            CERRAR
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- DIALOG APARTADOS -->
    <v-dialog
      v-model="dialogApartados"
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
          <strong>{{ raiteApartadoSelected.inicio }}</strong>
          <br>
          <small>DESTINO: </small>
          <strong>{{ raiteApartadoSelected.destino }}</strong>
          <br>
          <small>CONDUCTOR: </small>
          <strong>{{ raiteApartadoSelected.conductor }}</strong>
          <br>
          <small>FECHA: </small>
          <strong>{{ formatearFecha(raiteApartadoSelected.fecha) }}</strong>
          <br>
          <small>HORA: </small>
          <strong>{{ formatearHora(raiteApartadoSelected.hora) }}</strong>
          <br>
          <small>ASIENTOS DISPONIBLES: </small>
          <strong>{{ raiteApartadoSelected.capacidad }}</strong>
          <br>
          <small>PRECIO: </small>
          <strong>$ {{ raiteApartadoSelected.precio }} MXN</strong>
          <br>
          <small>DESCRIPCIÓN: </small>
          <strong>{{ raiteApartadoSelected.descripcion }}</strong>

          <v-divider class="mt-4" />
        </v-card-text>
        <v-card-title class="fontTitle">
          <strong>REVIEWS</strong>
        </v-card-title>

        <v-row>
          <v-col cols="12">
            <v-card elevation="0" outlined>
              <v-card-title class="fontTitle">
                <span>Promedio de Reseñas</span>
              </v-card-title>
              <v-card-text>
                <v-rating :value="raiteApartadoSelected.avgReview" color="yellow darken-3" dense readonly />
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col v-for="review in raiteApartadoSelected.reviews" :key="review.id" cols="12" md="6">
            <v-card height="265px" elevation="0">
              <v-card-title class="fontTitle">
                <v-avatar>
                  <v-img :src="review.imagen" />
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

        <v-card-actions class="mt-5">
          <v-btn
            color="#8C6E39"
            elevation="0"
            block
            height="38px"
            class="white--text"
            @click="dialogApartados = false"
          >
            CERRAR
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- STEPPER DISPONIBLES -->
    <v-dialog
      v-model="dialogDisponibles"
      max-width="800px"
      persistent
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

                <v-divider class="mt-4" />
              </v-card-text>
              <v-card-title class="fontTitle">
                <strong>REVIEWS</strong>
              </v-card-title>

              <v-row>
                <v-col cols="12">
                  <v-card elevation="0" outlined>
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
                  <v-card height="265px" elevation="0">
                    <v-card-title class="fontTitle">
                      <v-avatar>
                        <v-img :src="review.imagen" />
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

          <v-stepper-content step="3" align="center" justify="center">
            <v-card
              class="mb-12 text-start"
              elevation="0"
              outlined
              width="500px"
            >
              <v-card-title class="fontTitle">
                <strong>TICKET</strong>
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
                <small>ASIENTOS: </small>
                <strong>{{ asientos }}</strong>
                <br>
                <small>COSTO POR PERSONA</small>
                <strong>$ {{ raiteDisponibleSelected.precio }}</strong>
                <br>
                <small>EQUIPAJE: </small>
                <v-list dense>
                  <v-list-item-group>
                    <v-list-item v-for="(equipaje, index) in equipajes" :key="index">
                      <v-list-item-content class="fontText">
                        <v-list-item-title>Pasajero {{ index + 1 }}</v-list-item-title>
                        <v-list-item-subtitle>
                          <v-list dense>
                            <v-list-item v-for="(item, idx) in equipaje" :key="idx">
                              <v-list-item-content class="fontText">
                                {{ item }}
                              </v-list-item-content>
                            </v-list-item>
                          </v-list>
                        </v-list-item-subtitle>
                      </v-list-item-content>
                    </v-list-item>
                  </v-list-item-group>
                </v-list>
                <br>
                <strong v-if="stepperDisponibles > 2">TOTAL: $ {{ getTotal() }} MXN</strong>
              </v-card-text>
            </v-card>

            <v-btn
              color="#FFD300"
              class="fontTitle"
              @click="realizarPago()"
            >
              <span style="text-transform: none;">Pagar</span>
            </v-btn>

            <v-btn text @click="stepperDisponibles = 2">
              <span style="text-transform: none;">Atrás</span>
            </v-btn>
          </v-stepper-content>
        </v-stepper-items>
      </v-stepper>
    </v-dialog>

    <!-- PAYMENT DIALOG -->
    <v-dialog v-model="dialogPay" max-width="300" height="300" persistent>
      <v-card v-if="successPay === ''" color="#0A263D" class="pa-5 fontDisplay">
        <v-card-text align="center" justify="center" class="white--text">
          <v-btn solo loading color="#0A263D" class="white--text" />
          <br>
          PROCESANDO PAGO
          <br>
          <br>
          CIERRE EL POPUP PARA CONTINUAR
        </v-card-text>
      </v-card>

      <v-card v-else-if="successPay === 'paid'" color="green darken-4" class="pa-5 fontDisplay">
        <v-card-text align="center" justify="center" class="white--text">
          <v-icon large color="white">
            mdi-check-circle-outline
          </v-icon>
          <br>
          PAGO EXITOSO
        </v-card-text>

        <v-card-actions class="pb-0 mb-0">
          <v-row align="center" justify="center">
            <v-col cols="12" align="center" justify="center">
              <v-btn
                color="#8C6E39"
                class="white--text mb-4 fontTitle"
                elevation="0"
                width="122px"
                rounded
                outlined
                @click="actualizarBD()"
              >
                CONTINUAR
              </v-btn>
            </v-col>
          </v-row>
        </v-card-actions>
      </v-card>

      <v-card v-else-if="successPay === 'unpaid'" color="red darken-4" class="pa-5 fontDisplay">
        <v-card-text align="center" justify="center" class="white--text">
          <v-icon large color="white">
            mdi-close-circle-outline
          </v-icon>
          <br>
          PAGO CANCELADO
        </v-card-text>

        <v-card-actions class="pb-0 mb-0">
          <v-row align="center" justify="center">
            <v-col cols="12" align="center" justify="center">
              <v-btn
                class="white--text mb-4 fontTitle"
                elevation="0"
                width="122px"
                rounded
                outlined
                @click="salirPago()"
              >
                SALIR
              </v-btn>
            </v-col>
          </v-row>
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
      // EXPANSION PANEL
      panel: [0, 1, 2],

      viajes: [],

      // VIAJES PUBLICADOS
      misViajesPublicados: [],
      searchPublicados: '',
      raitePublicadoSelected: [],

      // DIALOG PUBLICADOS
      dialogPublicados: false,

      // VIAJES APARTADOS
      misViajesApartados: [],
      searchApartados: '',
      raiteApartadoSelected: [],

      // DIALOG APARTADOS
      dialogApartados: false,

      // VIAJES DISPONIBLES
      viajesDisponibles: [],
      searchDisponibles: '',
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
      ],
      total: '',

      // STRIPE
      stripeKey: 'sk_test_51PJU8CRwWA3gXNirOlh2sPZyDCUDVUZr64Z8p9WFSB0vg3JM7g05hjXHSDIC95WE1zlcJV8f5NojTo9PCrVjprxe00kCiFwhK1',
      dialogPay: false,
      urlPay: '',
      sessionId: '',
      successPay: ''
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

    // FILTROS
    filtroPublicados () {
      return this.misViajesPublicados.filter(viaje =>
        viaje.destino.toLowerCase().includes(this.searchPublicados.toLowerCase())
      )
    },

    filtroApartados () {
      return this.misViajesApartados.filter(viaje =>
        viaje.destino.toLowerCase().includes(this.searchApartados.toLowerCase())
      )
    },

    filtroDisponibles () {
      return this.viajesDisponibles.filter(viaje =>
        viaje.destino.toLowerCase().includes(this.searchDisponibles.toLowerCase())
      )
    },

    async recuperarDatos () {
      const url = '/home'
      const user = this.$store.state.user
      if (!user || !user.id) {
        console.error('Error: Usuario no encontrado en el store.')
        return
      }
      const id = user.id
      const params = { id }

      try {
        const res = await this.$axios.get(url, { params })
        if (res.data.success) {
          this.misViajesPublicados = res.data.viajesPublicados
          this.misViajesApartados = res.data.viajesReservados
          console.log('🚀 ~ recuperarDatos ~ this.misViajesApartados:', this.misViajesApartados)

          const today = new Date()
          const formattedToday = today.toISOString().split('T')[0]

          this.viajesDisponibles = res.data.viajes.filter((viaje) => {
            return viaje.fecha >= formattedToday && viaje.capacidad > 0
          })

          // Procesar cada viaje para obtener su promedio de reseñas
          for (const viaje of [...this.misViajesApartados, ...this.viajesDisponibles]) {
            const reviews = await this.findAllReviews(viaje.id)
            const avgReview = this.calculateAverageReview(reviews)
            const resultDriver = await this.findDriver(viaje.id)
            if (!resultDriver) {
              continue
            }
            const conductor = resultDriver.user.nombre + ' ' + resultDriver.user.apaterno + ' ' + resultDriver.user.amaterno
            this.$set(viaje, 'reviews', reviews)
            this.$set(viaje, 'avgReview', avgReview) // Asigna el promedio de reseñas al objeto viaje
            this.$set(viaje, 'conductor', conductor)
          }
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

    mostrarDetallesPublicado (raite) {
      this.raitePublicadoSelected = raite
      this.dialogPublicados = true
    },

    mostrarDetallesApartados (raite) {
      this.raiteApartadoSelected = raite
      this.dialogApartados = true
    },

    mostrarDetallesDisponibles (raite) {
      this.raiteDisponibleSelected = raite
      this.dialogDisponibles = true
    },

    cerrarDialogDisponibles () {
      this.dialogDisponibles = false
      this.asientos = 0
      this.raiteDisponibleSelected = []
      this.equipajes = []
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

    getTotal () {
      const totalAsientos = this.asientos * this.raiteDisponibleSelected.precio
      const totalEquipaje = this.equipajes.reduce((total, equipaje) => {
        return total + equipaje.reduce((sum, item) => {
          const match = item.match(/\((\$\d+)\)/)
          const cost = match ? parseInt(match[1].replace('$', ''), 10) : 0
          return sum + cost
        }, 0)
      }, 0)
      this.total = totalAsientos + totalEquipaje
      return this.total
    },

    async realizarPago () {
      const data = {
        name: 'VIAJE A ' + this.raiteDisponibleSelected.destino.toUpperCase(),
        description: 'FECHA Y HORA: ' + this.raiteDisponibleSelected.fecha + ' ' + this.raiteDisponibleSelected.hora,
        unit_amount: Number(this.total) * 100
      }
      const url = '/create-checkout-session'

      try {
        const response = await this.$axios.post(url, data)
        if (response.data.success) {
          this.sessionId = response.data.session.id
          this.urlPay = response.data.session.url
          this.dialogPay = true
          const popup = window.open(this.urlPay, 'PAGAR BOLETOS', 'width=600,height=700')
          const interval = setInterval(() => {
            if (popup.closed) {
              clearInterval(interval)
              this.pruebaPago()
            }
          }, 1000)
        }
      } catch (error) {
        // eslint-disable-next-line no-console
        console.error('Error creating checkout session:', error)
      }
    },

    async pruebaPago () {
      const session = this.sessionId
      try {
        const res = await this.$axios.get(`https://api.stripe.com/v1/checkout/sessions/${session}`, {
          headers: {
            Authorization: `Bearer ${this.stripeKey}`,
            'Content-Type': 'application/json'
          }
        })
        if (res.data.payment_status === 'paid') {
          this.successPay = 'paid'
        } else if (res.data.payment_status === 'unpaid') {
          this.successPay = 'unpaid'
        }
      } catch (error) {
        // eslint-disable-next-line no-console
        console.error('Error al validar el pago:', error)
      }
    },

    salirPago () {
      this.dialogPay = false
      this.urlPay = ''
      this.sessionId = ''
      this.successPay = ''
    },

    actualizarBD () {
      console.log('VIAJE APARTADO CORRECTAMENTE')
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
