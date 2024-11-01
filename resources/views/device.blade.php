
@extends('layout.dafault')
@section('main')
<section class="section">

      @if (session("success"))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="js_alert_success">
                  {{session("success")}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
      @endif
      
      <div class="section__container-create">
            <h1 class="section-ttl">LINEアカウント一覧</h1>
            <button type="button" class="btn btn-secondary" id="js_create_device_btn">追加</button>
      </div>
      <div class="section__container-table">
            <table class="table">
            <thead>
                  <tr>
                        <th scope="col">アカウント名</th>
                        <th scope="col">端末名</th>
                        <th scope="col">uid</th>
                        <th scope="col">ファイル名</th>
                        <th scope="col">作成日時</th>
                        <th scope="col">管理</th>
                  </tr>
            </thead>
                  <tbody>
                        <?php foreach($device_info as $device){?>
                              <tr>
                                    <td><?= $device["account_name"]?></td>
                                    <td><?= $device["device_name"]?></td>
                                    <td><?= $device["uid"]?></td>
                                    <td><?= $device["file_name"]?></td>
                                    <td><?= $device["created_at"]?></td>
                                    <td class="operation">
                                          <button class="operation_icon edit_icon js_device_edit_btn" data-id="<?= $device["id"]?>"><img src="{{asset("img/icons8-edit-24.png")}}" alt="" ></button>
                                          {{-- <form action="{{ route('device.destroy', $device['id']) }}" method="post">
                                                @csrf --}}
                                                <button type="submit" class="operation_icon delete_icon js_delete_btn" data-id="<?= $device["id"]?>"><img src="{{asset("img/icons8-delete-24.png")}}" alt=""></button>      
                                          {{-- </form> --}}
                                          <a href="{{route("device.show", $device["id"])}}"><button class="operation_icon detail_icon" data-id="<?= $device["id"]?>"><img src="{{asset("img/icons8-link-24.png")}}" alt="" ></button></a>
                                          
                                    </td>
                              </tr>
                        <?php }?>
                        

                  </tbody>
            </table>
      </div>
</section>

{{-- 編集モーダル --}}
<section class="modal__container js_edit_modal js_modal hidden">
      <h3 class="modal__container-ttl">編集</h3>
      @if ($errors->any())
      <div class="alert alert-danger alert_danger_container js_alert_danger" role="alert">
            <ul>
                  @foreach ($errors->all() as $error)
                        <li class="alert_danger">{{$error}}</li>
                  @endforeach  
            </ul>   
      </div>  
      @endif
      <form action="{{ route('device.update', ['id' => ':id']) }}" method="post" id="js_edit_device_form">
            @csrf
            <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">アカウント名</label>
                  <input type="text" class="form-control js_device_account_input" id="formGroupExampleInput" name="account_name" value="{{old("account_name")}}">
            </div>
            <div class="mb-3">
                  <label for="formGroupExampleInput2" class="form-label">端末名</label>
                  <input type="text" class="form-control js_device_name_input" id="formGroupExampleInput2" name="device_name" value="{{old("device_name")}}">
            </div>
            <div class="mb-3">
                  <label for="formGroupExampleInput2" class="form-label">uid</label>
                  <input type="text" class="form-control js_device_uid_input" id="formGroupExampleInput2" name="uid" value="{{old("uid")}}">
            </div>
            <div class="mb-3">
                  <label for="formGroupExampleInput2" class="form-label">ファイル名</label>
                  <input type="text" class="form-control js_device_file_input" id="formGroupExampleInput2" name="file_name" value="{{old("file_name")}}" disabled>
            </div>
            <input type="hidden" name="device_id" class="js_device_id_input" value="{{old("device_id")}}">
            <button type="submit" class="modal__container-btn">更新</button>
      </form>
</section>

{{-- 追加モーダル --}}
<section class="modal__container js_create_modal js_modal  hidden">
      <h3 class="modal__container-ttl">追加</h3>
      @if ($errors->any())
      <div class="alert alert-danger alert_danger_container js_alert_danger" role="alert">
            <ul>
                  @foreach ($errors->all() as $error)
                        <li class="alert_danger">{{$error}}</li>
                  @endforeach  
            </ul>   
      </div>  
      @endif
      <form action="{{ route('device.store')}}" method="post" id="js_edit_device_form">
            @csrf
            <div class="mb-3">
                  <label for="formGroupExampleInput" class="form-label">アカウント名</label>
                  <input type="text" class="form-control js_device_account_input" id="formGroupExampleInput" name="account_name" value="{{old("account_name")}}">
            </div>
            <div class="mb-3">
                  <label for="formGroupExampleInput2" class="form-label">端末名</label>
                  <input type="text" class="form-control js_device_name_input" id="formGroupExampleInput2" name="device_name" value="{{old("device_name")}}">
            </div>
            <div class="mb-3">
                  <label for="formGroupExampleInput2" class="form-label">uid</label>
                  <input type="text" class="form-control js_device_uid_input" id="formGroupExampleInput2" name="uid" value="{{old("uid")}}">
            </div>
            <div class="mb-3">
                  <label for="formGroupExampleInput2" class="form-label">ファイル名</label>
                  <input type="text" class="form-control js_device_file_input" id="formGroupExampleInput2" name="file_name" value="{{old("file_name")}}" >
            </div>
            <input type="hidden" value="create" >

            <button type="submit" class="modal__container-btn">追加</button>
      </form>
</section>


{{-- 削除確認モーダル --}}
<section class="modal__container js_delete_modal js_modal hidden">
      <h3 class="modal__container-ttl" style="color: red; font-weight: bold;">本当に削除してもよろしいですか？</h3>
      <p>このデータを削除すると、関連する全てのデータも削除されます。この操作は取り消せません。削除してよろしいですか？</p>
      <div class="btn_confirm_container">
            <div class="confirm_btn cancel_btn js_cancel_btn">キャンセル</div>
            <form action="{{ route('device.destroy', ['id' => ':id']) }}" method="post"class="confirm_btn delete_btn" id="js_delete_form">
                  @csrf
                  <button type="submit">削除</button>
            </form>
      </div>

</section>
@endsection
@section('script')
      <script src="{{ mix('js/device.js') }}"></script>
      @if ($errors->any())
      @php
            $currentRoute =session('route_name');
            print_r($currentRoute);
      @endphp


            @if ($currentRoute === 'device.edit')
                  <script>
                        document.querySelector(".js_edit_modal").classList.remove("hidden")
                        document.querySelector(".bg").classList.remove("hidden")

                        let form = document.getElementById('js_edit_device_form');
                        let action = form.getAttribute('action');
                        action = action.replace(':id', document.querySelector(".js_device_id_input").value);
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