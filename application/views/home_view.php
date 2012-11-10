<div class = "container">
<div class="row">
<div class="span3">
	<div id="lr_subject_list" class="row" style="float:left;">
			<!--<a id="lr_user_subscriptions" class="btn dropdown-toggle" data-toggle="dropdown" href="#" role="button">My Subjects <span class="caret"></span></a>-->
			<ul class="nav nav-pills nav-stacked" role="menu" aria-labelledby="dLabel">
			<?php
				$i=0;
				$class;
				foreach($subject_list as $subject => $value){
					if($i==0){
						$class='active';
					}else{
						$class='';
					}
					echo '<li id="'.$subject.'" class="lr_subject_list_item '.$class.'"><a href="#">'.$value.'</a></li>';
					$i++;
				}
			?>
			</ul>
		</div>
</div>
<div id="lr_content" class="span8">
	<div style="margin-bottom:10px;">
		<div class="row">
			<!--<a href="#lrAddQuestionForm" role="button" class="btn" data-toggle="modal" id="lr_add_question">Ask a question</a>-->
			<div class="textarea">
					<!--<textarea id="ls_add_question_text"  class="ls_add_question_text" onfocus="if(this.value == 'Got a question?') {this.value=''}" cols="54" onblur="if(this.value == ''){this.value ='Got a question?'}">Got a question?</textarea>-->
					<textarea id="ls_add_question_text" placeholder="Got a question?" style="display:block;"></textarea>
			</div>
			<div class="main-textarea-post">
					<button id="ls_add_question_submit" class="btn btn-primary btn-small" data-loading-text="Posting...">Ask!</button>
			</div>
		</div>
		<div style="clear:both"></div>
		<div class="ls_sub_content row">
			<div id="ls_list_questions" class="ls_list_questions">
				<ul style="margin-left:0px;">
					Loading Questions...
				</ul>
			</div>
		</div>
		<div style="clear:both"></div>
		<div class="modal hide fade" id="lrAddAnswerForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h3 id="myModalLabel">Post an answer</h3>
			</div>
			<div class="modal-body">
				<div class="alert alert-info" id="lr_modal_question_text"></div>
				<textarea id="lr_add_answer_text" class="ls_add_question_text">Write your answer here...</textarea>
			</div>
			<div class="modal-footer form-actions">
				<button id="lr_add_answer_submit" class="btn btn-primary" data-loading-text="Posting..." qid="0">Post</button>
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url();?>js/questions/main_jq.js"></script>
<script type="text/javascript" src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var question = new Question();
    question.init();
    var d = new Date();
    //$('#lrAddQuestionForm').modal({show:false});
});
</script>
