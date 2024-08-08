const { createApp } = Vue

createApp({
    data() {
        return {
            apiUrl: 'server.php',
            toDoList: [],
            newTask: '',
        }
    },
    methods: {
        requestList() {
            axios.get(this.apiUrl)
                .then((response) => {
                    this.toDoList = response.data;
                    console.log(this.toDoList)
                })
                .catch(err => {
                    console.log(err)
                })
        },
        addTask() {
            // Creazione oggetto da inviare al server
            const data = {
                newTask: this.newTask
            }
            axios.post(this.apiUrl, data, {
                // Aggiunta dell'header per dichiarare che è un form
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((response) => {
                    this.toDoList = response.data;
                    console.log(this.toDoList)
                })
            // Puliza v-model
            this.newTask = '';
        }
    },
    mounted() {
        this.requestList()
    }
}).mount('#app')