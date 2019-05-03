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
    loadRoomData({ commit, state }) {
      return axios.post('/api/v1/get-allthedata')
      .then(res => {
        commit('mutateRoomsData', res.data.rooms_data)
      }).catch(err => {
        console.log(err)
      })
    },
    postASale({ commit }, data) {
      return axios.post('/api/v1/post-a-sale', data)
      .then(res => {
        //commit('mutateRoomsData', res.data.rooms_data)
      }).catch(err => {
        console.log(err)
      })
    },
    postNoSale({ commit }, selected_room) {
      return axios.post('/api/v1/post-no-sale', {'selected_room': selected_room.id})
      .then(res => {
        //commit('mutateRoomsData', res.data.rooms_data)
      }).catch(err => {
        console.log(err)
      })
    },
    postDNDDueOut({ commit }, selected_room) {
      return axios.post('/api/v1/post-dnd-due-out', {'selected_room': selected_room.id})
      .then(res => {
        //commit('mutateRoomsData', res.data.rooms_data)
      }).catch(err => {
        console.log(err)
      })
    },
    postDNDStayover({ commit }, selected_room) {
      return axios.post('/api/v1/post-dnd-stayover', {'selected_room': selected_room.id})
      .then(res => {
        //commit('mutateRoomsData', res.data.rooms_data)
      }).catch(err => {
        console.log(err)
      })
    },
    postAnItemReject({ commit }, data) {
      return axios.post('/api/v1/post-an-item-reject', data)
      .then(res => {
        //commit('mutateRoomsData', res.data.rooms_data)
      }).catch(err => {
        console.log(err)
      })
    },
    postAnExtraSale({ commit }, data) {
      return axios.post('/api/v1/post-an-extra-sale', data)
      .then(res => {
        //commit('mutateRoomsData', res.data.rooms_data)
      }).catch(err => {
        console.log(err)
      })
    },
    postARestock({ commit }, data) {
      return axios.post('/api/v1/post-a-restock', data)
      .then(res => {
        //commit('mutateRoomsData', res.data.rooms_data)
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
