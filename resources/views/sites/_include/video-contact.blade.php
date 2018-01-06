<section class='contact'>
    <div class="container">
    <div class="row">

      <div class="col-sm-8">
        <div class="col-sm-12">
          <h2 class='topic-name'>Video</h2>
          <div class="line"></div>
       </div>
       @if($videoIntro != '')
        <video controls="controls" width="100%" >
            <source src="{{ $videoIntro }}" type="video/mp4" />
        </video>
        @endif
      </div>
      <div class="col-sm-4">
        <div class="col-sm-12">
          <h2 class='topic-name'>Liên hệ</h2>
           <div class="line"></div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('failed'))
            <div class="alert alert-error">
                {{ session('failed') }}
            </div>
        @endif
        <form method = "POST" enctype="multipart/form-data" action="{{ route('contact.store') }}">
        {{ csrf_field() }}
          <div class="form-group">
            <label for="formGroupExampleInput">Họ và Tên</label>
            <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Vui lòng nhập họ và tên" required value="{{ old('name') }}">
            @if ($errors->has('name'))
                <span class="help-block">
                     <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput2">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" id="formGroupExampleInput2" placeholder="Vui lòng nhập số điện thoại"  value="{{ old('phone') }}">
            @if ($errors->has('phone'))
              <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput2">Email</label>
            <input type="email" class="form-control" name="email" id="formGroupExampleInput2" placeholder="Vui lòng nhập nhập Email"  value="{{ old('email') }}">
            @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput2">Nội dung</label>
            <textarea type="text" name="content" class="form-control" id="formGroupExampleInput2" placeholder="Vui lòng nhập nội dung liên hệ của bạn" rows='10' required>{{ old('content') }}</textarea>
            @if ($errors->has('content'))
              <span class="help-block">
                <strong>{{ $errors->first('content') }}</strong>
              </span>
            @endif
          </div>
          <button type='sumbit' class='btn btn-primary '><i class='fa fa-send'></i>Gửi</button>
      </form>
      </div>
    </div>
  </div>

</section>
