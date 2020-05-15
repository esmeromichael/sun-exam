<div id="create-register" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      	<div class="modal-header">
      	  <button type="button" class="close" data-dismiss="modal">&times;</button>
      	  <h4 class="modal-title">Register</h4>
      	</div>
      	<div class="modal-body">
      	 	<form id="add_edit_form" method="post">
      	 		<input type="hidden" name="_token" value="{{ csrf_token() }}">
      	 		<input type="hidden" class="data_action" name="data_action" value="add">
      	 		<input type="hidden" class="user-id" name="article_id" value="">
      	 		<div class="container">
      	 			<div class="row">
	      	 			<div class="col-md-4">
	      	 				<div class="form-group">
	      	 					<label class="control-label">Name</label>
	      	 					<input type="text" class="form-control name" name="name" value="">
	      	 				</div>
	      	 			</div>
      	 			</div>
      	 			<div class="row">
	      	 			<div class="col-md-4">
	      	 				<div class="form-group">
	      	 					<label class="control-label">Email Address</label>
	      	 					<input type="email" class="form-control email" name="email" value="">
	      	 				</div>
	      	 			</div>
	      	 		</div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="text" class="form-control password" name="password" value="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Repeat Password</label>
                    <input type="text" class="form-control repeat-password" name="repeat_password" value="">
                  </div>
                </div>
                
              </div>

              <div class="row">
                <div class="col-md-4">
                    <label class="control-label password-text"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Terms and Condition</label>
                    <input type="checkbox" class="terms" name="terms" value="">
                  </div>
                </div>
              </div>

      	 		</div>
      	 	</form>
      	</div>
      	<div class="modal-footer">
      	  <button type="button" class="btn btn-default post-btn">Post</button>
      	</div>
    </div>

  </div>
</div>