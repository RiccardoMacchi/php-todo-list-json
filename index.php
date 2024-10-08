<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- AXIOS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.3/axios.min.js" integrity="sha512-zJXKBryKlsiDaWcWQ9fuvy50SG03/Qc5SqfLXxHmk9XiUUbcD9lXYjHDBxLFOuZSU6ULXaJ69bd7blSMEgxXNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- My style -->
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div id="app">
        <div class="container">
            <h1>TODO LIST</h1>
            <div v-if="toDoList.length === 0">
                <h3>Congraturazione hai completato tutte le task!! <i class="fa-solid fa-face-smile-wink"></i></h3>
            </div>
            <ul v-else>
                
                <li v-for="(task,i) in toDoList" :key="i" :class="{ pinned: task.pinned, done: task.done }" >
                    <div @click="doneTask(i)">
                        {{ task.task }}
                    </div>
                    
                    
                    <div class="icons_option">
                        <i class="fa-solid fa-trash" @click="deleteTask(i)"></i>
                        <i class="fa-solid fa-map-pin" @click="pinTask(i)"></i>
                    </div>
                </li>
                
            </ul>
            <div id="add_task">
                <h4 v-if="errorInputTask" id="error_task">La task deve avere una lungezza minima di 3 caratteri</h4>
                <h4 v-else-if="taskAdded" id="success_task">TASK AGGIUNTA CON SUCCESSO!</h4>
                <h4 v-else id="add_task_text">AGGIUNGI UNA TASK</h4>
                <input type="text" @keyup.enter="addTask" v-model="newTask" :placeholder="message">
                <button @click="addTask">Add Task</button>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="main.js"></script>
</body>
</html>