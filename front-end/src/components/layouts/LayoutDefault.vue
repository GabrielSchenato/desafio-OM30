<template>
  <div class="admin">
    <app-drawer ref="drawer" class="admin_drawer" @drawer:collapsed="mini = !mini" />
    <app-toolbar class="admin_toolbar" extended @side-icon-click="handleDrawerVisiable" />
    <v-main class="grey lighten-3">
      <div class="page_wrapper"><router-view /></div>
      <v-footer height="auto" class="pa-3 app--footer">
        <span>&copy; {{ new Date().getFullYear() }}</span>
        <v-spacer />
      </v-footer>
    </v-main>
    <app-fab />
  </div>
</template>

<script>
import AppDrawer from '@/components/AppDrawer'
import AppToolbar from '@/components/AppToolbar'
import AppFab from '@/components/AppFab'

export default {
  name: 'LayoutDefault',
  components: {
    AppDrawer,
    AppToolbar,
    AppFab,
  },

  data() {
    return {
      mini: false,
      showDrawer: true,
    }
  },
  methods: {
    handleDrawerVisiable() {
      this.$refs.drawer.toggleDrawer()
    },
  },
}
</script>

<style lang="sass" scoped>
.page_wrapper
  min-height: calc(100vh - 112px - 48px)
  padding-top: 35px
  .container
    max-width: 1200px
</style>
