<div class="utility">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class='topic-name'>Tiện tích</h2>
         <div class="line"></div>
      </div>
        <div class="col-sm-12">
           <section id="boxes" class="home-section paddingtop-80">

            <div class="row">

                      <div class="col-sm-4 col-md-4">
                          <div class="wow fadeInUp" data-wow-delay="0.2s">
                              <div class="box text-center">
                                @if(Auth::check())
                                 <a class="dropdown-item" href="/profile/video-sieu-am"><i class="fa fa-user-md fa-3x circled bg-skin"></i></a>
                                    <h4 class="h-bold">Video siêu âm</h4>
                                    <p>
                                        Thuận lợi trong việc xe kết quả siêu âm, giảm thời gian....
                                    </p>
                                @else 
                                    <a href="{{ route('login') }}"><i class="fa fa-user-md fa-3x circled bg-skin"></i></a>
                                    <h4 class="h-bold">Video siêu âm</h4>
                                    <p>
                                        Thuận lợi trong việc xe kết quả siêu âm, giảm thời gian....
                                    </p>
                                @endif
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-4 col-md-4">
                          <div class="wow fadeInUp" data-wow-delay="0.2s">
                              <div class="box text-center">
                                   <a href="{{ route('doctor.calender.show') }}"><i class="fa fa-list-alt fa-3x circled bg-skin"></i></a>
                                  <h4 class="h-bold">Lịch làm việc bác sĩ</h4>
                                  <p>
                                      Dễ dàng tra cứu lịch làm việc bác sĩ...
                                  </p>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-4 col-md-4">
                          <div class="wow fadeInUp" data-wow-delay="0.2s">
                              <div class="box text-center">
                              <a href="{{ route('contact.store') }}">
                                  <i class="fa fa-hospital-o fa-3x circled bg-skin"></i>
                              </a>
                                  <h4 class="h-bold">Lien He</h4>
                                  <p>
                                     Tra loi nhung cau hoi nhanh nhat ...
                                  </p>
                              </div>
                          </div>
                      </div>
                 {{--      <div class="col-sm-3 col-md-3">
                          <div class="wow fadeInUp" data-wow-delay="0.2s">
                              <div class="box text-center">

                                  <i class="fa fa-check fa-3x circled bg-skin"></i>
                                  <h4 class="h-bold">{{ __('Enjoy it') }}</h4>
                                  <p>
                                     {{ __("Now, you have to go NOwhere, stay at home and we'll bring it to you. ") }} <strong>{{ __('Get well soon!') }}</strong>
                                  </p>
                              </div>
                          </div>
                      </div> --}}
            </div>
          </section>
        </div>
        </a>
      </div>
    </div>

  </div>

</div>
