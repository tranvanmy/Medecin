@extends('admin.master')

@section('content-admin')
  <input type="hidden" id="baseurl" value="{{ url('/') }}">
<div class="content-admin content-wrapper">
    <div class="panel ">
      @if(session('success'))
        <div class="alert alert-success">
          <p>{{session('success')}}</p>
        </div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      @endif
      <br>
      <div class="" style="margin-left: 15px;">

      <a href="{{ route('patient.index') }}" class="btn btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i> Thoat</a>
      </div>

        <div class="panel-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a data-target="#detail" role="tab" data-toggle="tab">Chi tiết bệnh nhân</a></li>
                <li><a data-target="#history" role="tab" data-toggle="tab">Lịch sử khám</a></li>
            </ul>
            <div class="tab-content">
                <!-- detail patient -->
                <div class="tab-pane active" id="detail">
                    <div class=" image-user col-md-4">
                        <div class="box-body box-profile">
                            <div class="col-md-10">
                                <img class="img-responsive img-circle" src="{{ asset('images/unknown.png')}}" alt="User profile picture">
                                <h3 class="profile-username text-center">
                                <i class="fa fa-leaf" aria-hidden="true"></i>
                                {{ $patient->name }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="info-user col-md-8">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><i class="fa fa-phone" aria-hidden="true"></i>{{ trans('message.phone') }} :</b>
                                <a>{{ $patient->phone }}</a>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <b>{{ trans('message.mail') }}:</b>
                                <a>{{ $patient->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fa fa-transgender" aria-hidden="true"></i>{{ trans('message.gender') }} :</b>
                                @if ($patient->sex == config('custom.male'))
                                    <a>{{ trans('message.male') }}</a>
                                @else
                                    <a>{{ trans('message.female') }}</a>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <b><i class="fa fa-birthday-cake" aria-hidden="true"></i>{{ trans('message.age') }} :</b><a>{{ $patient->age }}</a>
                            </li>
                        </ul>
                    </div>
                </div><!-- end detail patient -->

                <!-- history patient -->
                <div class="tab-pane " id="history">
                    <div class="container">
                      <div class="row" id='parent-player'>
                           <video controls='controls' id='player'>
                              <source src="">
                            </video>
                      </div>
                      {{-- http://sanchoi.net/video/2017/9/20170907-023224-11.mov --}}
                      <div class="row">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Ngày khám</th>
                              <th>Video</th>
                              <th>Đang phát</th>
                              @if(Auth::user()->permission == 1)
                                <th>Xóa</th>
                              @endif
                              <th>Chỉnh sửa</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($patient->histories as $key => $history)
                              <tr>
                                <td>{{$history->date_examination}}</td>

                                <td><a class='a-player' href="#" data-blink="{{ $key }}" data-src="{{url('/')}}/<?php echo str_replace("public/","",$history->media->path); ?>{{$history->media->name . '.' . $history->media->type }}">Video {{$key}}</a></td>
                                <td><i id="{{ $key }}" class="{{ $key == 0 ? 'fa fa-play blink' : '' }}"></i></td>
                                @if(Auth::user()->permission == 1)
                                <td>
                                  <form action="{{route('media-medical.destroy', ['id' => $history->id])}}" method="post">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}

                                      <button onclick="return alert()" type="submit" class="btn btn-danger" ><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp;Xóa</button>
                                  </form>
                                </td>
                                @endif
                                <td>
                                  <button data-content= "{{ $history->content }}" data-history-id="{{ $history->id }}" data-toggle="modal" data-target="#addVideo" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Chỉnh sửa</button>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>



                </div>
              {{-- edit modal --}}
                <div class="modal fade" id="addVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{ trans('message.close') }}</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Chỉnh sửa lịch sử khám</strong></h4>
                            </div>

                            <div class="modal-body ">
                                <form action="" id="modal-form" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="_method" value="PUT">
                                  {{ csrf_field() }}
                                  {{-- video  --}}
                                  @if(Auth::user()->permission ==1 )
                                    <div class="form-group">
                                        <label>Chọn video khác</label>
                                        <div>
                                            <input id="file" type="file" name="video" class="form-control">
                                        </div>
                                    </div>
                                  @endif
                                  {{-- content --}}
                                    <div class="form-group">
                                      <label for=""> Nội dung </label>
                                      <textarea id="modal-content" name="content" class="form-control" rows="5" type="text" ></textarea>
                                    </div>
                                    <button id='editvideo' data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i>Vui lòng đợi" type="submit" class="btn btn-primary"> Lưu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              {{-- edit modal --}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>

      $(document).ready(function() {



        $('#editvideo').click(function(e) {
          // e.preventDefault();
          // console.log('?');
          $(this).button('loading');
        })

        $("button[data-toggle='modal']").click(function() {

          let history_id = $(this).data('history-id');
          let content = $(this).data('content');
          let baseurl = $('#baseurl').val();
          console.log(baseurl);
          $('#modal-content').val(content);
        $('#modal-form').attr('action', baseurl + '/admin/media-medical/' + history_id);
        })
        // load video onload
        var link  = $('.a-player').eq(0).attr("data-src")
        $('#player').remove()
        $('#parent-player').append(`
          <video  controls='controls' id='player'>
            <source src='${link}'>
          </video>
        `)

        $('.a-player').click(function(e) {
        e.preventDefault()
        // remove and add new class
        $('.blink').attr('class',"")
        var blink = $(this).data('blink')
        $(`#${blink}`).attr('class', 'fa fa-play blink')
        //change src
        var src= $(this).data('src')
        $('#player').remove()
        $('#parent-player').append(`
          <video  controls='controls' id='player'>
            <source src='${src}'>
          </video>
        `)
        })

      })
      function alert() {
        return confirm("Bạn có chắc chắn muốn xóa?");
      }
    </script>
@endsection
