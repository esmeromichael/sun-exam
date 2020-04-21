<div id="create-article" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      	<div class="modal-header">
      	  <button type="button" class="close" data-dismiss="modal">&times;</button>
      	  <h4 class="modal-title">Create New Article</h4>
      	</div>
      	<div class="modal-body">
      	 	<form id="add_edit_form" method="post">
      	 		<input type="hidden" name="_token" value="{{ csrf_token() }}">
      	 		<input type="hidden" class="data_action" name="data_action" value="add">
      	 		<input type="hidden" class="article-id" name="article_id" value="">
      	 		<div class="container">
      	 			<div class="row">
	      	 			<div class="col-md-4">
	      	 				<div class="form-group">
	      	 					<label class="control-label">Article Title</label>
	      	 					<input type="text" class="form-control article-title" name="article_title" value="">
	      	 				</div>
	      	 			</div>
      	 			</div>
      	 			<div class="row">
	      	 			<div class="col-md-4">
	      	 				<div class="form-group">
	      	 					<label class="control-label">Article Content</label>
	      	 					<input type="text" class="form-control article-content" name="article_content" value="">
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