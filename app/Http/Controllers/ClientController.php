<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Http\Requests;

class ClientController extends Controller
{

    public function index()
    {
        return response()->json(Client::orderBy('id','desc')->get());
    }

    public function create()
    {
        //
    }

    public function store(Requests \ClientRequest $request)
    {  
        $client = Client::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'active' => $request->active
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

    public function update(Requests \ClientRequest $request, $id)
    {
        $client = Client::find($id);
        $client->name = $request->name;
        $client->lastname = $request->lastname;
        $client->email = $request->email;
        $client->active = $request->active;
        $client->save();

        return response()->json($client);
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        return response()->json($id);
    }
}
