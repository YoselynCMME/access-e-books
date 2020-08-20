<template>
    <div>
        <!-- LISTA DE USUARIOS -->
        <b-table striped hover responsive :items="users" :fields="fields">
            <template v-slot:cell(actions)="data">
                <b-button variant="warning" @click="editUser(data.item, data.index)">
                    <i class="fa fa-edit text-white"></i>
                </b-button>
                <b-button variant="danger" @click="deleteUser(data.item, data.index)">
                    <i class="fa fa-trash"></i>
                </b-button>
            </template>
            <template v-slot:cell(books)="data">
                <b-button variant="dark" @click="showBooks(data.item)">
                    <i class="fa fa-book"></i>
                </b-button>
                <b-button variant="info" @click="addBook(data.item)">
                    <i class="fa fa-plus-circle"></i>
                </b-button>
            </template>
        </b-table>

        <!-- MODAL PARA EDITAR / AGREGAR USUARIO -->
        <b-modal ref="modal-edit-user" 
                hide-backdrop hide-footer 
                title="Editar usuario">
            <b-form @submit.prevent="onUpdate">
                <b-form-group label="Rol:">
                    <b-form-select
                        v-model="user.role_id" :options="roles" required>
                    </b-form-select>
                </b-form-group>
                <b-form-group label="user_name:">
                    <b-form-input v-model="user.user_name" required></b-form-input>
                    <label v-if="errors && errors.user_name" class="text-danger">{{ errors.user_name[0] }}</label>
                </b-form-group>
                <b-form-group label="Nombre:">
                    <b-form-input v-model="user.name" required></b-form-input>
                    <label v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</label>
                </b-form-group>
                <b-form-group label="Correo:">
                    <b-form-input v-model="user.email" type="email" required></b-form-input>
                    <label v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</label>
                </b-form-group>
                <b-form-group label="Escuela:">
                    <b-form-input v-model="user.school" required></b-form-input>
                    <label v-if="errors && errors.school" class="text-danger">{{ errors.school[0] }}</label>
                </b-form-group>
                <!-- <b-form-group label="Contraseña:">
                    <b-form-input v-model="user.password" type="password"></b-form-input>
                    <label v-if="errors && errors.password" class="text-danger">{{ errors.password[0] }}</label>
                </b-form-group>
                <b-form-group label="Confirmar contraseña:">
                    <b-form-input v-model="user.password_confirmation" type="password"></b-form-input>
                </b-form-group> -->
                <div class="text-right">
                    <b-button type="submit" variant="success">
                        <i class="fa fa-check"></i> Actualizar
                    </b-button>
                </div>
            </b-form>
        </b-modal>

        <!-- MODAL PARA BORRAR USUARIO -->
        <b-modal ref="modal-delete-user" hide-backdrop hide-footer title="Eliminar usuario">
            <p><b>¿Estas segura de eliminar a {{user.name}}?</b></p>
            <b-button variant="secondary" @click="confirmDelete()">Confirmar</b-button>
        </b-modal>

        <!-- MODAL PARA MOSTRAR LIBROS -->
        <b-modal ref="modal-books-user" hide-backdrop hide-footer :title="user.name">
            <books-user-component :user="user"></books-user-component>
        </b-modal>

        <!-- MODAL PARA AGREGAR LIBRO -->
        <b-modal ref="modal-add-book" hide-backdrop hide-footer title="Agregar libro">
            <b-form @submit.prevent="newBook">
                <b-form-group label="Codigo:">
                    <b-form-input v-model="user.code" required></b-form-input>
                </b-form-group>

                <div class="text-right">
                    <b-button type="submit" variant="success">
                        <i class="fa fa-check"></i> Guardar
                    </b-button>
                </div>
            </b-form>
        </b-modal>
    </div>
</template>

<script>
export default {
    props: ['registers'],
    data(){
        return {
            users: this.registers,
            fields: [
                { key: 'books', label: 'Libros' },
                { key: 'id', label: 'id' },
                { key: 'role_id', label: 'rol' },
                { key: 'user_name', label: 'user_name' },
                { key: 'name', label: 'Nombre' },
                { key: 'email', label: 'Correo' },
                { key: 'school', label: 'Escuela' },
                { key: 'actions', label: '' }
            ],
            roles: [
                { text: 'Administrador', value: 1 }, 
                { text: 'Alumno', value: 2 },
                { text: 'Profesor', value: 3 }
            ],
            user: {},
            errors: {},
            position: null,
            load: null
        }
    },
    methods: {
        editUser(user, position){
            this.user = user;
            this.errors = {};
            this.position = position;
            this.$refs['modal-edit-user'].show()
        },
        onUpdate(){
            this.load = true;
            axios.put('/users/update_user', this.user).then(response => {
                this.users[this.position] = response.data;
                this.load = false;
                this.$refs['modal-edit-user'].hide();
                this.makeToast('Usuario actualizado');
            }).catch(error => {
                this.load = false;
                if (error.response.status === 422)
                    this.errors = error.response.data.errors || {};
            });
        },
        deleteUser(user, position){
            this.user = user;
            this.position = position;
            this.$refs['modal-delete-user'].show()
        },
        confirmDelete(){
            axios.get('/users/delete_user', {params: {user_id: this.user.id}}).then(response => {
                this.users.splice(this.position, 1);
                this.load = false;
                this.$refs['modal-delete-user'].hide();
                this.makeToast('Usuario eliminado');
            }).catch(error => {
                this.load = false;
            });
        },
        showBooks(user){
            axios.get('/users/show_books', {params: {user_id: user.id}}).then(response => {
                this.user = response.data;
                this.$refs['modal-books-user'].show();
            }).catch(error => {
                this.load = false;
            });
        },
        addBook(user){
            this.user.user_id = user.id;
            this.user.code = null;
            this.$refs['modal-add-book'].show();
        },
        newBook(){
            this.load = true;
            axios.post('/users/save_book', this.user).then(response => {
                this.makeToast(response.data);
                this.load = false;
            }).catch(error => {
                this.load = false;
            });
        },
        makeToast(message){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 2000
            })
        }
    }
}
</script>