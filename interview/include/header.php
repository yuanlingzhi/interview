

<header>    
	<section>
        <a href="./index.php"><img src="./img/interview.png" width="150" height="56"></a>
	</section>
	<section id="login">
         <section>
		 <form action="./controller/signinContr.php" method="post" onsubmit="return check()">
            <section>
                    <input type="text" name="signin" id="username" size="20"  
                        placeholder="Username" required pattern="[a-zA-Z0-9_]{3,15}" 
                        title="user name should be 3 to 15 characters which consists of alphabet letters, numerals and/or underlines" />
                    <input type="password" name="pwd" id="pwd" size="20"  
                        placeholder="Password" required pattern="[a-zA-Z0-9]{6,20}" 
                        title="password should be 6 to 20 characters which consists of alphabet letters and/or numerals" />
                <input id="login-btn" type="submit" value="Sign in" />
            </section>
            <?php 
                if(isset($_GET["s"])){
                    if($_GET["s"]=="n")  {
                        echo "<span class='signin-warn'>username password doesn't match!</span>";
                    }
                }
             ?>
            <a class="fp" href="#">Forget Password?</a>
        </form>
        </section>
	</section>
    <section><input type="button" value="Sign in" id="signin-user" /><br/>
            <a class="fp" href="#">Forget Password?</a>
    </section>
  <section id="dialog-form1" title="Sign in">
      <p class="validateTips">All form fields are required.</p>

      <form>
        <fieldset>
          <input type="text" name="name1" id="name1" placeholder="Username" class="text ui-widget-content ui-corner-all">
          <input type="password" name="password1" id="password1" placeholder="Password" class="text ui-widget-content ui-corner-all">

          <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
      </form>
  </section>
  <section id="dialog-form2" title="Create a username">
      <p class="validateTips">All form fields are required.</p>

      <form>
        <fieldset>
          <input type="text" name="name2" id="name2" placeholder="Username" class="text ui-widget-content ui-corner-all">
            
          <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
      </form>
  </section>
  <section id="dialog-form3" title="Find your password">
      <p class="validateTips">All form fields are required.</p>

      <form>
        <fieldset>
          <input type="text" name="name3" id="name3" placeholder="Username" class="text ui-widget-content ui-corner-all">
          <input type="email" name="email3" id="email3" placeholder="Email" class="text ui-widget-content ui-corner-all">
          <input type="password" name="password3" id="password3" placeholder="New Password" class="text ui-widget-content ui-corner-all">
          <input type="password" name="password4" id="password4" placeholder="Confirm Password" class="text ui-widget-content ui-corner-all">
            
          <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
        </fieldset>
      </form>
  </section>
    <section><hr/></section>
</header>
