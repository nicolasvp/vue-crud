<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{

    public function index()
    {
        return response()->json(Client::orderBy('id','asc')->limit(5)->get());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return response()->json($client);
    }

    public function show($id)
    {
        return response()->json(Client::find($id));
    }

    public function edit($id)
    {
        return response()->json(Client::find($id));
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->name = $request->name;
        $client->email = $request->email;

        return response()->json($client);
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        return response()->json('ok');
    }
}
