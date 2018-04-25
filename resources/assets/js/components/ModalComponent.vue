<template>
  <div>
    <b-modal id="clientModal" title="Cliente" ok-title="Aceptar" cancel-title="Cancelar" ok-variant="success" @ok="action === 'create' ? store(new_client) : update(client)">
      <b-list-group>
        <div v-if="action === 'show'">
          <b-list-group-item>Nombre: {{ client.name }}</b-list-group-item>
          <b-list-group-item>Apellido: {{ client.lastname }}</b-list-group-item>
          <b-list-group-item>Email: {{ client.email }}</b-list-group-item>
          <b-list-group-item>Estado: {{ client_state }}</b-list-group-item>
        </div>
        <div v-if="action === 'create' || action === 'edit'">
          <b-list-group-item>
            <b-form-group id="name"
                horizontal
                :label-cols="3"
                breakpoint="md"
                label="Nombre"
                label-for="inputHorizontal">
              <div v-if="action === 'edit'">
                <b-form-input type="text" id="name" v-model="client.name"></b-form-input>
              </div>
              <div v-else>
                <b-form-input type="text" id="name" v-model="new_client.name"></b-form-input>
              </div>
            </b-form-group>
          </b-list-group-item>
          <b-list-group-item>
            <b-form-group id="lastname"
                horizontal
                :label-cols="3"
                breakpoint="md"
                label="Apellido"
                label-for="inputHorizontal">
              <div v-if="action === 'edit'">
                <b-form-input type="text" id="lastname" v-model="client.lastname"></b-form-input>
              </div>
              <div v-else>
                <b-form-input type="text" id="lastname" v-model="new_client.lastname"></b-form-input>
              </div>  
            </b-form-group>
          </b-list-group-item>
          <b-list-group-item>
            <b-form-group id="email"
                horizontal
                :label-cols="3"
                breakpoint="md"
                label="Email"
                label-for="inputHorizontal">
              <div v-if="action === 'edit'">
                <b-form-input type="text" id="email" v-model="client.email"></b-form-input>
              </div>
              <div v-else>
                <b-form-input type="text" id="email" v-model="new_client.email"></b-form-input>
              </div>
            </b-form-group>
          </b-list-group-item>
          <b-list-group-item>
            <b-form-group id="active"
                horizontal
                :label-cols="3"
                breakpoint="md"
                label="Estado"
                label-for="inputHorizontal">
              <div v-if="action === 'edit'">
                  <b-form-checkbox id="active_check"
                    plain
                    v-model="client.active"
                    value="1">
                    {{ client.active == "1" ? 'Activo' : 'Inactivo' }}
                  </b-form-checkbox>
              </div>
              <div v-else>
                <b-form-checkbox id="active_check"
                  plain
                  v-model="new_client.active"
                  value="1">
                  {{ new_client.active == "1" ? 'Activo' : 'Inactivo' }}
                </b-form-checkbox>
              </div>
            </b-form-group>
          </b-list-group-item>          
        </div>        
      </b-list-group>
    </b-modal>
  </div>
</template>
<script>
  export default {
    computed: {
      client_state: function(){
        return this.client.active === 1 ? 'Activo' : 'Inactivo';
      }
    },
    props: ['client','action','store','update','delete'],
    data (){
      return {
        new_client: {
          name: '',
          lastname: '',
          email: '',
          active: '0'
        }
      }
    }
  }
</script>