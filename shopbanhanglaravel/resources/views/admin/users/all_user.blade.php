@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
  <header class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
    DANH SÁCH QUẢN TRỊ VIÊN
  </header>
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
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên user</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>Author</th>
            <th>Admin</th>
            <th>User</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $i = 0; 
            ?>
          @foreach($admin as $key => $user)
          <?php
          $i++; 
          ?>
            <form action="{{url('/assign-roles')}}" method="POST">
              @csrf
              <tr>
                <td><i>{{$i}}</i></label></td>
                <td>{{ $user->admin_name }}</td>
                <td>
                    {{ $user->admin_email }} 
                    <input type="hidden" name="admin_email" value="{{ $user->admin_email }}">
                    <input type="hidden" name="admin_id" value="{{ $user->admin_id }}">
                </td>
                <td>{{ $user->admin_phone }}</td>
                <td>{{ $user->admin_password }}</td>
                
                <td><input type="checkbox" name="author_role" {{$user->hasRole('author') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="admin_role"  {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="user_role"  {{$user->hasRole('user') ? 'checked' : ''}}></td>
                <td>
                    <input type="submit" value="Cập Nhật" class="btn btn-sm btn-default">
                </td> 
                <td>
                    <a class="btn btn-danger btn-sm" href="{{url('/delete-user-roles/'.$user->admin_id)}}">Xóa User</a>
                </td> 
              </tr>
            </form>
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
            {!!$admin->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection