@extends('layouts.app')
@section('content')

<div class="container">

    <h3>Lista de usuarios</h3>
    <div class="table-responsive">
        <table id="userTable" class="table">

        </table>
      </div>
    </div>

<script src="{{asset('js/admin.js')}}"></script>
@endsection
