<style lang="scss">

</style>

<template>
	<div class="container">
		<div style="margin: 1cm;">
			<div class="row">
				<div class="col-md-6"><h1>Clientes</h1></div>
				<div class="col-md-6" style="text-align: right;"><b-button variant="success" @click="create" v-b-modal="'clientModal'">Crear</b-button></div>
			</div>
		    <b-table :sort-by.sync="sortBy"
		             :sort-desc.sync="sortDesc"
		             :items="items"
		             :fields="fields">
				<template slot="Acciones" slot-scope="row">
					<b-button size="sm" variant="primary" @click="show(row.item.id)" v-b-modal="'clientModal'"> Ver</b-button>
					<b-button size="sm" variant="warning" @click="edit(row.item.id)" v-b-modal="'clientModal'"> Editar</b-button>
					<b-button size="sm" variant="danger" @click="destroy(row.item.id)"> Eliminar</b-button>
				</template>		             
		    </b-table>
		    <v-modal :client="client" :action="action" :store="store" :update="update"></v-modal>		
		</div>
	</div>
</template>

<script>
export default {
	mounted(){
  		this._fetch();
	},
	data () {
		return {
			sortBy: 'nombre',
      		sortDesc: false,
			fields: [
				{ key: 'Nombre', sortable: true },
				{ key: 'Apellido', sortable: true },
				{ key: 'Email', sortable: true },
				{ key: 'Estado', sortable: true },
				{ key: 'Acciones', sortable: false }
			],
			items: [],
			client: '',
			action: ''
		}
	},
	methods: {
		_fetch: function(){
            axios.get('./api/clients')
                .then(response => {
                	var items = [];
                    $.each(response.data, function(index, value) {
						var active = value.active === 1 ? 'Activo' : 'Inactivo';
						items.push({id: value.id, Nombre: value.name, Apellido: value.lastname, Email: value.email, Estado: active});
                    });  
                    this.items = items;                  
                })
                .catch(response => {
                    console.log(response);
                });
		},
		create: function(){
			this.action = 'create';
			this.client = '';
		},
		store: function(new_client){
            axios.post('./api/clients',new_client)
                .then(response => {
                	var active = response.data.active === 1 ? 'Activo' : 'Inactivo';
					this.items.push({id: response.data.id, Nombre: response.data.name, Apellido: response.data.lastname, Email: response.data.email, Estado: active});
                })
                .catch(response => {
                    console.log(response);
                });  			
		},
		show: function(id){
            axios.get('./api/clients/'+id)
                .then(response => {
					this.client = response.data;
					this.action = 'show';
                })
                .catch(response => {
                    console.log(response);
                });    
		},
		edit: function(id){
            axios.get('./api/clients/'+id+'/edit')
                .then(response => {
                	this.client = response.data;
					this.action = 'edit';                  
                })
                .catch(response => {
                    console.log(response);
                }); 
		},
		update: function(client){
            axios.put('./api/clients/'+client.id,client)
                .then(response => {
                	var active = response.data.active === 1 ? 'Activo' : 'Inactivo';
                	this.items.forEach(function(value,index){
                		if(value.id === response.data.id){
                			value.Nombre = response.data.name;
                			value.Apellido = response.data.lastname;
                			value.Email = response.data.email;
                			value.Estado = active;
                		}
                	});
                })
                .catch(response => {
                    console.log(response);
                });  			
		},
		destroy: function(id){
            axios.delete('./api/clients/'+id)
                .then(response => {
        			var index = this.items.indexOf(response.data);
        			this.items.splice(index,1);               
                })
                .catch(response => {
                    console.log(response);
                }); 
		}
	}
}
</script>