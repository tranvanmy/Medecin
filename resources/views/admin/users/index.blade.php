@extends('admin.master')

@section('content-admin')
<div class="content-admin" id="listUser">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{ trans('message.users') }}</h2>
        </div>
        <div class="panel-body">
            <div class="col-md-12 admin-actions">
                <a href="{{ route('user.create') }}" class="btn btn-success col-md-2">
                    <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('message.new_user') }}</a>

                <form role="form" class="col-md-5">
                    <div class="form-group">
                        {{-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."> --}}
                    </div>
                </form>
            </div>
            <table class="table table-hover table-bordered">
                <tdead >
                    <tr>
                        <td class="text-center">{{ trans('message.id') }}</td>
                        <td class="text-center">{{ trans('message.name') }}</td>
                        <td class="text-center">{{ trans('message.phone') }}</td>
                        <td class="text-center">{{ trans('message.email') }}</td>
                        <td class="text-center">{{ trans('message.sex') }}</td>
                        <td class="text-center">{{ trans('message.permisstion') }}</td>
                        <td class="text-center">{{ trans('message.action') }}</td>
                    </tr>   
                </tdead>
                <tbody>
                    <tr v-for="list in lists" class="text-center" v-bind:id='"User-"+ list.id'>
                        <td class="col-md-1">@{{ list.id }}</td>
                        <td class="col-md-1">
                        <a data-toggle="modal" v-on:click="showUser(list)">@{{ list.name }}</a></td>
                        <td class="col-md-1">@{{ list.phone }}</td>
                        <td class="col-md-1">@{{ list.email }}</td>
                        <td class="col-md-1" v-if="list.sex == 1"><span class="label label-info">
                            {{ trans('message.male') }}
                        </span></td>
                        <td class="col-md-1" v-if="list.sex == 0"><span class="label label-info">
                            {{ trans('message.Famele') }}
                        </span></td>
                        <td class="col-md-1 text-center" v-if="list.permission == 1"><span class="label label-success">
                            {{ trans('message.Admin') }}
                        </span></td>
                        <td class="col-md-1 text-center" v-if="list.permission == 2"><span class="label label-success">
                            {{ trans('message.Doctor') }}
                        </span></td>
                         <td class="col-md-1 text-center" v-if="list.permission == 3"><span class="label label-danger">
                            {{ trans('message.Disable') }}
                        </span></td>

                        <td class="col-md-1 text-center">
                            <a data-toggle="modal" v-on:click="editUser(list)"><i class="fa fa-list" aria-hidden="true"></i></a>
                            <a v-on:click="deleteUser(list.id)"><i class="fa fa-fw  fa-close get-color-icon-delete" ></i></a>
                        </td>
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
    <div class="modal fade" id="infoUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{ trans('message.close') }}</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('message.info_user') }}</h4>
                </div>
                <div class="modal-body row">
                    <div class=" image-user col-md-4">
                        <div class="box-body box-profile">
                            <div class="col-md-10">
                                <img class="img-responsive img-circle" src="{{ asset('huonggiang.jpg')}}" alt="User profile picture"> 
                                <h3 class="profile-username text-center">
                                <i class="fa fa-leaf" aria-hidden="true"></i>
                                @{{ fillItem.name }}
                                </h3>
                                <a class="btn btn-primary btn-block" href="{{ route('user.edit', ['id' => 1]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>{{ trans('message.edit') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="info-user col-md-8">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><i class="fa fa-phone" aria-hidden="true"></i>{{ trans('message.phone') }} :</b>
                                <a>@{{ fillItem.phone }}</a>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <b>{{ trans('message.mail') }}:</b>
                                <a>
                                    @{{ fillItem.email }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b v-if="fillItem.sex == 0"><i class="fa fa-transgender" aria-hidden="true"></i>{{ trans('message.gender') }} : {{ trans('message.male')}}</b>
                                <b v-if="fillItem.sex == 1"><i class="fa fa-transgender" aria-hidden="true"></i>{{ trans('message.gender') }} : {{ trans('message.Female')}}</b>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fa fa-id-card" aria-hidden="true"></i>{{ trans('message.permission') }} :</b>
                                <a>
                                    <span  v-if="fillItem.permission == 1" class="label label-success">
                                        {{ trans('message.Admin') }}
                                    </span>
                                    <span  v-if="fillItem.permission == 2" class="label label-success">
                                        {{ trans('message.Doctor') }}
                                    </span>
                                    <span  v-if="fillItem.permission == 3" class="label label-danger">
                                        {{ trans('message.Disable') }}
                                    </span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fa fa-birtdday-cake" aria-hidden="true"></i>{{ trans('message.age') }} :</b>@{{ fillItem.age }}
                            </li>
                            <li class="list-group-item">
                                <b><i class="fa fa-birtdday-cake" aria-hidden="true"></i>{{ trans('message.address') }} :</b>@{{ fillItem.address }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>
    {{-- edit --}}
    <div class="modal fade" id="editUser" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('message.edit_user') }}</h4>
                </div>
                <div class="modal-body">
                    <form method = "post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)">
                <div class="form-group col-md-4">
                    <label>{{ trans('message.name') }}</label>
                    <span v-if="formErrorsUpdate['name']" class="error text-danger">@{{ formErrorsUpdate['name'][0] }}</span><br>
                    <div>
                        <input type="text" name="name" placeholder="User Name" class="form-control" v-model="fillItem.name">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label>{{ trans('message.phone') }}</label>
                    <span v-if="formErrorsUpdate['phone']" class="error text-danger">@{{ formErrorsUpdate['phone'][0] }}</span><br>
                    <div>
                        <input type="text" name="phone" placeholder="Phone" class="form-control" v-model="fillItem.phone">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label>{{ trans('message.email') }}</label>
                    <span v-if="formErrorsUpdate['email']" class="error text-danger">@{{ formErrorsUpdate['email'][0] }}</span><br>
                    <input type="email" name="email" placeholder="Enter your email" class="form-control" v-model="fillItem.email">
                </div>
                <div class="form-group col-md-12">
                    <label>{{ trans('message.address') }}</label>
                    <span v-if="formErrorsUpdate['address']" class="error text-danger">@{{ formErrorsUpdate['address'][0] }}</span><br>
                    <div>
                        <input type="text" name="address" placeholder="Address" class="form-control" v-model="fillItem.address">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>{{ trans('message.age') }}</label>
                    <span v-if="formErrorsUpdate['age']" class="error text-danger">@{{ formErrorsUpdate['age'][0] }}</span><br>
                    <div>
                        <input type="number" name="age" placeholder="Age" class="form-control" v-model="fillItem.age">
                    </div>
                </div>
                <div class="col-md-6">
                    <label>{{ trans('message.gender') }}</label>
                    <span v-if="formErrorsUpdate['sex']" class="error text-danger">@{{ formErrorsUpdate['sex'][0] }}</span><br>
                     <select  class="form-control create_customer" name="sex" v-model="fillItem.sex">
                        <option value="1">{{ __('Male') }}</option>
                        <option value="0">{{ __('Famele') }}</option>
                    </select>
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-6">
                    <label>{{ trans('message.permisstion') }}</label>
                    <span v-if="formErrorsUpdate['permission']" class="error text-danger">@{{ formErrorsUpdate['permission'][0] }}</span><br>
                     <select class="form-control" name="permission" v-model="fillItem.permission" v-on:change="specialist">
                        <option value="1">{{ __('Amin') }}</option>
                        <option value="2">{{ __('Doctor') }}</option>
                        <option value="3">{{ __('Disable') }}</option>
                    </select>
                </div>
                 <div class="form-group col-md-6" id="sepilisc">
                    <label>{{ trans('message.specialist') }}</label>
                    <select class="form-control" id="sel1" v-model="fillItem.specialist_id" selected>
                        <option v-bind:value="special.id" v-for="special in listSpecial">@{{ special.name }}</option>
                    </select>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">
                    <i class="fa fa-wrench" aria-hidden="true"></i>
                    {{ trans('message.Update') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    {{ trans('message.Close') }}</button>
                </div>
            </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
    {{ Html::script('js/user/list.js') }}
@endsection
