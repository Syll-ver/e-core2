
<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Add College</h4>
</div>
        
        <div class="modal-body"> 
<div class= "container">
      <div class="control-group">

            <div class="controls"> 
 <form class="form-inline" id="myForm" role="form" autocomplete="off" method="post" action="includes/college_add.php">
 <div class="entry input-group">
    <div class="input-group mx-md-6 mb-2 ">
      <label for="collegecode" style="margin-right: 125px">Code</label>
      <input type="text" class="form-control" id="collegecode" name="collegecode[]" placeholder="College Code" required />
    </div>

    <div class="input-group mx-sm-3 mb-2">
      <label for="collegename" style="margin-right: 115px">College Name</label>
      <input type="text" class="form-control" id="collegename" name="collegename[]" placeholder="College Name" required />
    </div>
    
                            <button class="btn btn-success btn-add input-group-btn" type="button" style=" margin-top: 9px; height: 24px">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                     
</div>
</form>
   
         </div>
      </div>
  </div>
</div>
  
  




<div class="modal-footer">
<input class="btn btn-secondary" type="cancel" value="cancel" data-dismiss="modal" />
    <input class="btn btn-primary" type="submit" value="Add" form="myForm" />
        </div>

        <span style="color: white">Ender</span>
        <script>
        $(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.controls form:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('.entry:first').remove();

    e.preventDefault();
    return false;
		
    
    
	});
});
</script>


<!-- CONTENT-WRAPPER SECTION END-->
<!-- FOOTER SECTION END-->
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
