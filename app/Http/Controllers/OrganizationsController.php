<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Http\Requests\StoreAndUpdateOrganizationRequest;

class OrganizationsController extends Controller
{
    public function index()
    {
        return view('organizations.index')->with([
            'orgs' => Organization::all()
        ]);
    }

    public function store(StoreAndUpdateOrganizationRequest $request)
    {
        Organization::query()->create($request->validated());

        return redirect()->back()->with([
            'message' => 'Organização adicionada com sucesso'
        ]);
    }

    public function edit($id)
    {
        return view('organizations.edit')->with([
            'organization' => Organization::query()->findOrFail($id)
        ]);
    }

    public function update(StoreAndUpdateOrganizationRequest $request, $id)
    {
        Organization::query()
            ->findOrFail($id)
            ->update($request->validated());

        return redirect()->route('organizations')
            ->with(['success_message' => 'Organização actualizada com sucesso.']);
    }

    public function destroy($id)
    {
        $organization = Organization::query()->findOrFail($id);

        if ($organization->users()->count() > 0) {
            return redirect()->back()->withErrors(['organization_error'=> 'Esta organização tem utilizadores, então não pode ser eliminada.']);
        }

        $organization->delete();
        
        return redirect()->back();
    }
}
