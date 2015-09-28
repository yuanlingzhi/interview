<?php session_start();
	
	if(isset($_SESSION['user'])){
		header("Location: search.html");
		exit();
	}

?>

<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="description" content="Portable Simulated Interview Site">
		<meta name="author" content="Gong Cheng, Lingzhi Yuan, Zhe Xu">
		<meta name="keywords" content="interview, simulated, monk">
		<title>Portable Simulated Interview</title>
		<link rel="shortcut icon" href="./img/interview_ico.png" type="images/x-icon"/>
		
		<link href="./css/jquery-ui.min.css" rel="stylesheet" />
		<link href="./css/index.css" rel="stylesheet" />
        <script language="javascript" src="./js/jquery.js"></script>
        <script language="javascript" src="./js/index.js"></script>
        <script language="javascript" src="./js/jquery-ui.min.js"></script>
        

        
	</head>

    <body> 

        <?php
	           include "./include/header.php";
            
        ?>
        <section id="sign-wrap">
            <section id="sign-page">
                <section id="about-site">
                    <h1>About the Site</h1>
                    <p>The site is built for improving your interview skills.</p>
                    <p>Post your questions.<br/> Share your answers.<br/> View answers from others.</p>
                    <p>Simple as it is!</p>
                </section>
                <section id="sign-up">
                    <h1>Sign Up Now!</h1>
                   
                    <?php 
                    if(isset($_GET["s"])){
						if($_GET["s"]=="w")  {
							echo "<p class='warn'>username or email exists!</p>";
						}
					}                  
                    ?>
                    
                    <form id="signup-check" action="./controller/signupContr.php" method="post" onsubmit="return check()">
                        <section>
                            <p>
                                <input type="text" name="signin" id="signup-username" size="20"  
                                    placeholder="Username" required pattern="[a-zA-Z0-9_]{3,15}" 
                                    title="user name should be 3 to 15 characters which consists of alphabet letters, numerals and/or underlines" />
                            </p>
                            <section id="checkusername"></section>
                        </section>
                        <section>
                            <p>
                                <input type="email" name="email" id="signup-email" size="20"  
                                    placeholder="Email" required pattern="[a-zA-Z0-9_.-]{3,}@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+" 
                                    required title="please enter your email" />
                            </p>
                            <section id="checkemail"></section>
                        </section>
                        <section>
                            <p>
                                <input type="password" name="pwd" id="signup-pwd" size="20"  
                                    placeholder="Password" required pattern="[a-zA-Z0-9]{6,20}" 
                                    title="password should be 6 to 20 characters which consists of alphabet letters and/or numerals" />
                            </p>
                        </section>
                        <section>
                            <p>
                                <input type="password" name="pwdcfm" id="pwdcfm" size="20"  
                                    placeholder="Retype passward" required /></p>
                            <section id="cfmpwd"></section>
                        </section>
                        <section>
                            <input id="signup-btn" type="submit" value="Sign up" />
                        </section>
                    </form>
                    <section id="login-fb">
                        <p>Or log in with facebook!</p>
                        
                        <img id="fbbtn" src="./img/fb_icon.png" width="30" height="30" />
                        
                    </section>
                </section>
            </section>
        </section>
        <?php
            include "./include/footer.php";
        ?>
        
	</body>

</html>


