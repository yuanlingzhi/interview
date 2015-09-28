<?php session_start();
?>



                  <link href="./css/result.css" rel="stylesheet" />	
		        <script language="javascript" src="./js/jquery.js"></script>
		        <script language="javascript" src="./js/result.js"></script>  
        <?php 
            include "../include/userhead.php";
        ?>
	<section class="blockwrap">
        <section class="resblock">
            <section id="result">
                <section>
                    <h1>Search result</h1>
                </section>
                <hr/>
                
 			
              <section id="scroll-block" infinite-scroll='loadMore()' infinite-scroll-distance='2'>
                <section class="ng-section" ng-repeat="temp in names.info | limitTo : num">
                <p><a ng-bind-html="temp.content" href="./search.html#/detail/{{temp.q_id}}">{{temp.content}}</a></p>
                    <footer>{{temp.username}}<span><span id="postedat"> posted at</span> {{temp.date}}</span></footer>
                <hr/>
				</section>
               </section>
               
 
            </section>
        </section>
	</section>
        <?php
        
     
        
            include "../include/footer.php";
        ?>
       	
