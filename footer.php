    <!--FOOTER-->
    <footer id="footer" class="bg-dark text-white py-3">
        <div class="container">
          <div class="row">
            <div class="col-lg-2 col-12 col-sm-6 mb-3 mb-lg-0">
              <h5>Links</h4>
              <div class="d-flex flex-column flex-wrap">
                <a href="index.php" class="font-size-14 text-white-50 pb-1">Home</a>
                <a href="products.php" class="font-size-14 text-white-50 pb-1">Products</a>
                <a href="#" class="font-size-14 text-white-50 pb-1">Account</a>
                <a href="#" class="font-size-14 text-white-50 pb-1">FAQ</a>
              </div>
            </div>
            <div class="col-lg-3 col-12 col-sm-6 mb-3 mb-lg-0">
              <h5>Information</h4>
              <div class="d-flex flex-column flex-wrap">
                <a href="about.php" class="font-size-14 text-white-50 pb-1">About Us</a>
                <a href="#" class="font-size-14 text-white-50 pb-1">Delivery Information</a>
                <a href="#" class="font-size-14 text-white-50 pb-1">Privacy Policy</a>
                <a href="#" class="font-size-14 text-white-50 pb-1">Terms & Conditions</a>
              </div>
            </div>
            <div class="col-lg-4 col-12 col-sm-6 mb-3 mb-lg-0">
                <h5>Newsletter</h4>
                <p>Get all the latest information on offers and upcoming limited prints.</p>
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Enter your email">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit">Subscribe</button>
                    </span>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <h5>Contact Us</h4>
              <div id="footer-contact" class="d-flex flex-column flex-wrap">
                <a href="#" class="text-white-50 pb-1"><i class="bi bi-envelope pe-1"></i>support@nokposters.com</a>
                <span href="#" class="text-white-50 pb-1"><i class="bi bi-telephone pe-1"></i>+44 (0)121 496 0368</span>
                <span href="#" class="text-white-50 pb-1"><i class="bi bi-clock pe-1"></i>Mon - Fri 9:00am to 4:00pm</span>
                <div class="row my-2">
                  <div class="col-1 me-2"><a href="#" class="text-white-50 pb-1"><i class="bi bi-facebook pe-1"></i></a></div>
                  <div class="col-1 me-2"><a href="https://twitter.com/nokposters" class="text-white-50 pb-1"><i class="bi bi-twitter pe-1"></i></a></div>
                  <div class="col-1 me-2"><a href="#" class="text-white-50 pb-1"><i class="bi bi-instagram pe-1"></i></a></div>
                
                
                </div>
              </div>
            </div>
          </div>
          <div class="copyright text-center bg-dark text-white pt-2">
            <p class="font-size-14">&copy; Copyright 2021 | Design By Lewis</p>
          </div>
        </div>
      </footer>
      



    <!--FOOTER END-->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/color/jquery.color-2.2.0.min.js" integrity="sha256-aSe2ZC5QeunlL/w/7PsVKmV+fa0eDbmybn/ptsKHR6I=" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
    <?php if(strpos($_SERVER['PHP_SELF'], 'admin.php') !== false): ?>
      <script src="js/admin.js"></script>
    <?php endif; ?>

    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> 


    
</body>
  
</html>