import axios from "axios";
export default {
    page_loader(context, payload) {
        context.commit('page_loader', payload)
    },
    alertEvent(context, payload) {
        eventBus.$emit('alertRequest', payload)
        // context.commit('alertEvent', payload)
    },

    errorEvent(context, payload) {
        eventBus.$emit('errorEvent', payload)
        // context.commit('alertEvent', payload)
    },

    // Get items
    getItems(context, payload) {
        // console.log(payload);

        var model = payload.model
        var update = payload.update
        context.commit('page_loader', true)
        context.commit('loading', true)
        return new Promise((resolve, reject) => {
            axios.get(model).then((response) => {
                context.commit('loading', false)
                context.commit('page_loader', false)
                context.commit(update, response.data)
                resolve(response)
            }).catch((error) => {
                reject(error);
                context.commit('page_loader', false)
                context.commit('loading', false)
                context.commit('error', error.response)
                if (error.response.status === 500) {

                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    context.commit('errors', error.response.data.errors)
                    return
                }
                context.commit('errors', error.response.data.errors)
            })
        })
    },


    // Get Single items
    showItem(context, payload) {
        console.log(payload);

        var model = payload.model
        var update = payload.update
        var id = payload.id
        context.commit('page_loader', true)
        context.commit('loading', true)
        return new Promise((resolve, reject) => {
            axios.get(model + '/' + id).then((response) => {
                context.commit(update, response.data)
                context.commit('page_loader', false)
                context.commit('loading', false)
                resolve(response)
            }).catch((error) => {
                reject(error);
                context.commit('page_loader', false)
                context.commit('loading', false)
                if (error.response.status === 500 || error.response.status === 405) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    context.commit('errors', error.response.data.errors)
                    return
                }
                context.commit('errors', error.response.data.errors)
            })
        })
    },


    nextPage(context, payload) {

        var path = payload.path
        var page = payload.page
        var update = payload.update
        console.log(update);
        context.commit('page_loader', true)
        context.commit('loading', true)
        return new Promise((resolve, reject) => {
            axios.get(path + `?page=` + page)
                .then((response) => {
                    console.log(response.data);
                    context.commit('loading', false)
                    context.commit(update, response.data)
                    context.commit('page_loader', false)
                    resolve(response)
                }).catch((error) => {
                    console.log(error);
                    reject(error);

                    context.commit('page_loader', false)
                    context.commit('loading', false)
                    if (error.response.status === 500) {
                        eventBus.$emit('errorEvent', error.response.statusText)
                        return
                    } else if (error.response.status === 401 || error.response.status === 409) {
                        eventBus.$emit('reloadRequest', error.response.statusText)
                    } else if (error.response.status === 422) {
                        eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                        context.commit('errors', error.response.data.errors)

                    } else {
                        context.commit('errors', error.response.data.errors)
                    }
                })
        });
    },




    // Delete
    deleteItem(context, payload) {
        context.commit('loading', true)
        context.commit('page_loader', true)
        return new Promise((resolve, reject) => {
            axios.delete(payload).then((response) => {
                context.commit('loading', false)
                context.commit('page_loader', false)
                resolve(response)
            }).catch((error) => {
                reject(error);
                context.commit('page_loader', false)
                context.commit('loading', false)
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    context.commit('errors', error.response.data.errors)
                    return
                }
                context.commit('errors', error.response.data.errors)
            })
        });
    },


    // Post Items
    postItems(context, payload) {
        // console.log(payload);
        context.commit('errors', [])
        context.commit('page_loader', true)

        var model = payload.model
        var data = payload.data

        console.log(data);

        // var data = payload['data']
        // console.log(data);
        // var update = payload['update']
        context.commit('loading', true)
        return new Promise((resolve, reject) => {
            axios.post(model, data).then((response) => {
                context.commit('page_loader', false)
                context.commit('loading', false)
                eventBus.$emit('alertRequest', 'Created')
                // console.log(response.data);
                // context.commit(update, response.data)
                resolve(response)
            }).catch((error) => {
                // console.log(error.response.data.errors);
                reject(error);

                context.commit('page_loader', false)
                context.commit('loading', false)
                if (error.response.status === 500 || error.response.status === 405) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    var errors_ = error.response.data.errors
                    context.commit('errors', errors_)
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    context.commit('errors', error.response.data.errors)
                    return
                }
                context.commit('errors', error.response.data.errors)
            })
        });
    },


    // Patch Items
    patchItems(context, payload) {
        // console.log(payload);
        context.commit('page_loader', true)

        var model = payload.model
        var data = payload.data
        var id = payload.id
        context.commit('loading', true)
        return new Promise((resolve, reject) => {
            axios.patch(model + '/' + id, data).then((response) => {
                context.commit('page_loader', false)
                eventBus.$emit('alertRequest', 'Updated')
                context.commit('loading', false)
                resolve(response)
            }).catch((error) => {
                reject(error);
                context.commit('page_loader', false)
                context.commit('loading', false)
                if (error.response.status === 500 || error.response.status === 405) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    context.commit('errors', error.response.data.errors)

                }
                context.commit('errors', error.response.data.errors)
            })
        });

    },


    searchItems(context, payload) {
        console.log(payload);
        // context.commit('page_loader', true)

        var model = payload.model
        var update = payload.update
        var search = payload.search
        context.commit('loading', true)
        return new Promise((resolve, reject) => {
            axios.get(model + '/' + search).then((response) => {
                context.commit('page_loader', false)
                context.commit('loading', false)

                context.commit(update, response.data)
                resolve(response)
            }).catch((error) => {
                console.log(error);
                reject(error);

                context.commit('page_loader', false)
                context.commit('loading', false)
                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    context.commit('errors', error.response.data.errors)
                    return
                }
                context.commit('errors', error.response.data.errors)
            })
        });
    },


    // Post Items
    filterItems(context, payload) {
        // console.log(payload);
        context.commit('page_loader', true)
        context.commit('errors', [])

        var model = payload.model
        var update = payload.update
        var data = payload.data

        context.commit('loading', true)
        return new Promise((resolve, reject) => {
            context.commit('page_loader', false)
            axios.post(model, data).then((response) => {
                context.commit('loading', false)
                context.commit(update, response.data)
                // eventBus.$emit('alertRequest', 'Created')
                // console.log(response.data);
                resolve(response)
            }).catch((error) => {
                // console.log(error.response.data.errors);
                context.commit('page_loader', false)
                reject(error);

                context.commit('loading', false)
                if (error.response.status === 500 || error.response.status === 405) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    var errors_ = error.response.data.errors
                    context.commit('errors', errors_)
                    eventBus.$emit('errorEvent', error.response.data.message + ': ' + error.response.statusText)
                    context.commit('errors', error.response.data.errors)
                    return
                }
                context.commit('errors', error.response.data.errors)
            })
        });
    },
}
