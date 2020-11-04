
<nav>
  <div class="all">
    <div class="header">
        <div class="top">
            <div class="currency-add">
                <select class="currency-selector">
                <option selected>RO</option>
                <option>ENG</option>
                </select>
            </div>
          
            <ul class="menu-right menu-style">
                <li>
                    <div id="search">
                        <div class="content">
                            <form action="search.php" method="GET">
                                <input type="text" name="cuvant" class="input" placeholder="cauta" autocomplete="off"/>
                                
                                <i class="fas fa-search" id="search-button"></i>
                            </form>
                        </div>
                    </div>
                </li>
                            
                <li><a href="wishlist.php" ><i class='far fa-heart' style="font-size:16px; color:black"></i></a></li>
                <li><span id="navbar_login_session"><i class="glyphicon glyphicon-user style='font-size:16px; color:black"></i></span></li>
                <li><a href="cart.php"><i class="glyphicon glyphicon-shopping-cart style='font-size:16px; color:white"></i><div id="cart_bubble"></div></a></li>
            </ul>
        </div>
        <!--Logo-->


        <!--Navigation bar--> 
        <div id="nav"> 
            <a href="index.php" style="border-bottom:none;width:auto"class="logo"> <img id="logo" src="poze/logo.jpg" alt="logo"></a>
            <div class="menu-toggle"><i class="fa fa-bars" aria-hidden="true" onclick="openNav()"></i></div>
                <div id="myNav" class="overlay">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <div class="containermobile" >
                        
                                <ul class="nav-menu-left nav-menu-style">  
                                    <li><a href="colections.php" >Colectii </a></li>
                                    <li><a href="products.php" >Produse </a></li>
                                    <li><a href="princess.php" >Fetite </a></li>
                                  
                                  
                                </ul>

                                <ul class="nav-menu-right nav-menu-style">
                                    <li ><a href="appointment.php">Programari </a></li>
                                    <li><a href="courses.php" >Cursuri </a></li>
                                    <li><a href="contact.php" >Contact </a></li>
                                  
                               
                                </ul>
                              
                                
                        </div>
                      
                </div>
                <hr>  
            </div>
          
        </div>
    </div>
    </div>
</nav>