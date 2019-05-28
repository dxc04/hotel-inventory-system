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
    rooms_data: {},
    action_posted: false
  },
  actions: {
    loadAllTheData({ commit }, atd) {
      commit('mutateUser', atd.user)
      commit('mutateAppName', atd.app_name) 
      commit('mutateRoomsData', atd.rooms_data),
      commit('mutateActionPosted', false)
    },
    loadRoomData({ commit, state }) {
      return axios.get('/api/v1/get-allthedata')
        .then(res => {
          commit('mutateRoomsData', res.data.rooms_data)
        }).catch(err => {
          console.log(err)
        })
    },
    loadRoomStocks({ commit, state }) {
      return axios.post('/api/v1/get-room-stocks')
        .then(res => {
          commit('mutateRoomStocks', res.data)
        }).catch(err => {
          console.log(err)
        })      
    },
    loadItemtocks({ commit, state }) {
      return axios.post('/api/v1/get-item-stocks')
        .then(res => {
          commit('mutateItemStocks', res.data)
        }).catch(err => {
          console.log(err)
        })      
    },    
    loadRoomStatus({ commit, state }) {
      return axios.get('/api/v1/get-room-status')
        .then(res => {
          commit('mutateRoomStatus', res.data)
        }).catch(err => {
          console.log(err)
        })      
    },  
    postActionPosted({ commit }, action_status) {
      commit('mutateActionPosted', action_status)
    },
    postASale({ commit }, data) {
      return axios.post('/api/v1/post-a-sale', data)
      .then(res => {
        console.log('rest', res)
        commit('mutateRoomStocks', res.data.room_stocks)
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
        commit('mutateRoomStocks', res.data.room_stocks)
      }).catch(err => {
        console.log(err)
      })
    },
    postAnExtraSale({ commit }, data) {
      return axios.post('/api/v1/post-an-extra-sale', data)
      .then(res => {
        commit('mutateRoomStocks', res.data.room_stocks)
      }).catch(err => {
        console.log(err)
      })
    },
    postARestock({ commit }, data) {
      return axios.post('/api/v1/post-a-restock', data)
      .then(res => {
        commit('mutateRoomStocks', res.data.room_stocks)
        commit('mutateItemStocks', res.data.item_stocks)
      }).catch(err => {
        console.log(err)
      })
    },
    addItemStock({ commit }, data) {
      console.log('dada', data)
      return axios.post('/api/v1/add-item-stock', data)
      .then(res => {
        commit('mutateRoomStocks', res.data.room_stocks)
        commit('mutateItemStocks', res.data.item_stocks)
        commit('mutatePurchases', res.data.purchases)
      }).catch(err => {
        console.log(err)
      })
    },
    generateRestockReport({ commit }, data) {
      return axios('/api/v1/download-restock-report', {
          method: 'post',
          responseType: 'blob',
          data
        })
        .then(response => {
          const url = window.URL.createObjectURL(new Blob([response.data]))
          const link = document.createElement('a')
          link.href = url
          let date = new Date()
          let cdate = date.toISOString()
          link.setAttribute('download', 'For-Restock-' + cdate + '.pdf')
          document.body.appendChild(link)
          link.click()
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
    },
    mutateActionPosted(state, action_posted) {
        state.action_posted = action_posted
    },
    mutateItemStocks(state, item_stocks) {
      state.rooms_data.item_stocks = item_stocks
    },    
    mutateRoomStocks(state, room_stocks) {
      state.rooms_data.room_stocks = room_stocks
    },
    mutateRoomStatus(state, room_status) {
      for (let index in room_status) {
        state.rooms_data[index] = room_status[index]
      }
    },
    mutatePurchases(state, purchases) {
      state.rooms_data.purchases = purchases
    },
  },
  getters: {
    user: state => state.user,
    appName: state => state.app_name,
    getRoomsData: state => {
      return state.rooms_data
    },
    getActionPosted: state => state.action_posted,
  }
})
