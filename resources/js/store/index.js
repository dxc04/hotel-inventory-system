import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(Vuex)
Vue.use(VueAxios, axios)

export default new Vuex.Store({
  state: {
    user: {},
    app_name: {},
    rooms_data: {}
  },
  actions: {
    loadAllTheData({ commit }, atd) {
      commit('mutateUser', atd.user)
      commit('mutateAppName', atd.app_name)
      commit('mutateRoomsData', atd.rooms_data)
    },
    loadRoomData({ commit, state }, rooms_data) {
      commit('mutateRoomsData', rooms_data)
    }
  },
  mutations: {
    mutateUser(state, user) {
      state.user = user
    },
    mutateAppName(state, app_name) {
      state.app_name = app_name
    },
    mutateRoomsData(state, rooms_data) {
      state.rooms_data = rooms_data
    }
  },
  getters: {
    user: state => state.user,
    appName: state => state.app_name,
    getRoomsData: state => {
      return state.rooms_data
    }
  }
})
