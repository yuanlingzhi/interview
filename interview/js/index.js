$(function() {
	
    var height=$("#sign-wrap").css("height");
    var bh=$(window).height();
    height=height.substr(0,height.length-2);
    if(height<bh&&bh>600){
        $("#sign-wrap").first().css({height:(bh-246)+"px"});
    }
	
	$(window).resize(function(){
	    var height=$("#sign-wrap").css("height");
	    var bh=$(window).height();
	    height=height.substr(0,height.length-2);
	    if(height<bh&&bh>600){
	        $("#sign-wrap").first().css({height:(bh-246)+"px"});
	    } 
	    });
	
    var dialog, form,
 
      name = $( "#name1" ),
      password = $( "#password1" ),
      allFields = $( [] ).add( name ).add( password ),
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
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
 
    function signinUser() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
 
      valid = valid && checkLength( name, "username", 3, 15 );
      valid = valid && checkLength( password, "password", 6, 20 );
 
      valid = valid && checkRegexp( name, /[a-zA-Z0-9_]/i, "user name should be 3 to 15 characters which consists of alphabet letters, numerals and/or underlines." );
      valid = valid && checkRegexp( password, /[a-zA-Z0-9]/, "password should be 6 to 20 characters which consists of alphabet letters and/or numerals" );
 
      if ( valid ) {
        $.ajax({
	    	   type: "POST",
	    	   url: "./controller/signinContr2.php",
	    	   data: {name:name.val(),pwd:password.val()},
	    	   success: function(msg){
	    	          if(msg==1){
	    	        	  dialog.dialog( "close" );
                          window.location.href="./search.html"; 
	    	          }else{
	    	        	  updateTips( "username password doesn't match" );

                           }
	    	   }
	    	});

      }
      return valid;
    }
 
    dialog = $( "#dialog-form1" ).dialog({
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
        "Sign in":signinUser,
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
      signinUser();
    });
 
    $( "#signin-user" ).click(function() {
      updateTips( "All form fields are required." );
      dialog.dialog( "open" );
    });
    
      var dialog2, form2,
 
      name2 = $( "#name2" ),
      allFields = $( [] ).add( name2 );
 
    function createUser() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
 
      valid = valid && checkLength( name2, "username", 3, 15 );
 
      valid = valid && checkRegexp( name2, /[a-zA-Z0-9_]/i, "user name should be 3 to 15 characters which consists of alphabet letters, numerals and/or underlines." );
      
      
      if ( valid ) {     
          $.post("./controller/fbSignupCtrl.php", {user:name2.val()}, function(data){
          if(data=="success") {
              dialog2.dialog("close");
              window.location.href="./search.html";   
          }
          else updateTips(data);
      }, "text");
      }
      return valid;
    }
 
    dialog2 = $( "#dialog-form2" ).dialog({
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
        "Create": createUser,
        Cancel: function() {
          dialog2.dialog( "close" );
        }
      },
      close: function() {
        form2[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form2 = dialog2.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      createUser();
    });

    
      var dialog3, form3,
 
      name3 = $( "#name3" ),
      email3 = $("#email3"),
      password3 = $("#password3"),
      password4 = $("#password4"),
      allFields = $( [] ).add( name2 ).add(email3).add(password3).add(password4);
    
    function comparePassword(p1,p2){
        if (  p1.val()!=p2.val()  ) {
            p2.addClass( "ui-state-error" );
            updateTips( "wrong password" );
            return false;
          } else {
            return true;
          }
    }
      
    function findPassword() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
 
      valid = valid && checkLength( name3, "username", 3, 15 );
      valid = valid && checkLength( password3, "password", 3, 15 );
      
      valid = valid && checkRegexp( name3, /[a-zA-Z0-9_]/i, "user name should be 3 to 15 characters which consists of alphabet letters, numerals and/or underlines." );
      valid = valid && checkRegexp( email3, /[a-zA-Z0-9_.-]{3,}@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+/i, "email format: example@example.com." );
      valid = valid && checkRegexp( password3, /[a-zA-Z0-9]/i, "password should be 6 to 20 characters which consists of alphabet letters and/or numerals" );
      
      valid = valid && comparePassword(password3,password4);
      
      if(valid){
      
	      $.ajax({
	    	   type: "POST",
	    	   url: "./controller/findPasswordContr.php",
	    	   data: {name:name3.val(),email:email3.val(),password1:password3.val(),password2:password4.val()},
	    	   success: function(msg){
	
	    	         //if return -1      failed
	    	          if(msg==-1){
	    	        	  updateTips( "username and email doesn't match" );
	    	          }else{
	    	              updateTips( "operation succeed, window will close in 3 seconds..." );
	    	        	  setTimeout(function(){
	    	        		  dialog3.dialog( "close" );
	    	        	  },3000);    	        	 
	    	        	 
	    	          }
	    	          
	    	   }
	    	});
      }
      
      return valid;
    }
 
    dialog3 = $( "#dialog-form3" ).dialog({
      autoOpen: false,
      height: 330,
      width: 260,
      modal: true,
        resizable:false,
        open: function(event, ui) {
        $(event.target).dialog('widget')
            .css({ position: 'fixed' })
            .position({ my: 'center', at: 'center', of: window });
    },
      buttons: {
        "Submit": findPassword,
        Cancel: function() {
          dialog3.dialog( "close" );
        }
      },
      close: function() {
        form3[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form3 = dialog3.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      var valid=findPassword();                 
          
    });
       
    $( ".fp" ).click(function() {
      updateTips( "All form fields are required." );
      dialog3.dialog( "open" );
    });
    
    //fb
    $.ajaxSetup({ cache: true });
    $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
      FB.init({
        appId      : '903846879636197',
        cookie     : true,
        xfbml      : true,
        version    : 'v2.3'
      });  
        FB.Event.subscribe('auth.login', function(){
            FB.api('/me', function(response){
                if(response.id!="undefined")
                {
                    $.post("./controller/fbSignupCtrl.php", {id:response.id}, function(data){
                        updateTips( "please pick a username." );
                        if(data=="false") dialog2.dialog("open");
                        if(data=="success") window.location.href="./search.html";
                    }, "text");
                }
            });
        });
     FB.getLoginStatus(function(response) {
         if (response.status === 'connected') {
              $.post("./controller/fbSignupCtrl.php", {id:response.authResponse.accessToken.userID}, function(data){
                        updateTips( "please pick a username." );
                        if(data=="false") dialog2.dialog("open");
                        if(data=="success") window.location.href="./search.html";
                    }, "text");
        } else if (response.status === 'not_authorized') {
        } else {
        }
      });
    });
    

    $("#fbbtn").button().on( "click", function() {
         FB.getLoginStatus(function(response) {
             if (response.status === 'connected') {
                  $.post("./controller/fbSignupCtrl.php", {id:response.authResponse.userID}, function(data){
                            updateTips( "please pick a username." );
                            if(data=="false") dialog2.dialog("open");
                            if(data=="success") window.location.href="./search.html";
                        }, "text");
            } else {
                FB.login(function(response) {
                    if (response.authResponse) {
                     FB.Event.subscribe('auth.login', function(){
                            FB.api('/me', function(response){
                                if(response.id!="undefined")
                                {
                                    $.post("./controller/fbSignupCtrl.php", {id:response.id}, function(data){
                                        updateTips( "please pick a username." );
                                        if(data=="false") dialog2.dialog("open");
                                        if(data=="success") window.location.href="./search.html";
                                    }, "text");
                                }
                            });
                        });
                    } 
                });
            }
      });

    });
    
    
    
    //below is for changing the style of sign up (invaliad input)
    
        $("#pwdcfm").blur(function(){
        var pwd=$("#signup-pwd").val();
        var cfmpwd=$("#pwdcfm").val();
        if(pwd!=cfmpwd && cfmpwd)
            $("#pwdcfm").addClass("wrongType");
        else
            $("#pwdcfm").removeClass("wrongType");
    });
    $("#signup-username").blur(function(){
        var pat=/[a-zA-Z0-9_]{3,15}/;
        var signup_usrname=$("#signup-username").val();
        if(signup_usrname && !pat.test(signup_usrname))
            $("#signup-username").addClass("wrongType");
        else
            $("#signup-username").removeClass("wrongType");
    });
    $("#signup-email").blur(function(){
        var pat=/[a-zA-Z0-9_.-]{3,}@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+/;
        var signup_email=$("#signup-email").val();
        if(signup_email && !pat.test(signup_email))
            $("#signup-email").addClass("wrongType");
        else
            $("#signup-email").removeClass("wrongType");
    });
    $("#signup-pwd").blur(function(){
        var pat=/[a-zA-Z0-9]{6,20}/;
        var signup_pwd=$("#signup-pwd").val();
        if(signup_pwd && !pat.test(signup_pwd))
            $("#signup-pwd").addClass("wrongType");
        else
            $("#signup-pwd").removeClass("wrongType");
    });
    
    $("#signup-check").submit(function(event){
        var pwd=$("#signup-pwd").val();
        var cfmpwd=$("#pwdcfm").val();
        if(pwd!=cfmpwd && cfmpwd)
        {
            $("#pwdcfm").addClass("wrongType");
            event.preventDefault();
        }
        else
            $("#pwdcfm").removeClass("wrongType");
    });
    
  });
