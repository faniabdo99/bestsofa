@include('layout.header' , ['PageTitle' => __('titles.about')])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Header Menu Area =================-->
    <section class="banner_area section_gap">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h1>About Us</h1>
                    <p class="text-white">The Wholesale industry revamped !</p>
                </div>
            </div>
        </div>
    </section>
    <section class="about_us_content_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h2 class="text-primary">Welcome to UK Fashion Shop</h2>
            <p>Our range includes trendy affordable clothing, shoes, handballs andaccessories for men, women and children atcompetitive prices.</p>
            <p>The goods are accurately checked according to the wishes of the customer. This is done before packingand sendingto destinations, per package, pallet, containers. All goods are manually checked for quality, pleasekeep in mind ifthere are irregularities.</p>
            <p>Our goal is to organize each customer's specific order as well as possible in order to have the desiredorder forshipment. We do our best to always provide the stock and the availability of the goods.</p>
            <p>We offer help for sending orders if it's within our reach <a href="https://www.ukfashionshop.be/shipping">(Clickhere for shipping prices)</a>. We are also open for customers who arrange their own transport.</p>
            <p>For non-EU countries unfortunately we cannot offer delivery service prices, therefore we request you tocontact usto request a customized quote or surf to <a href="https://www.cheapcargo.be/#!" target="_blank">Cheapcargo</a>.be&nbsp;and request a quote, usually they will be ordered the nextworking day.</p>
            <p>Customers who want to order from 10 tons can state this in the "<a href="https://www.globale-trading.be/contact-us/" target="_blank">contact form</a>" and we will assist.</p>
            <p>Also view our weekly offers on different articles and don't forget our promotions on the website, youwillcertainly find a top deal that suits you.</p>
            <p>The published photos are randomly drawn from our daily production and show the item how it looks beforeor afterpacking.</p>
            <br><br>
            <h2 class="text-primary">UK Fashion Shop is a Global Trading Company</h2>
            <p>Contact Global Trading as Needed</p>
            <ul class="contact_info">
              <li><b>VAT :</b> BE0827774244</li>
              <li><b>Location :</b> Chaussée de Jette 324 , 1081 Koekelberg , Belgium</li>
              <li><b>Call Us :</b> <a href="tel:3252201018">3252201018</a></li>
            </ul>

          </div>
        </div>
      </div>
    </section>
    @include('layout.footer')
    @include('layout.scripts')
</body>

</html>
