$(document).ready(function(){
	
    $("#searchbtn").click(function(){
    	var info=$("#inpt_search").val();
        if(info=="")
        {
            alert("Empty value! Please type something!");
            return false;
        }
    	var cate=$("#categoryselect option:selected").val();
    	info=info+"-*-"+cate;

    	if(cate=="hide")
    	{
    		alert("please at least choose a category!");
            return false;
    	}
        info=info.replace(/\//g,"");
    	$("#searchaddform").attr("action","./search.html#/search/"+encodeURIComponent(info));
    });
    
    var height=$(".wrap").css("height");
    var bh=$(window).height();
    height=height.substr(0,height.length-2);
    if(bh-height>246){
        $(".wrap").first().css({height:(bh-246)+"px"});
    }

    $(window).resize(function(){
    var height=$(".wrap").css("height");
    var bh=$(window).height();
    height=height.substr(0,height.length-2);
    if(bh-height>246){
        $(".wrap").first().css({height:(bh-246)+"px"});
    }
    });

    $("#addbtn").click(function(){
    	var info=$("#inpt_search").val();
    	var cate=$("#categoryselect option:selected").val();

    	if(info.trim()==""){
    		alert("Please input valid content");
    		return false;
    	}
    	if(cate=="hide"){
    		alert("Please choose a category");
    		return false;
    	}
    	
        $.ajax({
     	   type: "POST",
     	   url: "./service/addquestion_service.php",
     	   data: {"cate":cate,"key":info},
     	   success: function(data){
     		   if(data==-1)
     			   alert("Server down, sorry about that");
     		   else{
     		   }
     	   }
     	});
         
  alert("Operation Succeed! Now you can click search button to see your post.");
        
    });
    
    $("#inpt_search").on('focus', function () {
        $(this).parent('label').addClass('active');
    });

    $("#inpt_search").on('blur', function () {
        if($(this).val().length == 0)
            $(this).parent('label').removeClass('active');
    });        

    $('select').each(function(){
        var $this = $(this), numberOfOptions = $(this).children('option').length;

        $this.addClass('select-hidden'); 
        $this.wrap('<section class="select"></section>');
        $this.after('<section class="select-styled"></section>');

        var $styledSelect = $this.next('section.select-styled');
        $styledSelect.text($this.children('option').eq(0).text());

        var $list = $('<ul />', {
            'class': 'select-options'
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
        }

        var $listItems = $list.children('li');

        $styledSelect.click(function(e) {
            e.stopPropagation();
            $('section.select-styled.active').each(function(){
                $(this).removeClass('active').next('ul.select-options').hide();
            });
            $(this).toggleClass('active').next('ul.select-options').toggle();
        });

        $listItems.click(function(e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            $list.hide();
        });

        $(document).click(function() {
            $styledSelect.removeClass('active');
            $list.hide();
        });
    });
});

