
      <footer class="main-footer">
        <div class="fwrapper">
          <div class="fcol"><h2>Link</h2>
            <p><a href="http://www.cis.fiu.edu/">cis home</a></p>
            <p><a href="http://www.cis.fiu.edu/advising/">Advising</a></p>
          </div>
          <div class="fcol"><h2>Contact</h2>
            <p>Phone:</p>
            <p>Email:</p>
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