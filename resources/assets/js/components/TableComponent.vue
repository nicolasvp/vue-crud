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
					<b-button size="sm" variant="warning" @click="edit(row.item.id)"> Editar</b-button>
					<b-button size="sm" variant="danger" @click="delete(row.item.id)"> Eliminar</b-button>
				</template>		             
		    </b-table>
		    <v-modal :client="client"></v-modal>		
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
			client: ''
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

		},
		show: function(id){
            axios.get('./api/clients/'+id)
                .then(response => {
					this.client = response.data;
                })
                .catch(response => {
                    console.log(response);
                });    
		},
		edit: function(id){
            axios.get('./api/clients/'+id+'/edit')
                .then(response => {
					console.log(response.data)                  
                })
                .catch(response => {
                    console.log(response);
                }); 
		},
		delete: function(id){
			console.log('delete: '+ id);
			/*
            axios.delete('./api/clients/'+id)
                .then(response => {
					console.log(response.data)                  
                })
                .catch(response => {
                    console.log(response);
                }); 
                */
		}
	}
}
</script>