<template>
    <div class="container">
        <h1 class="text-4xl mb-10">Datos personales</h1>
        <table>
            <tr>
                <td>Nombre</td>
                <td>
                    <input v-model="name" type="text" :readonly="readonly" />
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input v-model="email" type="email" :readonly="readonly" />
                </td>
            </tr>
            <tr>
                <td>Contraseña</td>
                <td>
                    <input
                        v-model="password"
                        type="password"
                        :readonly="readonly"
                    />
                </td>
            </tr>
            <tr>
                <td>Repetir contraseña</td>
                <td>
                    <input
                        v-model="repeatedPassword"
                        type="password"
                        :readonly="readonly"
                    />
                </td>
            </tr>
        </table>

        <button
            class="px-4 py-2 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded  hover:bg-blue-500 hover:text-white hover:border-transparent"
            @click="readonly = !readonly"
        >
            {{ readonly ? "Modificar" : "Cancelar" }}
        </button>
        <button
            class="px-4 py-2 font-semibold text-blue-700 bg-transparent border border-blue-500 rounded  hover:bg-blue-500 hover:text-white hover:border-transparent"
            @click="update"
        >
            Aceptar
        </button>
        <p>{{ errorsComputed }}</p>
        <vue-modal-2
            name="modal-1"
            :headerOptions="{
                title: 'Modificar usuario'
            }"
            :footerOptions="{
                btn1: 'Aceptar',
                btn2: '',
                disableBtn2: true,
                btn1Style: {

                },
                btn2Style: {
                    visibility: 'hidden'
                },
                btn1OnClick: () => {
                    $vm2.close('modal-1');
                }
            }"
        >
            <div class="px-7">
                Usuario modificado
            </div>
        </vue-modal-2>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            oldUser: {
                name: "",
                email: "",
                password: ""
            },
            updatedParam: {
                name: null,
                email: null,
                password: null
            },
            name: "",
            email: "",
            password: "",
            repeatedPassword: "",
            errors: "",
            readonly: true,
            changeButtonText: true
        };
    },
    methods: {
        getDataUser() {
            axios.get("/user/data").then(response => {
                this.name = response.data.name;
                this.email = response.data.email;
                this.password = response.data.password;
                this.oldUser = {
                    name: response.data.name,
                    email: response.data.email,
                    password: response.data.password
                };
            });
        },
        update() {
            this.errors = "";
            if (this.readonly) {
                // this.errors = "Pulse el botón de modificar si desea modificar algo.";
                return;
            }
            this.updatedParam.name = null;
            this.updatedParam.email = null;
            this.updatedParam.password = null;
            if (this.name != this.oldUser.name) {
                this.updatedParam.name = this.name;
            }
            if (this.email != this.oldUser.email) {
                if (this.validateEmail(this.email)) {
                    this.updatedParam.email = this.email;
                } else {
                    this.errors = "El email introducido es incorrecto.";
                    this.email = this.oldUser.email;
                }
            }
            this.validatePassword();
            if (this.errors != "") {
                return;
            }
            axios
                .post("/user/update", this.updatedParam)
                .then(() => this.$vm2.open("modal-1"));
            this.readonly = true;
        },
        validatePassword() {
            if (this.password == this.oldUser.password) {
                return;
            }
            if (this.password.length < 8) {
                this.errors =
                    "La contraseña ha de tener como mínimo 8 caracteres.";
                return;
            }
            if (this.repeatedPassword != this.password) {
                this.errors =
                    "La contraseña debe ser validada escribiéndola dos veces.";
                return;
            }
            this.updatedParam.password = this.password;
        },
        validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
    },
    computed: {
        errorsComputed() {
            return this.errors;
        }
    },
    mounted() {
        this.getDataUser();
    }
};
</script>
