<template>
  <v-app-bar color="primary" dark app>
    <v-app-bar-nav-icon />
    <v-spacer />
    <v-toolbar-items>
      <v-btn icon @click="handleFullScreen()">
        <v-icon>mdi-fullscreen</v-icon>
      </v-btn>
    </v-toolbar-items>
    <v-toolbar v-if="extended" slot="extension" tag="div" dense color="white" light>
      <v-icon>mdi-home</v-icon>
      <v-breadcrumbs :items="breadcrumbs" class="pa-3" />
      <v-spacer></v-spacer>
      <v-btn icon small color="black">
        <v-icon @click="handleGoBack" v-text="'mdi-arrow-left'" />
      </v-btn>
    </v-toolbar>
  </v-app-bar>
</template>
<script>
import Util from '@/util'
export default {
  name: 'AppToolbar',
  components: {},
  props: {
    extended: Boolean,
  },
  data() {
    return {}
  },
  computed: {
    breadcrumbs() {
      const { matched } = this.$route
      return matched.map((route, index) => {
        const to = index === matched.length - 1 ? this.$route.path : route.path || route.redirect
        const text = route.meta.title
        return {
          text: text,
          to: to,
          exact: true,
          disabled: false,
        }
      })
    },
  },
  methods: {
    handleFullScreen() {
      Util.toggleFullScreen()
    },
    handleGoBack() {
      this.$router.go(-1)
    },
  },
}
</script>
