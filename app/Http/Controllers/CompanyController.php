<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('logo', function($row) {
                    return $row->logo ? '<img src="'.Storage::url($row->logo).'" width="100" />' : 'No logo';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('companies.edit', $row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <form action="'.route('companies.destroy', $row->id).'" method="POST" style="display:inline;">
                                 '.csrf_field().'
                                 '.method_field("DELETE").'
                                 <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                              </form>';
                    return $btn;
                })
                ->rawColumns(['logo', 'action'])
                ->make(true);
        }

        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create', [
            'action' => route('companies.store'),
            'submitText' => 'Create Company'
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
{
    $company = Company::create($request->validated());

    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('logos', 'public');
        $company->update(['logo' => $path]);
    }

    return redirect()->route('companies.index')->with('success', 'Company created successfully.');
}
    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit', [
            'company' => $company,
            'component' => new \App\View\Components\CompanyForm($company)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $company->update(['logo' => $path]);
        }

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
