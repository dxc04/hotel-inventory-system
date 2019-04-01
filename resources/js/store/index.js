import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(Vuex)
Vue.use(VueAxios, axios)

export default new Vuex.Store({
  state: {
     room_statuses: {}
  },
  actions: {
    loadRoomStatuses({ commit, state }, room_statuses) {
        commit('mutateRoomStatuses', room_statuses)
    }
  },
  mutations: {
    mutateRoomStatuses(state, room_statuses) {
        state.room_statuses = room_statuses
    }
  },
  getters: {
      getRoomStatuses: state => {
        return state.room_statuses
    }
  }
})
