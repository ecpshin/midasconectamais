<?php

namespace App\Http\Controllers;

use App\Models\AgenteMailing;
use App\Models\Mailing;
use Illuminate\Http\Request;

class AgenteMailingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $atendimento = Mailing::find($request->id);
        $request['user_id'] = $request->user()->id;
        $atendimento->update($request->all());
        dd($atendimento);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mailing $agenteMailing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AgenteMailing $agenteMailing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AgenteMailing $agenteMailing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AgenteMailing $agenteMailing)
    {
        //
    }
}
