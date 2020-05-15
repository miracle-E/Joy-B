<footer class="footer">
    <div class="footer_content">
        <div class="container">
            <div class="row">

                <!-- About -->
                <div class="col-lg-4 footer_col">
                    <div class="footer_about">
                        <div class="footer_logo">
                            <a href="#">
                                <div class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="footer_logo_icon"><img src="front/images/logo_2.png" alt=""></div>
                                    <div>Joy & B</div>
                                </div>
                            </a>
                        </div>
                        <div class="footer_about_text">
                            <p>
                                Joy & B is your closest online local e-shop customer readily available with contents that will interest you.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer Links -->
                <div class="col-lg-4 footer_col">
                    <div class="footer_menu">
                        <div class="footer_title">Support</div>
                        <ul class="footer_list">
                            <li>
                                <a href="#"><div>Customer Service<div class="footer_tag_1">online now</div></div></a>
                            </li>
                            <li>
                                <a href="#"><div>Terms and Conditions</div></a>
                            </li>
                            <li>
                                <a href="#"><div>Contact</div></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Footer Contact -->
                <div class="col-lg-4 footer_col">
                    <div class="footer_contact">
                        <div class="footer_title">Stay in Touch</div>
                        <div class="newsletter">
                            <form action="#" id="newsletter_form" class="newsletter_form">
                                <input type="email" class="newsletter_input" placeholder="Subscribe to our Newsletter" required="required">
                                <button class="newsletter_button">+</button>
                            </form>
                        </div>
                        <div class="footer_social">
                            <div class="footer_title">Social</div>
                            <ul class="footer_social_list d-flex flex-row align-items-start justify-content-start">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bar">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="footer_bar_content d-flex flex-md-row flex-column align-items-center justify-content-start">
                        <div class="copyright order-md-1 order-2">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                            </div>
                            <nav class="footer_nav ml-md-auto order-md-2 order-1">
                                <ul class="d-flex flex-row align-items-center justify-content-start">
                                    @foreach(App\Category::skip(0)->take(4)->get() as $item)
                                    <li><a href="/category/{{ $item->id }}">{{ $item->label }}</a></li>
                                    @endforeach
                                    <li><a href="/contact">Contact</a></li>
                                </ul>
                            </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>