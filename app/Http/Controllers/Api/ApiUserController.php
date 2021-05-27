/*           PARTE API           */

public function store(Request $request)
{
    $user = new User;
    $user->username = $request->username;
    $user->name = $request->name;
    $user->surname = $request->surname;
    $user->country = $request->country;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->save();

}

public function show($id)
{
    return User::where('id', $id)->get();
}
