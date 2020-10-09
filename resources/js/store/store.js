import actions from './actions';
import getters from './getters';
import mutations from './mutations';

export default {
    state: {
        loading: false,
        errors: [],
        alertEvent: [],
        users: [],
        roles: [],
        user_perm: [],
        role_perm: [],
        permissions: [],
        clients: [],
        clientSearch: [],
        deleted_clients: [],
        deleted_users: [],

        animals: [],
        orders: [],
        animal_facts: [],
        broods: [],
        plantations: [],
        page_loader: false,
        issues_show: [],
        notifications: [],
    },
    getters,
    mutations,
    actions
}
