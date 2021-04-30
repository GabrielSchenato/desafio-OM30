<template>
  <v-container class="page-login" fill-height>
    <v-row>
      <v-col :cols="12">
        <validation-observer ref="observer" v-slot="{ invalid }">
          <v-card class="pa-3 page-login__card" tile>
            <div class="primary--text display-1 text-center">OM30</div>
            <v-card-text>
              <v-alert border="top" colored-border type="info" elevation="2">
                <ul>
                  <li>E-mail: test@test.com</li>
                  <li>Senha: 12345678</li>
                </ul>
              </v-alert>
              <v-form ref="form" class="my-10" lazy-validation>
                <validation-provider v-slot="{ errors }" name="E-mail" rules="required|email">
                  <v-text-field
                    v-model="formModel.email"
                    :error-messages="errors"
                    append-icon="mdi-email"
                    autocomplete="off"
                    name="login"
                    label="E-mail"
                    placeholder="E-mail"
                    type="text"
                    required
                    outlined
                  />
                </validation-provider>
                <validation-provider v-slot="{ errors }" name="Senha" rules="required|min:8">
                  <v-text-field
                    v-model="formModel.password"
                    :error-messages="errors"
                    append-icon="mdi-lock"
                    autocomplete="off"
                    name="password"
                    label="Senha"
                    placeholder="Senha"
                    type="password"
                    required
                    outlined
                    @keyup.enter="handleLogin"
                  />
                </validation-provider>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer />
              <v-btn large tile color="primary" :disabled="invalid" @click="handleLogin"> Entrar </v-btn>
            </v-card-actions>
          </v-card>
        </validation-observer>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
const name = 'page-login'
import { setInteractionMode } from 'vee-validate'

setInteractionMode('eager')

export default {
  name: name,
  data() {
    return {
      formModel: {
        email: '',
        password: '',
      },
    }
  },
  computed: {},
  methods: {
    handleLogin() {
      this.$refs.observer.validate()
      if (!this.invalid) {
        this.$auth.login({
          data: this.formModel,
          success: function () {
            this.$router.push('/patients')
          },
          error: function (resp) {
            alert('Usuário ou senha incorretos!')
          },
          rememberMe: true,
          fetchUser: false,
        })
      }
    },
  },
}
</script>

<style lang="sass" scoped>
.page-login
  &__card
    max-width: 600px
    margin: 0 auto
</style>
