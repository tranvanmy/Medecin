@extends('admin.master')

@section('content-admin')
<div class="content-wrapper">
    <div class="content-admin" id="index-patients">
        <div class="panel">
            <div class="panel-heading">
                <h2>Bệnh Nhân</h2>
              @if(session('message'))
                <div class="alert alert-success">
                  <p>{{session('message')}}</p>
                </div>
              @endif
            </div>
            <div class="panel-body">
                <div class="col-md-12 admin-actions">
                        <a href="javascript:void(0)" v-on:click="createPatient()" class="btn btn-success col-md-2"> <i class="fa fa-plus" aria-hidden="true"></i>
                        Thêm Mới</a>
                    <form role="form" class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Tìm Kiếm Bệnh Nhân" v-model="search.name" v-on:keyup="searchPatient()">
                        </div>
                    </form>
                </div>
                <table class="table table-hover table-bordered">
                    <thead >
                        <tr>
                            <th class="text-center">{{ trans('message.id') }}</th>
                            <th class="text-center">{{ trans('message.name') }}</th>
                            <th class="text-center">{{ trans('message.phone') }}</th>
                            <th class="text-center">{{ trans('message.email') }}</th>
                            <th class="text-center">{{ trans('message.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <paginate
                        name="patients"
                        :list="patients"
                        :per="10"
                    >
                        <tr v-for = "item in paginated('patients')">
                            <th class="col-md-1">@{{ item.id }}</th>
                            <th class="col-md-3">@{{ item.name }}</th>
                            <th class="col-md-3">@{{ item.phone }}</th>
                            <th class="col-md-3">@{{ item.email }}</th>
                            <th class="col-md-2">
                              @if (Auth::user()->permission == 1)
                                <a  @click='addIdModal(item.id)'  class="btn btn-success" data-toggle="modal" data-target="#addVideo" ><i class="fa fa-file-video-o" aria-hidden="true"></i></a>
                              @endif  
                                <a :href="'patient/' + item.id " class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="javascript:void(0)"  class="btn btn-primary" v-on:click="editPatient(item.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @if (Auth::user()->permission == 1)
                                @endif
                            </th>
                        </tr>
                    </paginate>
                    </tbody>
                </table>
                <paginate-links for="patients" :limit="2" :show-step-links="true" :classes="{'ul': 'pagination'}"></paginate-links>
            </div>
          @if(session('danger'))
            <div class="alert alert-danger">
              <p>{{session('danger')}}</p>
            </div>
          @endif
        </div>
        <!-- Add Video modal -->
        <div class="modal fade" id="addVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{ trans('message.close') }}</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{ trans('message.add_video') }}</h4>
                    </div>

                    <div class="modal-body ">
                        <form action="{{route('media-medical.store')}}" id="modal-form" method = "post" enctype="multipart/form-data">
                          <input name='userId' type="hidden" v-bind:value='modal.id' >
                          {{ csrf_field() }}
                          {{-- video  --}}
                            <div class="form-group">
                                <label>{{ trans('message.video') }}</label>
                                <div>
                                    <input  type="file" name="video" class="form-control">
                                </div>
                            </div>
                          {{-- content --}}
                            <div class="form-group">
                              <label for=""> {{__('message.content')}} </label>
                              <textarea name="content" class="form-control" rows="5" type="text"></textarea>
                            </div>
                          {{-- date --}}
                            <div class="form-group">
                              <label for=""> {{__('message.date')}} </label>
                              <input id='datepicker' name="date_examination" class="form-control" type="text">
                            </div>
                            <div id="validate-date" class="hide alert alert-danger">
                              Thời gian không hợp lệ.
                            </div>
                            <button id='btnaddnewvideo' data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i>Vui lòng đợi" type="submit" class="btn btn-primary">{{ trans('message.add') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Add Video modal --}}
        <!-- New patient modal -->
        <div class="modal fade" id="newPatient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{ trans('message.close') }}</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{ trans('message.new_patient') }}</h4>
                    </div>

                    <div class="modal-body ">
                        <form method = "POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="form-group col-md-6">
                                <label> <i class="fa fa-user" aria-hidden="true"></i> {{ trans('message.name') }}</label>
                                <div>
                                    <input type="text" name="name" placeholder="User Name" class="form-control" v-model="patient.name" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label><i class="fa fa-envelope" aria-hidden="true"></i> {{ trans('message.email') }}</label>
                                <input type="email" name="email" placeholder="example@example.com" class="form-control" v-model="patient.email" >
                            </div>
                            <div class="form-group col-md-6">
                                <label><i class="fa fa-map-marker" aria-hidden="true"></i> {{ trans('message.address') }}</label>
                                <div>
                                    <input type="text" name="address" placeholder="Address" class="form-control" v-model="patient.address" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label><i class="fa fa-phone" aria-hidden="true"></i> {{ trans('message.phone') }}</label>
                                <div>
                                    <input type="text" name="phone" placeholder="Phone" class="form-control" v-model="patient.phone" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label><i class="fa fa-angellist" aria-hidden="true"></i> {{ trans('message.age') }}</label>
                                <div class="clearfix"></div>
                                <div>
                                    <input type="number" name="age" placeholder="Age" v-model="patient.age" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label><i class="fa fa-transgender-alt" aria-hidden="true"></i> {{ trans('message.gender') }}</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="sex" value="1" v-model="patient.sex" checked="checked">{{ trans('message.male') }}
                                    </label>
                                    <label>
                                    <input type="radio" name="sex" value="0" v-model="patient.sex">{{ trans('message.female') }}
                                    </label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div style="margin-left: 800px;">
                            <button id='addnewpatients' type="button" v-on:click="storePatient()" class="btn btn-success"> <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('message.add') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Update patient modal -->
        <div class="modal fade" id="updatePatient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{ trans('message.close') }}</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{ trans('message.edit_patient') }}</h4>
                    </div>

                    <div class="modal-body ">
                        <form method = "POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="form-group col-md-6">
                                <label><i class="fa fa-user" aria-hidden="true"></i> {{ trans('message.name') }}</label>
                                <div>
                                    <input type="text" name="name" placeholder="User Name" class="form-control" v-model="patient.name" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label><i class="fa fa-envelope" aria-hidden="true"></i> {{ trans('message.email') }}</label>
                                <input type="email" name="email" placeholder="Enter your email" class="form-control" v-model="patient.email" >
                            </div>
                            <div class="form-group col-md-6">
                                <label><i class="fa fa-map-marker" aria-hidden="true"></i> {{ trans('message.address') }}</label>
                                <div>
                                    <input type="text" name="address" placeholder="Address" class="form-control" v-model="patient.address" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label><i class="fa fa-phone" aria-hidden="true"></i> {{ trans('message.phone') }}</label>
                                <div>
                                    <input type="text" name="phone" placeholder="Phone" class="form-control" v-model="patient.phone" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label><i class="fa fa-angellist" aria-hidden="true"></i>  {{ trans('message.age') }}</label>
                                <div>
                                    <input type="number" name="age" placeholder="Age" v-model="patient.age" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label><i class="fa fa-transgender-alt" aria-hidden="true"></i> {{ trans('message.gender') }}</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="sex" value="1" v-model="patient.sex" :checked="patient.sex == {{ config('custom.male') }}">{{ trans('message.male') }}
                                    </label>
                                    <label>
                                    <input type="radio" name="sex" value="0" v-model="patient.sex" :checked="patient.sex == {{ config('custom.female') }}">{{ trans('message.female') }}
                                    </label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div style="margin-left: 800px;">
                            <button type="button" v-on:click="updatePatient(patient.id)" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i> {{ trans('message.edit') }}</button>
                            </div>
                        </form>
                    </div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Update patient modal -->
    </div>
 </div>
@endsection
@section('script')
{{ Html::script('js/admin/moment.js') }}
    <script>
      $(document).ready(function() {
        $( "#datepicker" ).datepicker({format: 'dd/mm/yyyy'}).datepicker("setDate", new Date());
        $('#btnaddnewvideo').click(function(e) {
          let date = $('#datepicker').val();
          console.log(date)
          if(!moment(date, 'DD/MM/YYYY',true).isValid()) {
            e.preventDefault();
            console.log('fail');
            $('#validate-date').removeClass("hide alert alert-danger").addClass("alert alert-danger");
            return;
          }
          $('#validate-date').removeClass("alert alert-danger").addClass("hide alert alert-danger");
          $(this).button('loading');
        })
      })
    </script>
    {{ Html::script('js/admin/patient.js') }}
@endsection
