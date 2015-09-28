 		<link href="./css/jquery-ui.min.css" rel="stylesheet" />
		<link href="./css/resultDetail.css" rel="stylesheet" />
        <script language="javascript" src="./js/jquery-ui.min.js"></script>
        <script language="javascript" src="./js/resultDetail.js"></script>  
 
 <?php 
 			session_start();
            include "../include/userhead.php";
        ?>
        <section class="qidhide">{{names.question.q_id}}</section>
        <section id="resDwrap">
        
        
            <section class="qstblock">
                <section id="question">
                    <h1>Question: </h1>
                    <p ng-bind-html="names.question.content">{{names.question.content}}</p>
                    <footer>{{names.question.username}} <span> posted at {{names.question.date}}</span></footer>
                </section>
                <section id="ansSec">
                    <input type="button" value="Answer" id="answer-btn" />
                </section>
            </section>

            <section class="ansblock">
                <section id="answer">
                    <section>
                        <h1>Answer: </h1>
                        <section id="anssort">
                            <select ng-model="sortKey">
                                <option value="hide" disabled>-- Sort By --</option>
                                <option value="date">Date</option>
                                <option value="like">Likes</option>
                                <option value="dislike">Dislikes</option>
                            </select> 
                        </section>
                    </section>
                    <hr/>
                                                    
                    <!--repeat this part -->
                    <section id="ans_scroll-block" infinite-scroll='loadMore()' infinite-scroll-distance='2' >
                      <section class="ng-section" ng-repeat="temp in names.answer | orderBy: sortKey : true | limitTo: num1"  >
	                    <p ng-bind-html="temp.content">{{temp.content}} </p>
	                    <footer>{{temp.username}} <span>posted at {{temp.date}}</span></footer>
	      			    <span class="aidhide">{{temp.a_id}}</span>
	                    <section class="like">
	                        <p>
	                            <button class="btnlike">
	                                <section class="likeimg"><img src="./img/up.png" alt="up" height="14" width="17"></section>
	                                <section class="liketext" > | {{temp.like}} Likes</section>
	                            </button>
	                            <button class="btndislike">
	                                <section class="likeimg"><img src="./img/down.png" alt="down" height="14" width="17"></section>
	                                <section class="liketext" > | {{temp.dislike}}</section>
	                            </button>
	                        </p>
	                    </section>
	                    <hr/>
					   </section>
                    </section>
                </section>
            </section>
            
            
            
                <section id="dialog-form" title="Answer...">
                  <p class="validateTips">All form fields are required.</p>
                  <form>
                    <fieldset>
                        <textarea name="anstext" id="anstext" rows="5" cols="30" placeholder="Answer the question" class="text ui-widget-content ui-corner-all"></textarea>

                      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
                    </fieldset>
                  </form>
              </section>
              
        </section>
 
        <?php
            include "../include/footer.php";
        ?>
