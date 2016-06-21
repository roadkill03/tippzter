$(document).ready(function(){
	
	//click on class link in index.php
	//MODAL call
	$('.link').click(function(e) {
	    // make sure we ignore the browsers default behaviour when clicking an <a>-element
	    e.preventDefault();
	   
	    // get url from clicked link
	    var url = $(this).attr('href');
	   
	    // make an ajax request to load the new content
	    $.ajax({
			'url':url,
			'type':'GET',
			'dataType':'html',
			'cache':false,

			//when we got the url do this
			'success': function(result) {

				// change the contets of my modal (with id #myModal and find .modal-content to enter content)
				$('#myModal').find('.modal-content').html( result );

				//show the modal
				$('#myModal').modal('show');
			}      
	    });
  	});
});