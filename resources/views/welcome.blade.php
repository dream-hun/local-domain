<x-app-layout>
    <div class="hero__banner banner__background">
        <div class="container">
            <div class="row">
                <div
                    class="hero__banner__wrapper d-flex flex-wrap flex-lg-nowrap gap-5 gap-lg-0
                align-items-center justify-content-between justify-content-md-center px-5 px-lg-0">

                    <!-- banner content -->
                    <div class="hero__banner__content">
                        <h6 class="mb-0 sal-animate" data-sal="slide-down" data-sal-delay="300" data-sal-duration="800">
                            <span><img src="assets/images/index-11/cloud.svg" alt=""></span>
                            30% Discount first month purchase
                        </h6>
                        <h1 class="heading sal-animate" data-sal="slide-down" data-sal-delay="300"
                            data-sal-duration="800">
                            Premium Hosting for Growing Businesses
                        </h1>
                        <p class="description sal-animate" data-sal="slide-down" data-sal-delay="400"
                            data-sal-duration="800">
                            Discover our cutting-edge cloud hosting solutions designed to elevate your online presence.
                            With lightning-fast performance.
                        </p>
                        <div class="domain__options">
                            <div class="tab__selection mb--20">
                                <nav>
                                    <div class="nav nav-tabs d-flex flex-nowrap" id="nav-tab" role="tablist">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#register"
                                            type="button" role="tab" aria-controls="register"
                                            aria-selected="true">Register</button>
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#transfer"
                                            aria-controls="transfer">Transfer</button>
                                    </div>
                                </nav>
                            </div>

                            <div class="domain__form">
                                <div id="nav-tabcontent" class="tab-content">
                                    <div id="register" class="tab-pane fade active show" role="tabpanel">
                                        <form action="#" class="domain__search d-flex">
                                            <input type="text" placeholder="Enter domain name" required="">
                                            <select name="r" id="r" style="display: none;">
                                                <option value=".com">.com</option>
                                                <option value=".net">.net</option>
                                                <option value=".love">.love</option>
                                                <option value=".pw">.pw</option>
                                                <option value=".org">.org</option>
                                                <option value=".org">.org</option>
                                                <option value=".info">.info</option>
                                                <option value=".info">.info</option>
                                                <option value=".xyz">.xyz</option>
                                            </select>
                                            <div class="nice-select" tabindex="0"><span class="current">.com</span>
                                                <ul class="list">
                                                    <li data-value=".com" class="option selected">.com</li>
                                                    <li data-value=".net" class="option">.net</li>
                                                    <li data-value=".love" class="option">.love</li>
                                                    <li data-value=".pw" class="option">.pw</li>
                                                    <li data-value=".org" class="option">.org</li>
                                                    <li data-value=".org" class="option">.org</li>
                                                    <li data-value=".info" class="option">.info</li>
                                                    <li data-value=".info" class="option">.info</li>
                                                    <li data-value=".xyz" class="option">.xyz</li>
                                                </ul>
                                            </div>
                                            <button type="submit" class="btn__primary">Search</button>
                                        </form>
                                    </div>

                                    <div id="transfer" class="tab-pane fade" role="tabpanel">
                                        <form action="#" class="domain__search d-flex">
                                            <input type="text" placeholder="Enter domain name" required="">
                                            <select name="t" id="t" style="display: none;">
                                                <option value=".com">.com</option>
                                                <option value=".net">.net</option>
                                                <option value=".love">.love</option>
                                                <option value=".pw">.pw</option>
                                                <option value=".org">.org</option>
                                                <option value=".org">.org</option>
                                                <option value=".info">.info</option>
                                                <option value=".info">.info</option>
                                                <option value=".xyz">.xyz</option>
                                            </select>
                                            <div class="nice-select" tabindex="0"><span class="current">.com</span>
                                                <ul class="list">
                                                    <li data-value=".com" class="option selected">.com</li>
                                                    <li data-value=".net" class="option">.net</li>
                                                    <li data-value=".love" class="option">.love</li>
                                                    <li data-value=".pw" class="option">.pw</li>
                                                    <li data-value=".org" class="option">.org</li>
                                                    <li data-value=".org" class="option">.org</li>
                                                    <li data-value=".info" class="option">.info</li>
                                                    <li data-value=".info" class="option">.info</li>
                                                    <li data-value=".xyz" class="option">.xyz</li>
                                                </ul>
                                            </div>
                                            <button type="submit" class="btn__primary">Transfer</button>
                                        </form>
                                    </div>
                                </div>

                            </div>

                            <div class="domain__list d-flex gap-5">
                                <div class="single__domain d-flex gap-1">
                                    <strong>.com</strong>
                                    <span>only $6.19</span>
                                </div>
                                <div class="single__domain d-flex gap-1">
                                    <strong>.org</strong>
                                    <span>only $5.19</span>
                                </div>
                                <div class="single__domain d-flex gap-1">
                                    <strong>.xyz</strong>
                                    <span>only $1</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- banner content end -->

                    <!-- banner image -->
                    <div class="hero__banner__image start-5 position-relative d-flex align-items-end">
                        <figure class="banner__image ">
                            <img src="assets/images/index-11/banner__image.svg" alt="">
                        </figure>
                    </div>
                    <!-- banner image end -->

                </div>
            </div>
        </div>
    </div>
    <x-hosting-plan-component />
</x-app-layout>
