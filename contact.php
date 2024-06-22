<?php  require_once("user/includes/init.php"); ?>
<?php define("PAGE","contact"); ?>
<?php define("TITLE","Contact Us"); ?>
<?php require_once("includes/components/header.php") ?>

    <!--page-head-->
    <section class="page-head site-overlay"
             style="background: url( assets/global/images/YxeYfLzaEsagR8a7OWXw.jpg) no-repeat center top / cover;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 centered">
                    <h2 data-aos="fade-down" data-aos-duration="2000">    Contact Us
</h2>
                </div>
            </div>
        </div>
    </section>
    <!--page-head End -->

        <section class="section-style-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="section-title centered">
                        <h4 data-aos="fade-down" data-aos-duration="2000">Get In Touch</h4>
                        <h2 data-aos="fade-down" data-aos-duration="1500">Get In Touch</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-8 col-12">
                    <div class="site-form">
                        <form action="" method="post" data-aos="fade-down"
                              data-aos-duration="2000">
                              <div class="row">
                                <div class="col-xl-12 col-lg-12 col-sm-12">
                                    <input type="text" placeholder="Name" name="name" required>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-sm-12">
                                    <input type="email" placeholder="Email" name="email" required>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-sm-12">
                                    <input type="text" placeholder="Subject" name="subject" required>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-sm-12">
                                    <textarea name="msg" rows="4" placeholder="Your message"></textarea>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-sm-12">
                                    <button type="submit" class="site-btn primary-btn">Send message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


<!--Footer Area-->
<?php require_once("includes/components/footer.php") ?>
<!--Footer Area End-->
</body>
</html>

