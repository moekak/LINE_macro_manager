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
                                                <th scope="col" style="width: 420px">URL</th>
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
                                                <th scope="col" style="width: 420px">メッセージ</th>
                                                <th scope="col">作成日時</th>
                                                <th scope="col">更新日時</th>
                                                <th scope="col">管理</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <tr>
                                                @foreach ($registration_msg as $msg)
                                                     <td><textarea name="" id="" class="msg_textarea"><?= $msg["message"]?></textarea></td>
                                                      <td><?= $msg["created_at"]?></td>
                                                      <td><?= $msg["updated_at"]?></td>
                                                      <td class="operation2">
                                                            <button class="operation_icon edit_icon js_message_edit_btn" data-id="<?= $msg["id"]?>"><img src="{{asset("img/icons8-edit-24.png")}}" alt="" ></button>
                                                            
                                                      </td>
                                                @endforeach

                                               
                                          </tr>

                                    </tbody>
                              </table> 
                        </div>
                        <div class="section__detail-table">
                              <div class="section__detail-table-top">
                                   <h3>一斉配信</h3> 
                                   <button type="button" class="btn btn-secondary" id="js_create_group_message_btn">追加</button>
                              </div>
                              
                              <table class="table">
                                    <thead>
                                          <tr>
                                                <th scope="col" style="width: 420px">メッセージ</th>
                                                <th scope="col">作成日時</th>
                                                <th scope="col">更新日時</th>
                                                <th scope="col">管理</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                           
                                          @foreach ($group_msg as $msg)
            
                                          <tr>
                                                <td><textarea name="" id="" class="msg_textarea"><?= $msg["message"]?></textarea></td>
                                                <td><?= $msg["created_at"]?></td>
                                                <td><?= $msg["updated_at"]?></td>
                                                <td class="operation2">
                                                      <button class="operation_icon edit_icon js_group_message_edit_btn" data-id="<?= $msg["id"]?>"><img src="{{asset("img/icons8-edit-24.png")}}" alt="" ></button>
                                                      <form action="{{route('group_message.destroy', ['id' => $msg['id']])}}" method="post">
                                                            @csrf
                                                            @method("DELETE")
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
      {{-- 自動返信編集モーダル --}}
      <section class="modal__container js_message_edit_modal js_modal hidden">
            <h3 class="modal__container-ttl">自動返信メッセージ編集</h3>
            @if ($errors->any())
            <div class="alert alert-danger alert_danger_container js_alert_danger" role="alert">
                  <ul>
                  @foreach ($errors->all() as $error)
                        <li class="alert_danger">{{$error}}</li>
                        @endforeach  
                  </ul>   
            </div>  
            @endif
            <form action="{{ route('message.update', ['id' => ':id']) }}" method="post" id="js_edit_message_form">
                  @csrf
                  <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">メッセージ</label>
                        <textarea class="form-control js_message_input" id="exampleFormControlTextarea1" rows="3" name="message">{{old("message")}}</textarea>
                      </div>
                  {{-- <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">メッセージ</label>
                        <input type="text" class="form-control js_message_input" id="formGroupExampleInput" name="message" value="{{old("message")}}">
                  </div> --}}
                  <input type="hidden" name="message_id" class="js_message_id_input" value="{{old("message_id")}}">
                  <button type="submit" class="modal__container-btn">更新</button>
            </form>
      </section>
      {{-- 一斉送信編集モーダル --}}
      <section class="modal__container js_group_message_edit_modal js_modal hidden">
            <h3 class="modal__container-ttl">一斉送信メッセージ編集</h3>
            @if ($errors->any())
            <div class="alert alert-danger alert_danger_container js_alert_danger" role="alert">
                  <ul>
                  @foreach ($errors->all() as $error)
                        <li class="alert_danger">{{$error}}</li>
                        @endforeach  
                  </ul>   
            </div>  
            @endif
            <form action="{{ route('group_message.update', ['id' => ':id']) }}" method="post" id="js_edit_group_message_form">
                  @csrf
                  <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">メッセージ</label>
                        <textarea class="form-control js_group_message_input" id="exampleFormControlTextarea1" rows="3" name="group_message">{{old("group_message")}}</textarea>
                      </div>
                  <input type="hidden" name="group_message_id" class="js_group_message_id_input" value="{{old("group_message_id")}}">
                  <button type="submit" class="modal__container-btn">更新</button>
            </form>
      </section>
      {{-- 一斉送信追加モーダル --}}
      <section class="modal__container js_group_message_create_modal js_modal hidden">
            <h3 class="modal__container-ttl">一斉送信メッセージ追加</h3>
            @if ($errors->any())
            <div class="alert alert-danger alert_danger_container js_alert_danger" role="alert">
                  <ul>
                  @foreach ($errors->all() as $error)
                        <li class="alert_danger">{{$error}}</li>
                        @endforeach  
                  </ul>   
            </div>  
            @endif
            <form action="{{ route("group_message.store")}}" method="post" id="js_create_group_message_form">
                  @csrf
                  <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">メッセージ</label>
                        <textarea class="form-control js_group_message_input" id="exampleFormControlTextarea1" rows="3" name="group_message">{{old("group_message")}}</textarea>
                      </div>
                      <input type="hidden" name="device_id" value="{{request()->route('id')}}" >
                  <button type="submit" class="modal__container-btn">追加</button>
            </form>
      </section>
    
@endsection
@section('script')
<script src="{{ mix('js/device_show.js') }}"></script>

@if ($errors->any())
@php
      $currentRoute =session('route_name');

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
            
            
      @elseif ($currentRoute === 'message.edit')
            <script>
                  document.querySelector(".js_message_edit_modal").classList.remove("hidden")
                  document.querySelector(".bg").classList.remove("hidden")

                  let form = document.getElementById('js_edit_message_form');
                  let action = form.getAttribute('action');
                  action = action.replace(':id', document.querySelector(".js_message_id_input").value);
                  form.setAttribute('action', action)
            </script>  
      @elseif ($currentRoute === 'group_message.edit')
            <script>
                  document.querySelector(".js_group_message_edit_modal").classList.remove("hidden")
                  document.querySelector(".bg").classList.remove("hidden")

                  let form = document.getElementById('js_edit_group_message_form');
                  let action = form.getAttribute('action');
                  action = action.replace(':id', document.querySelector(".js_group_message_id_input").value);
                  form.setAttribute('action', action)

                  console.log(document.querySelector(".js_group_message_id_input").value);
            </script>   
      @endif

@endif

    
@endsection