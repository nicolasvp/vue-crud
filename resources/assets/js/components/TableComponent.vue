<style lang="scss">

</style>

<template>
	<div>
		<b-row>
			<b-col>
				<b-row>
					<b-col cols="3">
						<h1>Clientes</h1>
					</b-col>
					<b-col cols="9" style="margin-top: 1.1rem;">
						<b-button variant="success" @click="create">Crear</b-button>
					</b-col>
				</b-row>
			</b-col>
			<b-col>				
				<b-form-group horizontal label="Buscar" class="mb-10">
					<b-input-group>
						<b-form-input v-model="filter" placeholder="Escriba acá lo que desea buscar"/>
					</b-input-group>
				</b-form-group>				
			</b-col>
		</b-row>
	    <b-table :sort-by.sync="sortBy"
	             :sort-desc.sync="sortDesc"
	             :items="items"
	             :fields="fields"
	             :current-page="currentPage"
	             :per-page="perPage"
	             :filter="filter"
	             >
			<template slot="Acciones" slot-scope="row">
				<b-button size="sm" variant="primary" @click="show(row.item.id)"> Ver</b-button>
				<b-button size="sm" variant="warning" @click="edit(row.item.id)"> Editar</b-button>
				<b-button size="sm" variant="danger" @click="destroy(row.item.id)"> Eliminar</b-button>
			</template>		             
	    </b-table>
		<b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
	    <v-modal :client="client" :action="action" :store="store" :update="update" :errors="errors"></v-modal>		
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
			action: '',
			currentPage: 1,
			perPage: 10,
			totalRows: 0,
			filter: null,
			errors: []
		}
	},
	methods: {
		_fetch: function(){
            axios.get('./api/clients')
                .then(response => {
                	var items = [];
                    $.each(response.data, function(index, value) {
						var active = value.active == "1" ? 'Activo' : 'Inactivo';
						items.push({id: value.id, Nombre: value.name, Apellido: value.lastname, Email: value.email, Estado: active});
                    });  
                    this.items = items;    
                    this.totalRows = this.items.length;              
                })
                .catch(response => {
                    console.log(response);
                });
		},
		create: function(){
			this.action = 'create';
			this.client = '';
			this.$root.$emit('bv::show::modal','clientModal');
			this.errors = [];
		},
		store: function(new_client){
            axios.post('./api/clients',new_client)
                .then(response => {
                	var active = response.data.active == "1" ? 'Activo' : 'Inactivo';
					this.items.unshift({id: response.data.id, Nombre: response.data.name, Apellido: response.data.lastname, Email: response.data.email, Estado: active});
                	this.$root.$emit('bv::hide::modal','clientModal');
                	this.errors = [];
                })
                .catch((error) => {
                	if(typeof error.response != 'undefined'){
                		this.errors = this.errorsMsg(error);
                	}
                });  			
		},
		show: function(id){
            axios.get('./api/clients/'+id)
                .then(response => {
					this.client = response.data;
					this.action = 'show';
					this.$root.$emit('bv::show::modal','clientModal');
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
					this.$root.$emit('bv::show::modal','clientModal'); 
					this.errors = [];              
                })
                .catch(response => {
                    console.log(response);
                }); 
		},
		update: function(client){
            axios.put('./api/clients/'+client.id,client)
                .then(response => {
                	var active = response.data.active == "1" ? 'Activo' : 'Inactivo';
                	this.items.forEach(function(value,index){
                		if(value.id === response.data.id){
                			value.Nombre = response.data.name;
                			value.Apellido = response.data.lastname;
                			value.Email = response.data.email;
                			value.Estado = active;
                		}
                	});

                	this.errors = [];
                	this.$root.$emit('bv::hide::modal','clientModal');
                })
                .catch((error) => {
                	if(typeof error.response != 'undefined'){
                		this.errors = this.errorsMsg(error);
                	}
                });  			
		},
		destroy: function(id){
			if(confirm('¿Está seguro de eliminar este registro?')){
	            axios.delete('./api/clients/'+id)
	                .then(response => {
	                	var index = this.items.indexOf(this.items.find(x => x.id == response.data));
	        			this.items.splice(index,1);               
	                })
	                .catch(response => {
	                    console.log(response);
	                }); 
            }
		},
	    onFiltered (filteredItems) {
	      // Trigger pagination to update the number of buttons/pages due to filtering
	      this.totalRows = filteredItems.length
	      this.currentPage = 1
	    },
	    errorsMsg: function(error){
        	var errors = [];
        	$.each(error.response.data.errors,function(index,value){
        		errors[index] = value[0];
        	});

        	return errors;	    	
	    }
	}
}
</script>