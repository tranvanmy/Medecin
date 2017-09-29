<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Repositories\PostRepository;
use App\Eloquent\Post;
use Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $post;

    public function __construct(PostRepository $post) {
        $this->post = $post;
    }


    public function index(Request $request)

    {
       if ($request->ajax()) {
        $postList = $this->post->getAllPost('1');
            $response = [
                'pagination' => [
                    'total'        => $postList->total(),
                    'per_page'     => $postList->perPage(),
                    'current_page' => $postList->currentPage(),
                    'last_page'    => $postList->lastPage(),
                    'from'         => $postList->firstItem(),
                    'to'           => $postList->lastItem()
                ],
                'data' => $postList
            ];

            return response()->json($response);
        }
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('admin.posts.edit');
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
        try {
            $post = $this->post->find($id, []);

            $post->delete();
            $response = trans('delete_success');

            return response()->json($response);
        } catch (Exception $e ) {
            $response = trans('delete_failed');

            return response()->json($response);
        }
    }
}
