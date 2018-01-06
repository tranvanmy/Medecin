
@extends('admin.master')

@section('content-admin')
<div class="content-wrapper" id="index-contacts">
    <section class="content-header">
        <h1>
            <small>Liên hệ</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                                <input id="email" type="text" class="form-control" v-on:keyup="searchContact" name="Name" placeholder="Name">
                            </div>
                            <br>
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead >
                                <tr>
                                    <th class="text-center col-md-1">{{ trans('message.id') }}</th>
                                    <th class="text-center col-md-1">{{ trans('message.name') }}</th>
                                    <th class="text-center col-md-1">{{ trans('message.phone') }}</th>
                                    <th class="text-center col-md-1">{{ trans('message.email') }}</th>
                                    <th class="text-center">{{ trans('message.content') }}</th>
                                    <th class="text-center">{{ trans('message.status') }}</th>
                                    <th class="text-center ">{{ trans('message.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <paginate
                                name="contacts"
                                :list="contacts"
                                :per="10"
                                >
                                <tr v-for=" item in paginated('contacts') " v-on:click="getDetailContact(item.id)">
                                    <th class="col-md-1">@{{ item.id }}</th>
                                    <th class="col-md-2">@{{ item.name }}</th>
                                    <th class="col-md-1">@{{ item.phone }}</th>
                                    <th class="col-md-1">@{{ item.email }}</th>
                                    <th class="col-md-5">@{{ item.content }}</th>
                                    <th class="text-center col-md-1" >
                                        <span class="label label-default" v-if="item.status == {{ config('custom.contact.pending') }}">{{ trans('message.pending') }}</span>
                                        <span class="label label-success" v-if="item.status == {{ config('custom.contact.accept') }}">{{ trans('message.accept') }}</span>
                                    </th>
                                    <th class="col-md-1">
                                        <a data-toggle="modal"  class="btn btn-success" v-on:click="getDetailContact(item.id)"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </th>
                                </tr>
                            </paginate>
                        </tbody>
                    </table>
                    <paginate-links for="contacts" :limit="2" :show-step-links="true" :classes="{'ul': 'pagination'}"></paginate-links>
                </div>
            </div>
            <!-- Detail contact -->
            <div class="modal fade" id="detailContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{ trans('message.close') }}</span></button>
                            <h4 class="modal-title" id="myModalLabel">{{ trans('message.detail_contact') }}</h4>
                        </div>
                        <div class="modal-body row">
                            <div class="col-md-12">
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b><i class="fa fa-user" aria-hidden="true"></i>{{ trans('message.name') }} :</b>
                                        <a>@{{ contact.name }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b><i class="fa fa-phone" aria-hidden="true"></i>{{ trans('message.phone') }} :</b>
                                        <a>@{{ contact.phone }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <b>{{ trans('message.email') }}:</b>
                                        <a>
                                            @{{ contact.email }}
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b><i class="fa fa-pencil" aria-hidden="true"></i>{{ trans('message.content') }} :</b>
                                        <p>@{{ contact.content }}</p>
                                    </li>
                                </ul>
                                <button class="btn btn-success" v-if="contact.status == 0" v-on:click="changeStatus(contact.id)">{{ trans('message.accept') }}</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
</div>
@endsection
@section('script')
{{ Html::script('js/admin/contact.js') }}
@endsection
