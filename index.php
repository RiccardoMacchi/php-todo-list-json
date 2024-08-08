<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- AXIOS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.3/axios.min.js" integrity="sha512-zJXKBryKlsiDaWcWQ9fuvy50SG03/Qc5SqfLXxHmk9XiUUbcD9lXYjHDBxLFOuZSU6ULXaJ69bd7blSMEgxXNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
</head>
<body>
    <div id="app">
        <div class="container">
            <h1>TODO LIST</h1>
            <ul>
                <li v-for="task in toDoList">
                    {{ task }}
                </li>
            </ul>
            <div>
                <input type="text" @keyup.enter="addTask" v-model="newTask">
                <button @click="addTask">Add Task</button>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="main.js"></script>
</body>
</html>