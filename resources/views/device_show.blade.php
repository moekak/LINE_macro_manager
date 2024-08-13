@extends('layout.dafault')
@section('main')
      <section class="section__detail">
            @if (session("success"))
                  <div class="alert alert-success alert-dismissible fade show" role="alert" id="js_alert_success">
                        {{session("success")}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>     
            @endif
            <div class="section__detail-area">
                  <div class="section__detail-area-top">
                        <div class="section__detail-table">
                              <h3>URL</h3>
                             <table class="table">
                                    <thead>
                                          <tr>
                                                <th scope="col">URL</th>
                                                <th scope="col">作成日時</th>
                                                <th scope="col">更新日時</th>
                                                <th scope="col">管理</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <tr>
                                                @foreach ($url as $url)
                                                      <td><?= $url["url"]?></td>
                                                      <td><?= $url["created_at"]?></td>
                                                      <td><?= $url["updated_at"]?></td>
                                                      <td class="operation">
                                                            <button class="operation_icon edit_icon js_url_edit_btn" data-id="<?= $url["id"]?>"><img src="{{asset("img/icons8-edit-24.png")}}" alt="" ></button>
                                                            <form action="" method="post">
                                                                  @csrf
                                                                  <button type="submit" class="operation_icon delete_icon" data-id="<?= $url["id"]?>"><img src="{{asset("img/icons8-delete-24.png")}}" alt=""></button>      
                                                            </form>
                                                      </td>
                                                @endforeach        
                                          </tr>
                                    </tbody>
                              </table> 
                        </div>
                        <div class="section__detail-table">
                              <h3>自動返信</h3>
                              <table class="table">
                                    <thead>
                                          <tr>
                                                <th scope="col">メッセージ</th>
                                                <th scope="col">作成日時</th>
                                                <th scope="col">更新日時</th>
                                                <th scope="col">管理</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <tr>
                                                @foreach ($registration_msg as $msg)
                                                     <td><?= $msg["message"]?></td>
                                                      <td><?= $msg["created_at"]?></td>
                                                      <td><?= $msg["updated_at"]?></td>
                                                      <td class="operation">
                                                            <button class="operation_icon edit_icon js_device_edit_btn" data-id="<?= $msg["id"]?>"><img src="{{asset("img/icons8-edit-24.png")}}" alt="" ></button>
                                                            <form action="" method="post">
                                                                  @csrf
                                                                  <button type="submit" class="operation_icon delete_icon" data-id="<?= $msg["id"]?>"><img src="{{asset("img/icons8-delete-24.png")}}" alt=""></button>      
                                                            </form>
                                                      </td>
                                                @endforeach

                                               
                                          </tr>

                                    </tbody>
                              </table> 
                        </div>
                        <div class="section__detail-table">
                              <h3>一斉配信</h3>
                              <table class="table">
                                    <thead>
                                          <tr>
                                                <th scope="col">URL</th>
                                                <th scope="col">作成日時</th>
                                                <th scope="col">更新日時</th>
                                                <th scope="col">管理</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                           
                                          @foreach ($group_msg as $msg)
            
                                          <tr>
                                                <td><?= $msg["message"]?></td>
                                                <td><?= $msg["created_at"]?></td>
                                                <td><?= $msg["updated_at"]?></td>
                                                <td class="operation">
                                                      <button class="operation_icon edit_icon js_device_edit_btn" ><img src="{{asset("img/icons8-edit-24.png")}}" alt="" ></button>
                                                      <form action="" method="post">
                                                            @csrf
                                                            <button type="submit" class="operation_icon delete_icon" ><img src="{{asset("img/icons8-delete-24.png")}}" alt=""></button>      
                                                      </form>
                                                </td> 
                                          </tr>
                                          @endforeach
                                    </tbody>
                              </table> 
                        </div>
                        
                        
                  </div>

            </div>
      </section>
      {{-- URL編集モーダル --}}
      <section class="modal__container js_url_edit_modal js_modal hidden">
            <h3 class="modal__container-ttl">URL編集</h3>
            @if ($errors->any())
            <div class="alert alert-danger alert_danger_container js_alert_danger" role="alert">
                  <ul>
                  @foreach ($errors->all() as $error)
                        <li class="alert_danger">{{$error}}</li>
                        @endforeach  
                  </ul>   
            </div>  
            @endif
            <form action="{{ route('url.update', ['id' => ':id']) }}" method="post" id="js_edit_url_form">
                  @csrf
                  <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">URL</label>
                        <input type="text" class="form-control js_url_account_input" id="formGroupExampleInput" name="url" value="{{old("url")}}">
                  </div>
                  <input type="hidden" name="url_id" class="js_url_id_input" value="{{old("url_id")}}">
                  <button type="submit" class="modal__container-btn">更新</button>
            </form>
      </section>
    
@endsection
@section('script')
<script src="{{ mix('js/device_show.js') }}"></script>

@if ($errors->any())
@php
      $currentRoute =session('route_name');
      print_r($currentRoute);
@endphp


      @if ($currentRoute === 'url.edit')
            <script>
                  document.querySelector(".js_url_edit_modal").classList.remove("hidden")
                  document.querySelector(".bg").classList.remove("hidden")

                  let form = document.getElementById('js_edit_url_form');
                  let action = form.getAttribute('action');
                  action = action.replace(':id', document.querySelector(".js_url_id_input").value);
                  form.setAttribute('action', action)
            </script>
            
            
      @elseif ($currentRoute === 'device.store')
            <script>
                  console.log("222");
                  document.querySelector(".js_create_modal").classList.remove("hidden")
                  document.querySelector(".bg").classList.remove("hidden")
            </script>  
      @endif

@endif

    
@endsection