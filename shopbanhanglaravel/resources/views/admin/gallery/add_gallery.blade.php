@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading" style="font-size: 1.4rem; font-weight: 700; margin:0 10px;">
                            Thêm Thư Viện Ảnh
                        </header>
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
                                <form action="{{url('/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- <label style="margin: 0 412px;">Thêm Ảnh Tại Đây</label> -->
                                    <div class="row">
                                        <div class="col-md-3"  align="right">

                                        </div>
                                        <div class="col-md-6" style="margin: 10px -406px;">
                                            <input type="file" id="file" class="form-control" name="file[]" accept="image/*" multiple>
                                            <span id="error_gallery"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <input style="margin: 10px 300px;" type="submit" name="upload" value="Tải Ảnh" class="btn btn-success">
                                        </div>
                                    </div>
                                </form>
                                <div class="pannel-body">
                                    <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                                    <form>
                                        @csrf
                                        <div id="gallery_load">
                                        
                                        </div>
                                    </form>
                                </div>
                    </section>
            </div>  
<script>
	$(document).ready(function(){
		load_gallery();
		function load_gallery(){
			var pro_id = $('.pro_id').val();
			var _token = $('input[name = "_token"]').val();
			$.ajax({
				url: "{{url('/select-gallery')}}",
				method: 'POST',
				data: {pro_id:pro_id, _token:_token},
				success:function(data){
					$('#gallery_load').html(data);
				}
			});
		}
		$('#file').change(function(){
			var error = '';
			var files = $('#file')[0].files;
			if(files.length > 5){
				error += '<p>Tối đa chỉ được 5 ảnh!!!</p>'
			}else if(files.length == ''){
				error += '<p>Vui Lòng Thêm Ảnh!!!</p>'
			}else if(files.size > 2000000){
				error += '<p>File ảnh quá lớn</p>'
			}
			if(error == ''){

			}else{
				$('#file').val('');
				$('#error_gallery').html('<span class="text-danger">'+error+'</span>')
                $('#error_gallery').fadeOut(3000);
			}
		});

		$(document).on('click', '.delete-gallery', function(){
			var gal_id = $(this).data('gal_id');
			var _token = $('input[name = "_token"]').val();
			if(confirm('Xác nhận xóa!!!')){
				$.ajax({
					url: "{{url('/delete-gallery')}}",
					method: 'POST',
					data: {gal_id:gal_id,_token:_token},
					success:function(data){
						load_gallery();
						$('#error_gallery').html('<span class="text-danger">Xóa Thành Công</span>')
					}
				});
				alert('okeee')
			}
		});
	});
</script>
@endsection
