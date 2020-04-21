<div id="article-votes" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
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
      	 		<input type="hidden" class="data_action" name="data_action" value="vote_edit">
      	 		<input type="hidden" class="vote-article-id" name="vote_article_id" value="">
      	 		<div class="container">
      	 			<div class="row">
	      	 			<div class="col-md-4">
	      	 				<div class="form-group">
	      	 					<label class="control-label">Article Title</label>
	      	 					<input type="text" class="form-control vote-article-title" name="vote_article_title" value="">
	      	 				</div>
	      	 			</div>
      	 			</div>
      	 			<div class="row">
	      	 			<div class="col-md-4">
	      	 				<div class="form-group">
	      	 					<label class="control-label">Article Content</label>
	      	 					<input type="text" class="form-control vote-article-content" name="vote_article_content" value="">
	      	 				</div>
	      	 			</div>
	      	 		</div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Created Date</label>
                    <input type="text" class="form-control vote-date" name="vote_date" value="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">No of Votes</label>
                    <input type="text" class="form-control num_of_vote" name="num_of_vote" value="">
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