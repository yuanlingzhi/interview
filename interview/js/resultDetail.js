$(function() { 

    $(document).on("click", ".btnlike", function() {
        
    });
    $(document).on("click", ".btndislike", function() {
        
    });
    
    var dialog, form,
 
      anstext = $( "#anstext" ),
      allFields = $( [] ).add( anstext ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function ansQues() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
      
      var content=$("#anstext").val();
      var q_id=$(".qidhide").text();
      
      valid = valid && checkLength( anstext, "answer", 1, 2000 );
      if ( valid ) {
    	  
          //use ajax to submit the information to the controller
          $.ajax({
        	   type: "POST",
        	   url: "./controller/answerContr.php",
        	   data: {"q_id":q_id,"content":content},
        	   success: function(data){
        		   if(data==-1)
        			   alert("Server down, sorry about that");
        		   else{
        		       dialog.dialog( "close" );
        			   location.reload(); 
        		   }
        	   }
        	});
          //end of ajax submit
 
      }

      return valid;
    }
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 300,
      width: 260,
      modal: true,
        resizable:false,
        open: function(event, ui) {
        $(event.target).dialog('widget')
            .css({ position: 'fixed' })
            .position({ my: 'center', at: 'center', of: window });
    },
      buttons: {
        "Submit": ansQues,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      ansQues();
    });
 
    $( "#answer-btn" ).click(function() {
      dialog.dialog( "open" );
    });

  });
