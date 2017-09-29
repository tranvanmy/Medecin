@extends('admin.master')

@section('content-admin')
<div class="content-admin">
    <div class="panel panel-default" id="listPost">
        <div class="panel-heading">
            <h2>{{ trans('message.posts') }}</h2>
        </div>
        <div class="panel-body">
            <div class="col-md-12 admin-actions">
                <a href="{{ route('post.create') }}" class="btn btn-success col-md-2">{{ trans('message.new_post') }}</a>
                <form role="form" class="col-md-5">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Enter user">
                    </div>
                </form>
            </div>
            <table class="table table-hover table-bordered">
                <thead >
                    <tr>
                        <th class="text-center">{{ trans('message.id') }}</th>
                        <th class="text-center">{{ trans('message.title') }}</th>
                        <th class="text-center">{{ trans('message.description') }}</th>
                        <th class="text-center">{{ trans('message.content') }}</th>
                        <th class="text-center">{{ trans('message.action') }}</th>
                    </tr>   
                </thead>
                <tbody>
                    <tr v-for="post in listPosts"  v-bind:id='"Post-"+ post.id'>
                        <th class="col-md-1">@{{ post.id }}</th>
                        <th class="col-md-2">@{{ post.title }}</th>
                        <th class="col-md-2">
                            <h5 class="ellipis">
                            @{{ post.description }}    
                            </h5>
                            </th>
                        <th class="col-md-6 ellipis">@{{ post.content }}</th>
                        <th class="col-md-1">   
                            <a data-toggle="modal" data-target="#detailPost"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{ route('post.edit', ['id' => 1]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a v-on:click="deletePost(post.id)"><i class="fa fa-fw  fa-close get-color-icon-delete" ></i></a>
                        </th>
                    </tr>
                </tbody>
            </table>
            <ul class="pagination">
                <li v-if="pagination.current_page > 1">
                    <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
                <li v-for="page in pagesNumber"
                v-bind:class="[ page == isActived ? 'active' : '']">
                <a href="#" @click.prevent="changePage(page)">@{{ page }}</a>
                </li>
                <li v-if="pagination.current_page < pagination.last_page">
                    <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)"> <span aria-hidden="true">»</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Info User -->
    <div class="modal fade" id="detailPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{ trans('message.close') }}</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('message.detail_post') }}</h4>
                </div>
                <div class="modal-body row">
                    <div class="col-md-12">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{ trans('message.title') }} :</b>
                                <p>Lorem Ipsum</p>
                            </li>
                            <li class="list-group-item">
                                <b>{{ trans('message.description') }}:</b>
                                <p>
                                    "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
                                </p>
                            </li>
                            <li class="list-group-item">
                                <b>{{ trans('message.content') }}:</b>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                                </p>
                            </li>
                        </ul>
                        <a  class="btn btn-primary" href="{{ route('post.edit', ['id' => 1]) }}">{{ trans('message.edit') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
    {{ Html::script('js/post/list.js') }}
@endsection
