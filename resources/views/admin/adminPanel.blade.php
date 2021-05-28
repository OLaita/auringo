@extends('layouts.app')
@section('content')

<div class="container">
  <div id="error" class="text-danger">
    @if($errors->any())
        <h4>{{$errors->first()}}</h4>
    @endif
</div>
  <h4 class="d-flex justify-content-between">
    <a style="text-decoration:none; color:black;" class="list" role="button" type="button" id="user">Usuarios</a>
    <a style="text-decoration:none; color:black;" class="list" role="button" type="button" id="pro">Proyectos</a>
  </h4>
  <hr>
  <h3 id="listName">Lista de usuarios</h3>
  <div class="table-responsive">
      <table id="table" class="table">

      </table>
      <div id="carga"></div>
    </div>

</div>

    <script>
      $(document).ready(function() {
        $.ajax({
        url:"{{route('user.list')}}",
        beforeSend:function () {
                    $("#carga").empty().html('<img src="{{asset("storage/l2.svg")}}">');
                },
        success:function(data){
          var table;
          $("#carga").empty();
          if ( $.fn.DataTable.isDataTable('#table') ) {
            $("#table").empty();
            $('#table').DataTable().clear().destroy();
          }
          $("#table").empty().html(data);
          hola();
          }
      });

    $("#user").click(function(){
      $("#listName").empty().html("Lista de usuarios");
      $('#error').hide();
      $.ajax({
        url:"{{route('user.list')}}",
        beforeSend:function () {
                    $("#carga").empty().html('<img src="{{asset("storage/l2.svg")}}">');
                },
        success:function(data){
          var table;
          $("#carga").empty();
          if ( $.fn.DataTable.isDataTable('#table') ) {
            $("#table").empty();
            $('#table').DataTable().clear().destroy();
          }
          $("#table").empty().html(data);
          hola();
          }
      });
	});

  $("#pro").click(function(){
    $("#listName").empty().html("Lista de proyectos");
    $('#error').hide();
      $.ajax({
        url:"{{route('pro.list')}}",
        beforeSend:function () {
                    $("#carga").empty().html('<img src="{{asset("storage/l2.svg")}}">');
                },
        success:function(data){
          var table;
          $("#carga").empty();
          if ( $.fn.DataTable.isDataTable('#table') ) {
            $("#table").empty();
            $('#table').DataTable().clear().destroy();
          }
          $("#table").empty().html(data);
          hola();
          }
      });
	});


function hola(){
	$('#table').DataTable({
  language: {
                 "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
             }
 });
}
    });
</script>
@endsection
