@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh Sách Quyền
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
    <?php
      use Illuminate\Contracts\Session\Session;
      $message = session()->get('message');
      if($message){
      echo '<div id="toast">
              <div class="toast toast--success">
                      <div class="toast__icon">
                        <i class="fas fa-check-circle"></i>
                      </div>
                      <div class="toast__body">
                        <h3 class="toast__title">Thành Công</h3>
                        <p class="toast__msg">',$message,'</p>
                      </div> 
            </div>
          </div>';
      session()->put('message', null);
      }
      ?>
      <form action="{{URL::to('/add-role')}}" method="post">
        @csrf
        <div class="form-group" style="margin: 0 20px;">
            <label for="exampleInputEmail1">Tên Quyền</label>
            <input style="width: 300px;" type="text" name="name" class="form-control" 
                id="exampleInputEmail1" placeholder="Tên Quyền..." required>
        <div>
        <div class="form-group" style="margin: 10px 0px;">
            <label for="exampleInputEmail1">Mô Tả Quyền</label>
            <input style="width: 300px;" type="text" name="role_desc" class="form-control" 
                id="exampleInputEmail1" placeholder="Tên Quyền..." required>
        <div>
            <button style="margin: 10px 0px;" type="submit" name="add_role" class="btn btn-info">Thêm Quyền</button>
      </form>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên Quyền</th>
            <th>Mô Tả Tên Quyền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $i = 0; 
            ?>
          @foreach($role as $key => $val)
          <?php
          $i++; 
          ?>
              <tr>
                <td><i>{{$i}}</i></label></td>
                <td>{{ $val->name }}</td>
                <td>{{ $val->role_desc }}</td>
                <td>
                    <a class="btn btn-danger btn-sm" href="{{url('/delete-roles/'.$val->id_roles )}}">Xóa Quyền</a>
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {!!$role->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection