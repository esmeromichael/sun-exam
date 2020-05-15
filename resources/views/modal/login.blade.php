<div id="login" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      	<div class="modal-header">
      	  <button type="button" class="close" data-dismiss="modal">&times;</button>
      	  <h4 class="modal-title">Login</h4>
      	</div>
      	<div class="modal-body">
      	 	<form id="login_form" method="post">
      	 		<input type="hidden" name="_token" value="{{ csrf_token() }}">
      	 		<input type="hidden" class="data_action" name="data_action" value="add">
      	 		<input type="hidden" class="user-id" name="article_id" value="">
      	 		<div class="container">
      	 			
      	 			<div class="row">
	      	 			<div class="col-md-4">
	      	 				<div class="form-group">
	      	 					<label class="control-label">Email Address</label>
	      	 					<input type="email" class="form-control logemail" name="email" value="">
	      	 				</div>
	      	 			</div>
	      	 		</div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="text" class="form-control logpassword" name="password" value="">
                  </div>
                </div>
              </div>
      	 		</div>
      	 	</form>
      	</div>
      	<div class="modal-footer">
      	  <button type="button" class="btn btn-default loginbtn">Login</button>
      	</div>
    </div>

  </div>
</div>