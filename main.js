const { createApp } = Vue

createApp({
    data() {
        return {
            apiUrl: 'server.php',
            toDoList: [],
            newTask: '',
            message: 'inserisci una nuova Task',
            errorInputTask: false,
            taskAdded: false,
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
            if (this.newTask.trim() === '' || this.newTask.length < 3) {

                this.message = 'Il campo non può essere vuoto!';
                this.errorInputTask = true;
                this.newTask = '';
                return;
            }
            // Creazione oggetto da inviare al server
            console.log(this.newTask.length)
            const data = {
                newTask: {
                    "task": this.newTask,
                    "pinned": false
                }
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
            // Aggiunta task toggles
            this.taskAdded = true
            this.errorInputTask = false
            // Ripristino toggle taskAdded
            setTimeout(() => { this.taskAdded = false }, 5000)
            // Puliza v-model
            this.newTask = '';

        },
        deleteTask(i) {
            const data = {
                iToDelete: i
            }

            axios.post(this.apiUrl, data, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((response) => {
                    this.toDoList = response.data;
                })
        },
        pinTask(i) {

            const data = {
                taskToPin: i
            }

            axios.post(this.apiUrl, data, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((response) => {
                    this.toDoList = response.data;
                })
        },
        doneTask(i) {
            const data = {
                taskDone: i
            }
            axios.post(this.apiUrl, data, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((response) => {
                    this.toDoList = response.data;
                })
        }
    },
    mounted() {
        this.requestList()
    }
}).mount('#app')