export default {
    state: {
        items: []
    },


    mutations: {
        LOAD_NOTIFICATONS(state, notifications) {
            state.items = notifications
        },

        MARK_AS_READ(state, id){
            let index = state.items.filter(notification => notification.id == id)
            state.items.splice(index, 1)
        },

        MARK_ALL_AS_READ(state){
            state.items = []
        },

        ADD_NOTIFICATION(state, notification){
            state.items.unshift(notification) 
        }
    },

    actions: {
        loadNotifications(context) {
            axios
                .get("/notifications")
                .then(
                    response => context.commit('LOAD_NOTIFICATONS', response.data.notifications)
                )
        },

        maskAsRead(context, params){
            axios.put('notifications-read', params)
            .then(
                () => context.commit('MARK_AS_READ', params.id)
            )
        },

        markAllAsRead(context){
            axios.put('notifications-all-read').then(
                () => context.commit('MARK_ALL_AS_READ')
            )
        }
    }

}
