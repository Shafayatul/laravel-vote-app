<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\InvoiceRow;
use Illuminate\Http\Request;

class InvoiceRowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $invoicerows = InvoiceRow::where('project_id', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('group', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $invoicerows = InvoiceRow::latest()->paginate($perPage);
        }

        return view('invoice-rows.index', compact('invoicerows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('invoice-rows.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        InvoiceRow::create($requestData);

        return redirect('invoice-rows')->with('flash_message', 'InvoiceRow added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $invoicerow = InvoiceRow::findOrFail($id);

        return view('invoice-rows.show', compact('invoicerow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $invoicerow = InvoiceRow::findOrFail($id);

        return view('invoice-rows.edit', compact('invoicerow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $invoicerow = InvoiceRow::findOrFail($id);
        $invoicerow->update($requestData);

        return redirect('invoice-rows')->with('flash_message', 'InvoiceRow updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        InvoiceRow::destroy($id);

        return redirect('invoice-rows')->with('flash_message', 'InvoiceRow deleted!');
    }
}
