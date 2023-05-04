import {createStore} from 'vuex'


const store = createStore({
    state: {
        user: {},
        token: sessionStorage.getItem('TOKEN')
    }
})

export default store;