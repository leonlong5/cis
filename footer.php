
      <footer class="main-footer">
        <div class="fwrapper">
          <div class="fcol"><h2>Link</h2>
            <p><a href="http://www.cis.fiu.edu/">FIU CIS home</a></p>
            <p><a href="http://www.cis.fiu.edu/advising/">Advising</a></p>
            <p><a href="http://www.cis.fiu.edu/support">Support & Services</a></p>
          </div>
          <div class="fcol"><h2>Contact</h2>
            <p>Main Office： 305.348.2744
              Fax: 305.348.3549</p>
            <p>Address:</p>
            <p>Florida International University school of Computing and Information Sciences
            11200 SW 8th St 
            ECS 354 
            Miami, FL 33199
            </p>
          </div>
          <div class="fcol"><h2>Administrator</h2>
            <?php
            if(isset($_SESSION['username'])){
              echo "<p><a href='logout.php'>".$_SESSION['username']." Logout</a></p>";
            } else {
              echo "<p><a href='login.php'>Login</a></p>";
            } 
            
            ?>
          </div>
        </div>
      </footer>