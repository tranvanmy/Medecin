<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Repositories\UserRepository;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateRequest;
use App\Eloquent\User;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $user;

    public function __construct(UserRepository $user) {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userList = $this->user->getAllUser('1', '2', '3','10');
            $response = [
                'pagination' => [
                    'total'        => $userList->total(),
                    'per_page'     => $userList->perPage(),
                    'current_page' => $userList->currentPage(),
                    'last_page'    => $userList->lastPage(),
                    'from'         => $userList->firstItem(),
                    'to'           => $userList->lastItem()
                ],
                'data' => $userList
            ];

            return response()->json($response);
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        if ($this->user->create($data)) {
            $response['status'] = 'Thanh Cong ';
            $response['message'] = trans('Them Nguoi Dung Thanh Cong');
            $response['action'] = trans('Thanh Cong');
        } else {
            $response['status'] = 'error';
            $response['message'] = trans('admin.error_happen');
            $response['action'] = trans('admin.error');
        }

        return response()->json($response);
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
        return view('admin.users.edit');
    }

    /**
     * Update the specified resource in storage.
     *tran van my 
     *24/09/2016
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        // $data = $request->except('password');
        // $data['password'] = bcrypt($request->password);
        $user = $this->user->update($id, $request->all());
        if ($user) {
            $response['status'] = 'success';
            $response['message'] = trans('message.edit_success');
            $response['action'] = trans('message.success');
        } else {
            $response['status'] = 'error';
            $response['message'] = trans('admin.error_happen');
            $response['action'] = trans('admin.error');
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *tran van my 
     *24-09-2017
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = $this->user->find($id, []);

            $user->delete();
            $message = trans('delete_success');
            return Response::json($message, 200);
        } catch (Exception $e ) {
            $message = trans('delete_failed');
            return Response::json($message, 403);
        }
    }
}
