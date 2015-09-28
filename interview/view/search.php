

		<link href="./css/index_signed.css" rel="stylesheet" />	
        <script language="javascript" src="./js/index_signed.js"></script>

        <?php         
		session_start();
        if(!isset($_SESSION['user']))
        {
        	header("location:../index.php");
        	exit();
        }
        else
        {
        	include "../include/userhead.php";
        }

        ?>

    <section class="wrap">
  
  
      <section id="content">
        <section id="one">
            <form action="" id="searchaddform" >
                <section class="searchcate">
                <!--category-->
                <section class="category">
                        <select id="categoryselect">
                            <option value="hide">Category</option>
                            <option value="11">Algorithm</option>
                            <option value="12">Database</option>
                            <option value="13">Web</option>
                            <option value="100">Others</option>
                        </select> 
                </section>
                <!--end of category-->
                
              <!--this is the search blank-->
                <section class="ylzout">
                    <section class="ylzout-innr">
                            <label class="search" for="inpt_search">
                                <input id="inpt_search" type="text"  />
                            </label>
                    </section>                       
                </section>
                </section>
                <!--end of search blank-->
                <!--submit button-->
                <section class="btnwarp">
                    <input type="submit" id="searchbtn" class="btn" value="Search">
                    <input type="submit" id="addbtn"  class="btn" value="Add One">
                </section>
                <!--end of submit button-->
                
            </form>
          </section>
      </section>
    </section>
        <?php
            include "../include/footer.php";
        ?>