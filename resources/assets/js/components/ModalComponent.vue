<template>
  <div>
    <b-modal id="clientModal" 
    title="Cliente" 
    ok-title="Aceptar" 
    cancel-title="Cancelar" 
    ok-variant="success" 
    @ok="createOrEdit"
    @hidden="clean">
      <b-list-group>
        <div v-if="action === 'show'">
          <b-list-group-item><b>Nombre:</b> {{ client.name }}</b-list-group-item>
          <b-list-group-item><b>Apellido:</b> {{ client.lastname }}</b-list-group-item>
          <b-list-group-item><b>Email:</b> {{ client.email }}</b-list-group-item>
          <b-list-group-item><b>Estado:</b> {{ clientState }}</b-list-group-item>
          <b-list-group-item>
            <b-row align-v="center">
              <b-col>
                <b>Imagen:</b>
              </b-col>
              <b-col v-if="client.image">
                <b-img thumbnail fluid :src="clientImage" title="client.image" alt="client.image" />
              </b-col>
            </b-row>
          </b-list-group-item>
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
                <b-form-input type="text" id="name" v-model="client.name" :state="inputState('name')"></b-form-input>
                <b-form-invalid-feedback id="invalid_name">{{ errors.name }}</b-form-invalid-feedback>
              </div>
              <div v-else>
                <b-form-input type="text" id="name" ref="name" v-model="new_client.name" :state="inputState('name')"></b-form-input>
                <b-form-invalid-feedback id="invalid_name">{{ errors.name }}</b-form-invalid-feedback>
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
                <b-form-input type="text" id="lastname" v-model="client.lastname" :state="inputState('lastname')"></b-form-input>
                <b-form-invalid-feedback id="invalid_lastname">{{ errors.lastname }}</b-form-invalid-feedback>                
              </div>
              <div v-else>
                <b-form-input type="text" id="lastname" ref="lastname" v-model="new_client.lastname" :state="inputState('lastname')"></b-form-input>
                <b-form-invalid-feedback id="invalid_lastname">{{ errors.lastname }}</b-form-invalid-feedback>              
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
                <b-form-input type="text" id="email" v-model="client.email" :state="inputState('email')"></b-form-input>
                <b-form-invalid-feedback id="invalid_email">{{ errors.email }}</b-form-invalid-feedback>                
              </div>
              <div v-else>
                <b-form-input type="text" id="email" ref="email" v-model="new_client.email" :state="inputState('email')"></b-form-input>
                <b-form-invalid-feedback id="invalid_email">{{ errors.email }}</b-form-invalid-feedback>                
              </div>
            </b-form-group>
          </b-list-group-item>
          <b-list-group-item>
            <b-form-group id="image"
                horizontal
                :label-cols="3"
                breakpoint="md"
                label="Imagen"
                label-for="inputHorizontal">          
              <b-form-file v-model="new_client.image" :state="Boolean(new_client.image)" id="image_file" accept=".jpg, .png, .gif" placeholder="Buscar imagen..."></b-form-file>
              <div class="mt-3">Archivo seleccionado: {{ new_client.image && new_client.image.name}}</div>   
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
      clientState: function(){
        return this.client.active === 1 ? 'Activo' : 'Inactivo';
      },
      clientImage: function(){
        return 'storage/images/' + this.client.image;
      }
    },
    props: ['client','action','store','update','delete','errors'],
    data (){
      return {
        new_client: {
          name: '',
          lastname: '',
          email: '',
          active: '0',
          image: null
        }
      }
    },
    methods: {
      // Limpia el objeto new_client para que el modal quede con los campos vacios nuevamente
      clean() {
        this.new_client.name = '';
        this.new_client.lastname = '';
        this.new_client.email = '';
        this.new_client.active = '0';
      },
      // Guarda un registro nuevo o actualiza uno existente dependiendo del action
      createOrEdit(e) {
        if(this.action === 'create'){
          e.preventDefault();
          this.store(this.new_client);
        }
        if(this.action === 'edit'){
          e.preventDefault();
          this.update(this.client);
        }
      },
      inputState(input_name) {
          if(this.errors[input_name]){
            return false;
          }
          else{
            return null;
          }
      }
    }
  }
</script>