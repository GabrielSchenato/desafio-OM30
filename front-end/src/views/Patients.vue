<template>
  <div class="page-patients">
    <v-container>
      <v-data-table :headers="headers" :items="patients" sort-by="calories" class="elevation-1">
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Pacientes</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog">
              <template v-slot:activator="{ on, attrs }">
                <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on"> Adicionar </v-btn>
              </template>

              <v-card>
                <v-card-title>
                  <span class="headline">{{ formTitle }}</span>
                </v-card-title>
                <validation-observer ref="observer" v-slot="{ invalid }">
                  <v-form ref="form" lazy-validation>
                    <v-card-text>
                      <v-container>
                        <v-row>
                          <v-col cols="12" sm="12" md="12">
                            <validation-provider v-slot="{ errors }" name="Nome" rules="required">
                              <v-text-field
                                :error-messages="errors"
                                v-model="editedItem.name"
                                label="Nome*"
                              ></v-text-field>
                            </validation-provider>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <validation-provider v-slot="{ errors }" name="Nome da Mãe" rules="required">
                              <v-text-field
                                :error-messages="errors"
                                v-model="editedItem.mothers_name"
                                label="Nome da Mãe*"
                              ></v-text-field>
                            </validation-provider>
                          </v-col>
                          <v-col cols="12" sm="6" md="6">
                            <validation-provider v-slot="{ errors }" name="Data de Nascimento" rules="required">
                              <v-dialog
                                ref="dialog"
                                v-model="modal"
                                :return-value.sync="editedItem.birthday"
                                persistent
                                width="290px"
                              >
                                <template v-slot:activator="{ on, attrs }">
                                  <v-text-field
                                    :error-messages="errors"
                                    v-model="editedItem.birthday"
                                    label="Data de Nascimento*"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                  ></v-text-field>
                                </template>
                                <v-date-picker v-model="editedItem.birthday" scrollable>
                                  <v-spacer></v-spacer>
                                  <v-btn text color="primary" @click="modal = false"> Cancel </v-btn>
                                  <v-btn text color="primary" @click="$refs.dialog.save(editedItem.birthday)">
                                    OK
                                  </v-btn>
                                </v-date-picker>
                              </v-dialog>
                            </validation-provider>
                          </v-col>
                          <v-col cols="12" sm="6" md="6">
                            <validation-provider v-slot="{ errors }" name="CPF" rules="required">
                              <v-text-field
                                :error-messages="errors"
                                v-model="editedItem.cpf"
                                label="CPF*"
                              ></v-text-field>
                            </validation-provider>
                          </v-col>
                          <v-col cols="12" sm="6" md="6">
                            <validation-provider v-slot="{ errors }" name="CNS" rules="required">
                              <v-text-field
                                :error-messages="errors"
                                v-model="editedItem.cns"
                                label="CNS*"
                              ></v-text-field>
                            </validation-provider>
                          </v-col>
                          <v-col cols="12" sm="6" md="6">
                            <validation-provider v-slot="{ errors }" name="CEP" rules="required">
                              <v-text-field
                                :error-messages="errors"
                                v-model="editedItem.cep"
                                label="CEP*"
                              ></v-text-field>
                            </validation-provider>
                          </v-col>
                          <v-col cols="12" sm="6" md="6">
                            <validation-provider v-slot="{ errors }" name="Rua" rules="required">
                              <v-text-field
                                :error-messages="errors"
                                v-model="editedItem.street"
                                label="Rua*"
                              ></v-text-field>
                            </validation-provider>
                          </v-col>
                          <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="editedItem.complement" label="Complemento"></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="6" md="6">
                            <validation-provider v-slot="{ errors }" name="Bairro" rules="required">
                              <v-text-field
                                :error-messages="errors"
                                v-model="editedItem.district"
                                label="Bairro*"
                              ></v-text-field>
                            </validation-provider>
                          </v-col>
                          <v-col cols="12" sm="6" md="6">
                            <validation-provider v-slot="{ errors }" name="Cidade" rules="required">
                              <v-text-field
                                :error-messages="errors"
                                v-model="editedItem.locality"
                                label="Cidade*"
                              ></v-text-field>
                            </validation-provider>
                          </v-col>
                          <v-col cols="12" sm="2" md="2">
                            <validation-provider v-slot="{ errors }" name="UF" rules="required|max:2">
                              <v-text-field :error-messages="errors" v-model="editedItem.uf" label="UF*"></v-text-field>
                            </validation-provider>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-card-text>

                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="blue darken-1" text @click="close"> Cancelar </v-btn>
                      <v-btn color="blue darken-1" text @click="save" :disabled="invalid"> Salvar </v-btn>
                    </v-card-actions>
                  </v-form>
                </validation-observer>
              </v-card>
            </v-dialog>
            <v-dialog v-model="dialogDelete" max-width="500px">
              <v-card>
                <v-card-title class="headline">Você tem certeza que deseja deletar?</v-card-title>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="closeDelete">Cancelar</v-btn>
                  <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                  <v-spacer></v-spacer>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
          <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
        </template>
        <template v-slot:no-data>
          <v-btn color="primary" @click="initialize"> Atualizar </v-btn>
        </template>
      </v-data-table>
    </v-container>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'PagePatients',
  data: () => ({
    dialog: false,
    dialogDelete: false,
    modal: false,
    headers: [
      {
        text: 'Nome',
        align: 'start',
        sortable: false,
        value: 'name',
      },
      { text: 'Nome da Mãe', value: 'mothers_name' },
      { text: 'Data de Nascimento', value: 'birthday' },
      { text: 'CPF', value: 'cpf' },
      { text: 'CNS', value: 'cns' },
      { text: 'Ações', value: 'actions', sortable: false },
    ],
    patients: [],
    editedIndex: -1,
    editedItem: {},
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? 'Adicionar' : 'Editar'
    },
  },

  watch: {
    dialog(val) {
      val || this.close()
    },
    dialogDelete(val) {
      val || this.closeDelete()
    },
  },

  created() {
    this.initialize()
  },

  methods: {
    initialize() {
      axios.get('patients').then((response) => {
        this.patients = response.data.patients
      })
    },

    editItem(item) {
      this.editedIndex = this.patients.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem(item) {
      this.editedIndex = this.patients.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialogDelete = true
    },

    deleteItemConfirm() {
      axios
        .delete(`patients/${this.editedItem.id}`)
        .then((response) => {
          this.initialize()
          this.close()
          this.$refs.observer.reset()
        })
        .catch((error) => {
          alert('Ops! Houve um erro.')
        })
      this.closeDelete()
    },

    close() {
      this.dialog = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    closeDelete() {
      this.dialogDelete = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    save() {
      this.$refs.observer.validate()
      if (!this.invalid) {
        if (this.editedItem.id) {
          axios
            .put(`patients/${this.editedItem.id}`, this.editedItem)
            .then((response) => {
              this.initialize()
              this.close()
              this.$refs.observer.reset()
            })
            .catch((error) => {
              alert('Ops! Houve um erro.')
            })
        } else {
          axios
            .post('patients', this.editedItem)
            .then((response) => {
              this.initialize()
              this.close()
              this.$refs.observer.reset()
            })
            .catch((error) => {
              alert('Ops! Houve um erro.')
            })
        }
      }
    },
  },
}
</script>