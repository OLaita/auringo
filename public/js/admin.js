$(document).ready(function(){

		$.ajax({
			url:"{{route('user.list')}}",
			success:function(data){
        console.log("GAOSAJD");
                console.log(data);/*
				var table;
				if ( $.fn.DataTable.isDataTable('#userTable') ) {
					$("#userTable").empty();
				  $('#userTable').DataTable().clear().destroy();
				}
				$("#userTable").empty().html(data);
				hola();
*/
				}
		});



function hola(){
	$('#userTable').DataTable({
  "columnDefs": [{
   "targets": 0
  }],
  language: {
   "sProcessing": "Procesando...",
   "sLengthMenu": "Mostrar _MENU_ resultados",
   "sZeroRecords": "No se encontraron resultados",
   "sEmptyTable": "Ningún dato disponible en esta tabla",
   "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
   "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
   "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
   "sSearch": "Buscar:",
   "sLoadingRecords": "Cargando...",
   "oPaginate": {
    "sFirst": "Primero",
    "sLast": "Último",
    "sNext": "Siguiente",
    "sPrevious": "Anterior"
   },
  }
 });

}

});
