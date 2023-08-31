<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePhoneRequest;
use App\Models\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $phone = Phone::where('name', $request->name)->withTrashed()->first();

        if ($phone) {
            $phone->restore();
        } else {
            $request->validate([
                'name' => 'required',
            ]);
            Phone::create($request->all());
        }

        return redirect()->route('phone.index')
            ->with('success', 'fonction créé avec succès.');
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(Phone $phone)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Phone $phone)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhoneRequest $request, Phone $phone)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phone $phone)
    {
        $phone->delete();

        return redirect()->route('phones.index')
                        ->with('success', 'la numéro est supprimé avec succès');
    }
}
