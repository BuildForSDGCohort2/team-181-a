import actions from './actions';
import getters from './getters';
import mutations from './mutations';

export default {
    state: {
        loading: false,
        errors: null,
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
    },
    getters,
    mutations,
    actions
}
