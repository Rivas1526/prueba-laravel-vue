<template>
    <div class="container container-task">
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center">Lista de tareas</h2>
                <!-- Tabla que muestra la lista de las tareas -->
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Contenido</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="task in arrayTasks" :key="task.id">
                            <td v-text="task.name"></td>
                            <td v-text="task.description"></td>
                            <td v-text="task.content"></td>
                            <td>
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-warning" @click="loadFieldsUpdate(task)">Edit</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-danger" @click="deleteTask(task)">Borrar</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <!-- campos para crear las tareas -->
                <div class="form-group">
                    <label class="text-dark">Nombre</label>
                    <input v-model="name" type="text" class="form-control">

                    <label class="text-dark">Descripción</label>
                    <input v-model="description" type="text" class="form-control">

                    <label class="text-dark">Contenido</label>
                    <input v-model="content" type="text" class="form-control">
                </div>
                <div class="container-buttons text-center">
                    <!-- botones que accionan las function -->
                    <button v-if="update == 0" @click="saveTasks()" class="btn btn-success">Añadir</button>
                    <button v-if="update != 0" @click="updateTasks()" class="btn btn-warning">Actualizar</button>
                    <button v-if="update != 0" @click="clearFields()" class="btn btn-primary">Atrás</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                name:"",
                description:"",
                content:"",
                update:0,
                arrayTasks:[],
            }
        },
        methods:{
            // Buscar tareas
            getTasks(){
                let me = this;
                let url = '/tareas'
                axios.get(url).then(function (response) {
                    me.arrayTasks = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            // Guardar tareas
            saveTasks(){
                let me =this;
                let url = '/tareas'
                axios.post(url,{
                    'name':this.name,
                    'description':this.description,
                    'content':this.content,
                }).then(function (response) {
                    me.getTasks(); 
                    me.clearFields();
                })
                .catch(function (error) {
                    console.log(error);
                });   
                
            },
            // Actualizar tarea
            updateTasks(){
                let me = this;
                axios.put('/tareas/'+this.update,{
                    'id':this.update,
                    'name':this.name,
                    'description':this.description,
                    'content':this.content,
                }).then(function (response) {
                   me.getTasks();
                   me.clearFields();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            // Cargar tarea que se va a actualizar en los campos
            loadFieldsUpdate(data){ 
                this.update = data.id
                let me =this;
                let url = '/tareas/'+this.update;
                axios.get(url).then(function (response) {
                    me.name= response.data.name;
                    me.description= response.data.description;
                    me.content= response.data.content;
                    
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            // Eliminar tarea
            deleteTask(data){
                let me =this;
                let task_id = data.id
                if (confirm('¿Seguro que deseas borrar esta tarea?')) {
                    axios.delete('/tareas/'+task_id
                    ).then(function (response) {
                        me.getTasks();
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            // Limpiar Campos
            clearFields(){
                this.name = "";
                this.description = "";
                this.content = "";
                this.update = 0;
            }
        },
        mounted() {
           this.getTasks();
        }
    }
</script>
