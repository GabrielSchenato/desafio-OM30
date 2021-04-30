<template>
  <v-app dark>
    <router-view></router-view>
    <v-navigation-drawer v-model="rightDrawer" class="setting-drawer" temporary right hide-overlay fixed>
      <template v-if="showSetting"> </template>
      <template v-else>
        <online-user />
      </template>
    </v-navigation-drawer>
  </v-app>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      rightDrawer: false,
      showSetting: true,
    }
  },
  computed: {},
  mounted() {
    if (typeof window !== undefined && window._VMA === undefined) {
      window._VMA = this
    }
  },
}
</script>

<style lang="sass" scoped>
.setting-fab
  top: 50% !important
  right: 0
  border-radius: 0
.chat-fab
  top: calc(50% + 40px) !important
  right: 0
  border-radius: 0
</style>
