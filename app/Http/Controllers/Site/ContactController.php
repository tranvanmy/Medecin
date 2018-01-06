<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;
use App\Contracts\Repositories\ContactRepository;

class ContactController extends Controller
{
    protected $contact;

    /**
     * Pham Viet Toan
     * 09/24/2017
     *
     * Construct class
     */
    public function __construct(ContactRepository $contact)
    {
        $this->contact = $contact;
    }
    /**
     * Pham Viet Toan
     * 09/27/2017
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sites.lienhe.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Pham Viet Toan
     * 09/24/2017
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $newContact = $request->all();
        $newContact['status'] = config('custom.contact.pending');
        $newContact['phone'] = empty($newContact['phone']) ? "X" : $newContact['phone'];
        $newContact['email'] = empty($newContact['email']) ? "X" : $newContact['email'];
        if ($this->contact->create($newContact)) {
            return back()->with('success', trans('message.contact_success'));
        } else {
            return back()->with('failed', trans('message.contact_failed'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
