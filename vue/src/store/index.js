import { createStore } from "vuex";
import axiosClient from "../axios";



const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem("TOKEN")
        },
        tasks: {
            loading: false,
            data: []
        },
        currentTask: {
            data: {},
            loading: false,
        },
        
    },
    getters: {},
    actions: {
        register({ commit }, user) {
            return axiosClient.post('/register', user)
                .then(({ data }) => {
                    commit('setUser', data);
                    return data
                })
        },
        login({ commit }, user) {
            return axiosClient.post('/login', user)
                .then(({ data }) => {
                    commit('setUser', data);
                    return data;
                })
        },
        logout({ commit }) {
            return axiosClient.post('/logout')
                .then(response => {
                    commit('logout')
                    return response;
                })
        },
        saveTask({ commit }, task) {
            // console.log(task);
            let response;
            if (task.id) {
                response = axiosClient
                    .put(`/task/${task.id}`, task)
                    .then((res) => {
                        // console.log(res)
                        commit('updateTask', res.data)
                        return res;
                    });
            } else {
                response = axiosClient.post("/task", task).then((res) => {
                    commit('saveTask', res.data)
                    return res;
                })
            }
        },
        getTask({ commit }, id) {
            commit("setCurrentTaskLoading", true);
            return axiosClient
              .get(`/task/${id}`)
              .then((res) => {
                commit("setCurrentTask", res.data);
                commit("setCurrentTaskLoading", false);
                return res;
              })
              .catch((err) => {
                commit("setCurrentTaskLoading", false);
                throw err;
              });
        },
        deleteTask({ dispatch }, id) {
            return axiosClient.delete(`/task/${id}`).then((res) => {
              dispatch('getTasks')
              return res;
            });
        },
        getTasks({ commit }) {
            commit("setTasksLoading", true)
            return axiosClient.get("/task")
                .then((res) => {
                    commit("setTasksLoading", false)
                    commit("setTasks", res.data);
                    return res;
                })
        },
    },
        mutations: {
            logout: (state) => {
                state.user.data = {};
                state.user.token = null
            },
            setUser: (state, userData) => {
                state.user.token = userData.token;
                state.user.data = userData.user;
                sessionStorage.setItem('TOKEN', userData.token);
            },
            saveTask: (state, task) => {
                state.tasks = [...state.tasks, task.data];
            },
            updateTask: (state, task) => {
                state.tasks = state.tasks.map((t) => {
                    if (t.id == task.data.id) {
                        return task.data; 
                    }
                    return t;
                })
            },
            setCurrentTaskLoading: (state, loading) => {
                state.currentTask.loading = loading;
            },
            setTasksLoading: (state, loading) => {
                state.tasks.loading = loading;
            },
            setCurrentTask: (state, task) => {
                state.currentTask.data = task.data;
            },
            setTasks: (state, tasks) => {
                state.tasks.data = tasks.data;
            },
            
        },
        modules: {}
    })

export default store;