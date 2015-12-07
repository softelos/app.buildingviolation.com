<?php $path="http://buildingviolation.netlify.com"; ?>

<footer id="page-footer">
    <div class="inner">
        <aside id="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <article>
                            <p>
                                <strong>©<?php echo date('Y'); ?>, Building Violation LLC</strong><br>
                                <a href="" class="fa fa-facebook btn btn-grey-dark"></a>
                                <a href="" class="fa fa-linkedin btn btn-grey-dark"></a>
                                <a href="" class="fa fa-twitter btn btn-grey-dark"></a>
                            </p>
                        </article>
                    </div><!-- /.col-sm-3 -->
                    <div class="col-md-2 col-sm-2">
                        <article>
                            <h3>Useful Links</h3>
                            <ul class="list-unstyled list-links">
                                <li><a href="<?php echo $path; ?>/services">Services</a></li>
                                <li><a href="<?php echo $path; ?>/faq">FAQ</a></li>
                                <li><a href="<?php echo $path; ?>/about">About</a></li>
                            </ul>
                        </article>
                    </div><!-- /.col-sm-3 -->

                    <div class="col-md-2 col-sm-2">
                        <article>
                            <h3>Customers</h3>
                            <ul class="list-unstyled list-links">
                                <li><a href="<?php echo $path; ?>/how-it-works">How it works</a></li>
                                <li><a href="<?php echo $path; ?>/safety">Safety</a></li>
                                <li><a href="<?php echo base_path();?>report-violation">Report a violation</a></li>
                                <?php if(!Auth::check()): ?>
                                    <li><a href="<?php base_path();?>sign-up">Sign up</a></li>
                                <?php endif;?>                                    
                            </ul>
                        </article>
                    </div><!-- /.col-sm-3 -->

                    <div class="col-md-2 col-sm-2">
                        <article>
                            <h3>Pros</h3>
                            <ul class="list-unstyled list-links">
                                <li><a href="<?php echo $path;?>/how-it-works-pro">How it works</a></li>
                                <?php if(!Auth::check()): ?>
                                    <li><a href="<?php base_path();?>sign-up-pro">Sign up</a></li>
                                <?php endif;?>
                            </ul>
                        </article>
                    </div><!-- /.col-sm-3 -->


                    <div class="col-md-3 col-sm-3">
                        <article>
                            <h3>Questions? Need help?</h3>
                            Call (866) 545-4440 (8AM-5PM ET)<br>
                            <a href="mailto:info@buildingviolation.com?Subject=Hello" target="_blank">Email us</a><br>
                            <br>
                        </article>
                    </div><!-- /.col-sm-3 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <span class="pull-right"><a href="#page-top" class="roll">Go to top</a></span>
                    </div>
                </div>
            </div>
        </aside><!-- /#footer-main -->
        <aside id="footer-thumbnails" class="footer-thumbnails"></aside><!-- /#footer-thumbnails -->
        <aside id="footer-copyright">
            <div class="container center">
                <span>built by <a href="http://www.softelos.com" target="_blank">softelos</a></span>
            </div>
        </aside>
    </div><!-- /.inner -->
</footer>