myApp.controller('showSearchPage',function($scope,$routeParams ,$http){

});


myApp.controller('showResult',function($scope, $routeParams ,$http, $window, $timeout){
       	

            var info=$routeParams.info;
            info=decodeURIComponent(info);
            $http.get("./service/search_service.php?info="+info).success(function(res){
            if(res==""){
                window.location.href="./index.php";
                return ;
            }
			$scope.names=res;
			var len=$scope.names.info.length;
			$scope.num = Math.min(Math.floor(($window.innerHeight-230)/89.5),len);
			if($scope.num==0) $scope.num=1;
			$(".resblock").first().css("height",$scope.num*89.5+230);
		    var height=$(".resblock").first().css("height");
		    height=height.substr(0,height.length-2);
		    var bh=$window.innerHeight;
		    if(bh-height>266){
		        $(".blockwrap").first().css({height:(bh-266)+"px"});
		    }

		    $(window).resize(function(){
                $timeout(function(){
                    var hh=$("#scroll-block").height();
			        $(".resblock").first().css("height",hh+300);
                });
			    var height=$(".resblock").first().css("height");
			    height=height.substr(0,height.length-2);
			    var bh=$window.innerHeight;
			    if(bh-height>266){
			        $(".blockwrap").first().css({height:(bh-266)+"px"});
			    }
		    });
		    
		    $scope.loadMore = function() {
                if($scope.num<len){
                $timeout(function(){
                    var hh=$("#scroll-block").height();
                    $scope.num++;
			        $(".resblock").first().css("height",hh+300);
                });
		    	
                }
                
		      };
		    
		});    
});


myApp.controller('resultDetail',function($scope, $routeParams ,$http, $window, $timeout){
	
	$scope.sortKey="hide";
	
	var detail=$routeParams.detail;
	$http.get("./service/answerService.php?qid="+detail).success(function(res){
            if(res==""){
				window.location.href="./index.php";
				return ;
			}
            
            function like(){
	            	$(".btndislike,.btnlike").each(function(){
	            		$(this).click(function(){
	            		var obj1=$(this).children().eq(1);
	            		var va=$(this).children().eq(1).text();
	            		var likestr=va;
	            		va=va.substr(va.length-4,va.length);
	            		var a=(va=="ikes")?1:-1;
	            		var obj=$(this).parent().parent();
	            		var a_id=obj.siblings().eq(2).text();
	            		var q_id=$(".qidhide").first().text();
	            		
	            		var obj2=$(this).siblings().eq(0).children().eq(1);
	            		var likestr2=obj2.text();
	            		
	            		$.ajax({
	            			   type: "POST",
	            			   url: "./controller/likeContr.php",
	            			   data: {qid:q_id,aid:a_id,like:a},
	            			   success: function(msg){
	            				   
	            				   
	            				   //process the msg decide what to do next
	            				   if(msg=="like"){
	            					   if(a==-1)//dislike
	            						   {	
	            						   		likestr=likestr.substr(3);
	            						   		likestr=parseInt(likestr, 10);
	            						   		likestr++;
	            						   		likestr2=likestr2.substr(3);
	            						   		likestr2=parseInt(likestr2, 10);
	            						   		likestr2--;
	            						   		obj1.text(" | "+likestr);
	            						   		obj2.text(" | "+likestr2+" Likes");
	            						   }
	            				   }
	            				   else if(msg=="dislike"){              
	            					   if(a==1)//like
            						   {	
            						   		likestr=likestr.substr(3);
            						   		likestr=parseInt(likestr, 10);
            						   		likestr++;
            						   		likestr2=likestr2.substr(3);
            						   		likestr2=parseInt(likestr2, 10);
            						   		likestr2--;
            						   		obj1.text(" | "+likestr+" Likes");
            						   		obj2.text(" | "+likestr2);
            						   }
	            				   }
	            				   else{
	            					   if(a==1)//like
            						   {	
            						   		likestr=likestr.substr(3);
            						   		likestr=parseInt(likestr, 10);
            						   		likestr++;
            						   		obj1.text(" | "+likestr+" Likes");
            						   }
	            					   else{
	            							likestr=likestr.substr(3);
            						   		likestr=parseInt(likestr, 10);
            						   		likestr++;
            						   		obj1.text(" | "+likestr);
	            					   }
	            				   }
	            			   }
	            			});
	        			});
	        	});

            }

            $scope.names=res;
			
			var len=$scope.names.answer.length;
			$scope.num1 = Math.min(Math.floor(($window.innerHeight-230)/89.5),len);
			if($scope.num1==0) $scope.num1=1;
            $timeout(function(){
            		
            		like();
            	
                    var hh=$("#ans_scroll-block").height();
                    if($("#resDwrap").first().css("height").substr(0,$("#resDwrap").first().css("height").length-2) <= $window.innerHeight-266)
                    $("#resDwrap").first().css("height",hh+500);
                    var height=hh+500;
                    var bh=$window.innerHeight;
                    if(bh-height>266){
                        $("#resDwrap").first().css({height:(bh-266)+"px"});
                    }
                });
		    
		    $(window).resize(function(){
                $timeout(function(){
                    var hh=$("#ans_scroll-block").height();
                    if($("#resDwrap").first().css("height").substr(0,$("#resDwrap").first().css("height").length-2) <= $window.innerHeight-266)
			        $("#resDwrap").first().css("height",hh+500);  
                    var height=hh+500;
                    var bh=$window.innerHeight;
                    if(bh-height>266){
                        $("#resDwrap").first().css({height:(bh-266)+"px"});
                    }
                });
			  
		    });
			
		    $scope.loadMore = function() {
                if($scope.num1<len){
                $timeout(function(){
                	
                	$(".btndislike,.btnlike").each(function(){
                		$(this).unbind("click");
                	});
                	
	            	like();
                	
                    var hh=$("#ans_scroll-block").height();
                    if($("#resDwrap").first().css("height").substr(0,$("#resDwrap").first().css("height").length-2) <= $window.innerHeight-266)
			        $("#resDwrap").first().css("height",hh+500);  
                });
		    	
                    $scope.num1++;
                }
                
		      };

	});

});





