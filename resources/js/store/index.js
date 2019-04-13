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
    },
    postASale({ commit }) {
      axios.post('/api/v1/post-a-sale')
      .then(res => {
        console.log('post-a-sale', res)
        // update item availability
        // add to replishments
      }).catch(err => {
        console.log(err)
      })
    },
    postNoSale({ commit }) {
      axios.post('/api/v1/post-no-sale')
      .then(res => {
        console.log('post-no-sale', res)
      }).catch(err => {
        console.log(err)
      })
    },
    postDNDDueOut({ commit }) {
      axios.post('/api/v1/post-dnd-due-out')
      .then(res => {
        console.log('post-dnd-due-out', res)
      }).catch(err => {
        console.log(err)
      })
    },
    postDNDStayover({ commit }) {
      axios.post('/api/v1/post-dnd-stayover')
      .then(res => {
        console.log('post-dnd-stayover', res)
      }).catch(err => {
        console.log(err)
      })
    },
    postExtraSale({ commit }) {
      axios.post('/api/v1/post-extra-sale')
      .then(res => {
        console.log('post-extra-sale', res)
        // post a re stock first then an extra sale

      }).catch(err => {
        console.log(err)
      })
    },
    postExtraSale({ commit }) {
      axios.post('/api/v1/post-restock')
      .then(res => {
        console.log('post-restock', res)
        // update replenishments
      }).catch(err => {
        console.log(err)
      })
    },
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
