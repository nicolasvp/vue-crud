<template>
  <div>
    <b-modal id="clientModal" title="Cliente" ok-title="Aceptar" cancel-title="Cancelar" ok-variant="success">
      <b-list-group>
        <b-list-group-item>Nombre: {{ client.name }}</b-list-group-item>
        <b-list-group-item>Apellido: {{ client.lastname }}</b-list-group-item>
        <b-list-group-item>Email: {{ client.email }}</b-list-group-item>
        <b-list-group-item>Estado: {{ client.active === 1 ? 'Activo' : 'Inactivo' }}</b-list-group-item>
      </b-list-group>
    </b-modal>
  </div>
</template>
<script>
  export default {
    mounted(){
    },
    props: ['client']
  }
</script>