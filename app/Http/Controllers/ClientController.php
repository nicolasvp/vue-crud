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
        $image = '';

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $image = \Storage::disk('images')->putFile('/', $file);      
        }

        $client = Client::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'image' => $image,
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

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $image = \Storage::disk('images')->putFile('/', $file);   

            if($client->image != ''){
                \Storage::disk('images')->delete($client->image);    
            }

            $client->image = $image;     
        }

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
