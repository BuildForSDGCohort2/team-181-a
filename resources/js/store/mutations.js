export default {
    page_loader(state, payload) {
        state.page_loader = payload
    },
    loading(state, payload) {
        state.loading = payload
    },
    errors(state, payload) {
        state.errors = payload
    },
    alertEvent(state, payload) {
        state.alertEvent = payload
    },
    updateUsersList(state, payload) {
        state.users = payload
    },
    updateRoleList(state, payload) {
        state.roles = payload
    },
    updateClientList(state, payload) {
        state.clients = payload
    },
    updateUserPermList(state, payload) {
        state.user_perm = payload
    },
    updatePermissionList(state, payload) {
        state.permissions = payload
    },
    updateRolePermissionList(state, payload) {
        state.role_perm = payload
    },
    updateSearchList(state, payload) {
        state.seachResults = payload
    },


    // Search
    updateClientSearchList(state, payload) {
        state.clientSearch = payload
    },
    updateUserSearchList(state, payload) {
        state.userSearch = payload
    },

    // Deleted
    updateDeletedClients(state, payload) {
        state.deleted_clients = payload
    },
    updateDeletedUsers(state, payload) {
        state.deleted_users = payload
    },



    updateAnimalsList(state, payload) {
        state.animals = payload
    },
    updateOrdersList(state, payload) {
        state.orders = payload
    },
    updateAnimal_facts(state, payload) {
        state.animal_facts = payload
    },
}
