<div class="rts-pricing-plan pricing__eleven section__padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="rts-section text-center">
                <h2 class="rts-section__title sal-animate" data-sal="slide-down" data-sal-delay="100"
                    data-sal-duration="800">Choose Hosting Plan</h2>
                <p class="rts-section__description w-450 sal-animate" data-sal="slide-down" data-sal-delay="300"
                    data-sal-duration="800">Globally incubate next-generation e-services via state of the art
                    technology.
                </p>
            </div>
        </div>
        <div class="row">

            <!-- PRICING PLAN -->
            <div class="tab__content open" id="monthly">
                <div class="row g-30 monthly">

                    @foreach ($hostingPlans as $plan)
                        <!-- single card -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card-plan {{ $plan->is_featured ? 'active' : '' }}">
                                <div class="card-plan__package">
                                    <div class="icon">
                                        <img src="{{ asset('assets/images/index-11/plan/business.svg') }}"
                                            height="30" width="30" alt="{{ $plan->name }}">
                                    </div>
                                    <h4 class="package__name">{{ $plan->name }}</h4>
                                </div>
                                <p class="card-plan__desc">Everything you need for your website</p>
                                <h5 class="card-plan__price" style="font-size:22px !important;">
                                    {{ $plan->formatedYearlyPrice() }} / Year
                                </h5>
                                <div class="card-plan__cartbtn">
                                    <a href="#">Add to Cart</a>
                                </div>
                                <p class="card-plan__renew-price">
                                    $6.99 /mo when you renew
                                </p>
                                <div class="card-plan__feature">
                                    <ul class="card-plan__feature--list">
                                        @if (!empty($plan->features) && is_iterable($plan->features))
                                            @foreach ($plan->features as $feature)
                                                <li class="card-plan__feature--list-item">
                                                    <span class="text">
                                                        <i class="fa-regular fa-check"></i>
                                                        {{ $feature->name ?? 'Feature' }}
                                                    </span>
                                                    @if (!empty($feature->description))
                                                        <span class="tooltip" data-bs-toggle="tooltip"
                                                            data-bs-custom-class="pricing-eleven"
                                                            data-bs-placement="bottom"
                                                            title="{{ $feature->description }}">
                                                            <i class="fa-light fa-circle-question"></i>
                                                        </span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="card-plan__feature--list-item">No features available</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- single card end -->
                    @endforeach



                </div>
            </div>

            <!-- PRICING PLAN -->
            <div class="tab__content" id="yearly">
                <div class="row g-30 yearly">
                    <!-- single card -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card-plan">
                            <div class="card-plan__package">
                                <div class="icon">
                                    <img src="assets/images/index-11/plan/basic.svg" height="30" width="30"
                                        alt="">
                                </div>
                                <h4 class="package__name">Basic</h4>
                            </div>
                            <p class="card-plan__desc">Everything need to your website</p>
                            <h5 class="card-plan__price">
                                <sup>$</sup> 36.63 <sub>/ month</sub>
                            </h5>
                            <div class="card-plan__cartbtn">
                                <a href="#">add to cart</a>
                            </div>
                            <p class="card-plan__renew-price">
                                $ 79.99 /year when you renew
                            </p>
                            <div class="card-plan__feature">
                                <ul class="card-plan__feature--list">
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 1 Website</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Explore, discover, and learn on our innovative and informative website."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Standard
                                            Performance</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Unlock superior online experiences with our standard performance solutions, ensuring reliability, speed, and seamless functionality for your website needs."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 24/7/365
                                            Support</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie provides reliable 24/7 support for your hosting needs, ensuring assistance whenever you require help."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-xmark"></i> Free Email</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie offers complimentary email services, empowering your online communication with reliable and secure free email solutions."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-xmark"></i> Unlimited
                                            Bandwidth</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie provides unlimited bandwidth, ensuring seamless data transfer for your website's optimal performance and user experience."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-xmark"></i> 100 GB SSD
                                            Storage</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Elevate your online presence with Hostie, offering unlimited bandwidth for your domain, ensuring optimal performance and seamless data flow."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>


                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free
                                            SSL</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime
                                            Guarantee</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-xmark"></i> Web Application
                                            Firewall</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-trigered">
                                        <span class="text">More Features <i
                                                class="fa-sharp fa-regular fa-chevron-down"></i>
                                        </span>
                                    </li>
                                </ul>
                                <ul class="card-plan__feature--list more__feature" style="display: none;">
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 100 GB SSD
                                            Storage</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie offers generous hosting with 100GB SSD storage, providing ample space for your data and ensuring high-performance storage solutions."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free
                                            SSL</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime
                                            Guarantee</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-xmark"></i> Web Application
                                            Firewall</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-trigered">
                                        <span class="text">See less Features <i
                                                class="fa-sharp fa-regular fa-chevron-up"></i>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- single card end -->
                    <!-- single card -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card-plan">
                            <div class="card-plan__package">
                                <div class="icon">
                                    <img src="assets/images/index-11/plan/premium.svg" height="30" width="30"
                                        alt="">
                                </div>
                                <h4 class="package__name">Premium</h4>
                            </div>
                            <p class="card-plan__desc">Level-up more power features</p>
                            <h5 class="card-plan__price">
                                <sup>$</sup> 79.56 <sub>/ month</sub>
                            </h5>
                            <div class="card-plan__cartbtn">
                                <a href="#">add to cart</a>
                            </div>
                            <p class="card-plan__renew-price">
                                $ 151.99 /year when you renew
                            </p>
                            <div class="card-plan__feature">
                                <ul class="card-plan__feature--list">
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 1 Website</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Explore, discover, and learn on our innovative and informative website."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Standard
                                            Performance</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Unlock superior online experiences with our standard performance solutions, ensuring reliability, speed, and seamless functionality for your website needs."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 24/7/365
                                            Support</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie provides reliable 24/7 support for your hosting needs, ensuring assistance whenever you require help."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-xmark"></i> Free Email</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie offers complimentary email services, empowering your online communication with reliable and secure free email solutions."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-xmark"></i> Unlimited
                                            Bandwidth</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie provides unlimited bandwidth, ensuring seamless data transfer for your website's optimal performance and user experience."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-xmark"></i> 100 GB SSD
                                            Storage</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Elevate your online presence with Hostie, offering unlimited bandwidth for your domain, ensuring optimal performance and seamless data flow."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>


                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free
                                            SSL</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime
                                            Guarantee</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Web Application
                                            Firewall</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-trigered">
                                        <span class="text">More Features <i
                                                class="fa-sharp fa-regular fa-chevron-down"></i>
                                        </span>
                                    </li>
                                </ul>
                                <ul class="card-plan__feature--list more__feature" style="display: none;">
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 100 GB SSD
                                            Storage</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie offers generous hosting with 100GB SSD storage, providing ample space for your data and ensuring high-performance storage solutions."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free
                                            SSL</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime
                                            Guarantee</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-xmark"></i> Web Application
                                            Firewall</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-trigered">
                                        <span class="text">See less Features <i
                                                class="fa-sharp fa-regular fa-chevron-up"></i>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- single card end -->
                    <!-- single card -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card-plan active">
                            <div class="card-plan__package">
                                <div class="icon">
                                    <img src="assets/images/index-11/plan/business.svg" height="30" width="30"
                                        alt="">
                                </div>
                                <h4 class="package__name">Business</h4>
                            </div>
                            <p class="card-plan__desc">Everything need to your website</p>
                            <h5 class="card-plan__price">
                                <sup>$</sup> 103.63 <sub>/ month</sub>
                            </h5>
                            <div class="card-plan__cartbtn">
                                <a href="#">add to cart</a>
                            </div>
                            <p class="card-plan__renew-price">
                                $ 235.99 /mo when you renew
                            </p>
                            <div class="card-plan__feature">
                                <ul class="card-plan__feature--list">
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 1 Website</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Explore, discover, and learn on our innovative and informative website."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Standard
                                            Performance</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Unlock superior online experiences with our standard performance solutions, ensuring reliability, speed, and seamless functionality for your website needs."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 24/7/365
                                            Support</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie provides reliable 24/7 support for your hosting needs, ensuring assistance whenever you require help."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-xmark"></i> Free Email</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie offers complimentary email services, empowering your online communication with reliable and secure free email solutions."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-xmark"></i> Unlimited
                                            Bandwidth</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie provides unlimited bandwidth, ensuring seamless data transfer for your website's optimal performance and user experience."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 100 GB SSD
                                            Storage</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Elevate your online presence with Hostie, offering unlimited bandwidth for your domain, ensuring optimal performance and seamless data flow."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>


                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free
                                            SSL</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime
                                            Guarantee</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Web Application
                                            Firewall</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-trigered">
                                        <span class="text">More Features <i
                                                class="fa-sharp fa-regular fa-chevron-down"></i>
                                        </span>
                                    </li>
                                </ul>
                                <ul class="card-plan__feature--list more__feature" style="display: none;">
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 100 GB SSD
                                            Storage</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie offers generous hosting with 100GB SSD storage, providing ample space for your data and ensuring high-performance storage solutions."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free
                                            SSL</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime
                                            Guarantee</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-xmark"></i> Web Application
                                            Firewall</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-trigered">
                                        <span class="text">See less Features <i
                                                class="fa-sharp fa-regular fa-chevron-up"></i>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- single card end -->
                    <!-- single card -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card-plan ">
                            <div class="card-plan__package">
                                <div class="icon">
                                    <img src="assets/images/index-11/plan/cloud.svg" height="30" width="30"
                                        alt="">
                                </div>
                                <h4 class="package__name">Cloud Startup</h4>
                            </div>
                            <p class="card-plan__desc">Everything need to your website</p>
                            <h5 class="card-plan__price">
                                <sup>$</sup> 139.63 <sub>/ month</sub>
                            </h5>
                            <div class="card-plan__cartbtn">
                                <a href="#">add to cart</a>
                            </div>
                            <p class="card-plan__renew-price">
                                $ 353.99 /mo when you renew
                            </p>
                            <div class="card-plan__feature">
                                <ul class="card-plan__feature--list">
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 1 Website</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Explore, discover, and learn on our innovative and informative website."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Standard
                                            Performance</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Unlock superior online experiences with our standard performance solutions, ensuring reliability, speed, and seamless functionality for your website needs."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 24/7/365
                                            Support</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie provides reliable 24/7 support for your hosting needs, ensuring assistance whenever you require help."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Free Email</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie offers complimentary email services, empowering your online communication with reliable and secure free email solutions."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Unlimited
                                            Bandwidth</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie provides unlimited bandwidth, ensuring seamless data transfer for your website's optimal performance and user experience."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 100 GB SSD
                                            Storage</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Elevate your online presence with Hostie, offering unlimited bandwidth for your domain, ensuring optimal performance and seamless data flow."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>


                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free
                                            SSL</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime
                                            Guarantee</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Web Application
                                            Firewall</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-trigered">
                                        <span class="text">More Features <i
                                                class="fa-sharp fa-regular fa-chevron-down"></i>
                                        </span>
                                    </li>
                                </ul>
                                <ul class="card-plan__feature--list more__feature" style="display: none;">
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 100 GB SSD
                                            Storage</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie offers generous hosting with 100GB SSD storage, providing ample space for your data and ensuring high-performance storage solutions."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free
                                            SSL</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime
                                            Guarantee</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-item">
                                        <span class="text"><i class="fa-regular fa-check"></i> Web Application
                                            Firewall</span>
                                        <span class="tolltip" data-bs-toggle="tooltip"
                                            data-bs-custom-class="pricing-eleven" data-bs-placement="bottom"
                                            data-bs-original-title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i
                                                class="fa-light fa-circle-question"></i></span>
                                    </li>
                                    <li class="card-plan__feature--list-trigered">
                                        <span class="text">See less Features <i
                                                class="fa-sharp fa-regular fa-chevron-up"></i>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- single card end -->
                </div>
            </div>
        </div>
    </div>
</div>
