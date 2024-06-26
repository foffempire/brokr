<footer class="footer dark-blue-bg section-style-2">
    <div
      class="bat-right"
      style="
        background: url(assets/global/images/1LEQ8Pp4q1BBqwn7SVp9.png) repeat;
      "
      data-aos="fade-down-left"
      data-aos-duration="2000"
    ></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
          <div
            class="footer-widget"
            data-aos="fade-down"
            data-aos-duration="1000"
          >
            <h4>About <?= Helper::site_name() ?></h4>
            <p>
              <?= Helper::site_name() ?> offers a diverse range of trading options, including forex
              currency pairs, and popular cryptocurrencies like Bitcoin, Ethereum,
              and more.
            </p>
            <div class="socials"></div>
          </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
              <div
                class="footer-widget"
                data-aos="fade-down"
                data-aos-duration="1500"
              >
                <h4>Navigation</h4>
                <div class="footer-nav">
                  <ul>
                    <li><a href="index">Home</a></li>
                    <li><a href="login">Account Login</a></li>
                    <li><a href="contact">Contact</a></li>
                    <li><a href="privacy-policy">Privacy</a></li>
                  </ul>
                </div>
              </div>
            </div>
  
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
              <div
                class="footer-widget"
                data-aos="fade-down"
                data-aos-duration="1500"
              >
                <h4>Important Links</h4>
                <div class="footer-nav">
                  <ul>
                    <li><a href="rankings">Ranking</a></li>
                    <li><a href="schema">Investment Plans</a></li>
                    <li><a href="faq">FAQ</a></li>
                    <li><a href="about-us">About</a></li>
                  </ul>
                </div>
              </div>
            </div>
  
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
              <div
                class="footer-widget"
                data-aos="fade-down"
                data-aos-duration="1500"
              >
                <h4>Company</h4>
                <div class="footer-nav">
                  <ul>
                    <li>
                      <a href="terms-and-conditions">Terms and Conditions</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div
            class="copyright-text"
            data-aos="fade-down"
            data-aos-duration="3000"
          >
            <p>Copyright <?= Helper::site_name().' © '.date('Y') ?>.  All rights reserved.</p>
          </div>
        </div>
      </div>
    </div>
  </footer>


<div class="caches-privacy cookiealert" hidden>
        <div class="content">
            <p>Please allow us to collect data about how you use our website. We will use it to improve our website, make your browsing experience and our business decisions better. Learn more <a href="privacy-policy"
            target="_blank">Learn More</a></p>
        </div>
  <button class="site-btn blue-btn acceptcookies">Accept All</button>
</div>



<script src="assets/global/js/jquery.min.js"></script>
<script src="assets/global/js/jquery-migrate.js"></script>

<script src="assets/frontend/js/bootstrap.bundle.min.js"></script>
<script src="assets/frontend/js/scrollUp.min.js"></script>

<script src="assets/frontend/js/owl.carousel.min.js"></script>
<script src="assets/global/js/waypoints.min.js"></script>
<script src="assets/frontend/js/jquery.counterup.min.js"></script>
<script src="assets/frontend/js/jquery.nice-select.min.js"></script>
<script src="assets/frontend/js/lucide.min.js"></script>
<script src="assets/frontend/js/magnific-popup.min.js"></script>
<script src="assets/frontend/js/aos.js"></script>
<script src="assets/global/js/datatables.min.js" type="text/javascript" charset="utf8"></script>
<script src="assets/frontend/js/main.js"></script>
<script src="assets/frontend/js/cookie.js"></script>
<script src="assets/global/js/custom.js"></script>
    <script>
        (function ($) {
            'use strict';
            // AOS initialization
            AOS.init();
        })(jQuery);
    </script>

<script>
        // Color Switcher
        $(".color-switcher").on('click', function () {
            "use strict"
            $("body").toggleClass("dark-theme");
            var url = 'theme-mode.html';
            $.get(url)
        });
    </script>


<script>
const cookieAlert = document.querySelector(".cookiealert")
const acceptCookie = document.querySelector(".acceptcookies")

acceptCookie.onclick = ()=>{
    localStorage.setItem("setmysitecookie", "1")
}

window.addEventListener("DOMContentLoaded", ()=>{
    if(localStorage.getItem("setmysitecookie")){
        cookieAlert.setAttribute("hidden")
    }else{
      cookieAlert.removeAttribute("hidden")
    }
})


</script>
<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = 'cba44db4f6ee689dbc0dc148e20ca08ee6b12ddc';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
<noscript><a href=“#” target=“_blank”></a></noscript>