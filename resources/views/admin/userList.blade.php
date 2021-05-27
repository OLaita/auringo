<thead>
    <tr>
      <th>#</th>
      <th>Image</th>
      <th>Username</th>
      <th>Name</th>
      <th>Lastname</th>
      <th>Rol</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
@foreach ($users as $user)
    <tr>
      <th>{{$user->id}}</th>
      <th><img src="{{$user->image}}" style="width:100px;height:100px;" class="rounded-circle"></th>
      <td>{{$user->username}}</td>
      <td>{{$user->name}}</td>
      <td>{{$user->surname}}</td>
      <td>{{$user->roles->rol}}</td>
      <td>Actions</td>
    </tr>


@endforeach
</tbody>
