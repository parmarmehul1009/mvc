<div class="super_container">
    <!-- Header -->
    <header class="header">
        <!-- Header Main -->
        <div class="header_main">
            <div class="container">
                <div class="row">
                    <!-- Logo -->
                    <div class="col-lg-2 col-sm-3 col-3 order-1">
                        <div class="logo_container">
                            <div class="logo"><a href="#">My Cart</a></div>
                        </div>
                    </div> <!-- Search -->
                    <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                        <div class="header_search">
                            <div class="header_search_content">
                                <div class="header_search_form_container">
                                    <form action="#" class="header_search_form clearfix"> <input type="search" required="required" class="header_search_input" placeholder="Search for products...">
                                        <div class="custom_dropdown" style="display: none;">
                                            <div class="custom_dropdown_list"> <span class="custom_dropdown_placeholder clc">All Categories</span> <i class="fas fa-chevron-down"></i>
                                                <ul class="custom_list clc">
                                                    <li><a class="clc" href="#">All Categories</a></li>
                                                    <li><a class="clc" href="#">Computers</a></li>
                                                    <li><a class="clc" href="#">Laptops</a></li>
                                                    <li><a class="clc" href="#">Cameras</a></li>
                                                    <li><a class="clc" href="#">Hardware</a></li>
                                                    <li><a class="clc" href="#">Smartphones</a></li>
                                                </ul>
                                            </div>
                                        </div> <button type="submit" class="header_search_button trans_300" value="Submit"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918770/search.png" alt=""></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Wishlist -->
                    <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                        <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                            <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                                <div class="wishlist_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918681/heart.png" alt=""></div>
                                <div class="wishlist_content">
                                    <div class="wishlist_text"><a href="#">Wishlist</a></div>
                                    <div class="wishlist_count">10</div>
                                </div>
                            </div> <!-- Cart -->
                            <div class="cart">
                                <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                    <div class="cart_icon"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918704/cart.png" alt="">
                                        <div class="cart_count"><span>3</span></div>
                                    </div>
                                    <div class="cart_content">
                                        <div class="cart_text"><a href="#">Cart</a></div>
                                        <div class="cart_price">$185</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Main Navigation -->
        <nav class="main_nav">
            <div class="row">
                <div class="col">
                    <div class="main_nav_content d-flex flex-row">
                        <!-- Categories Menu -->
                        <!-- Main Nav Menu -->
                        <div class="main_nav_menu">
                            <ul class="standard_dropdown main_nav_dropdown">
                                <li class="hassubs"> <button onclick="mage.setUrl('<?php echo $this->getUrl('index', 'admin_index', ['p' => 1]) ?>').resetPrams().load();">Home</button></li>
                                <li class="hassubs"> <button onclick="mage.setUrl('<?php echo $this->getUrl('grid', 'admin_admin', ['p' => 1]) ?>').resetPrams().load();">Admin</button></li>
                                <li class="hassubs"> <button onclick="mage.setUrl('<?php echo $this->getUrl('grid', 'admin_customer_Group') ?>').resetPrams().load();">Customer Group</button></li>
                                <li class="hassubs"> <button onclick="mage.setUrl('<?php echo $this->getUrl('grid', 'admin_product', ['p' => 1]) ?>').resetPrams().load();">Product</button></li>
                                <li class="hassubs"> <button onclick="mage.setUrl('<?php echo $this->getUrl('grid', 'admin_category', ['p' => 1]) ?>').resetPrams().load();">Category</button></li>
                                <li class="hassubs"> <button onclick="mage.setUrl('<?php echo $this->getUrl('grid', 'admin_customer', ['p' => 1]) ?>').resetPrams().load();">Customer</button></li>
                                <li class="hassubs"> <button onclick="mage.setUrl('<?php echo $this->getUrl('grid', 'admin_shipping', ['p' => 1]) ?>').resetPrams().load();">Shipping</button></li>
                                <li class="hassubs"> <button onclick="mage.setUrl('<?php echo $this->getUrl('grid', 'admin_payment', ['p' => 1]) ?>').resetPrams().load();">Payment</button></li>
                                <li class="hassubs"> <button onclick="mage.setUrl('<?php echo $this->getUrl('grid', 'admin_cMSPages', ['p' => 1]) ?>').resetPrams().load();">CMS Pages</button></li>
                                <li class="hassubs"> <button onclick="mage.setUrl('<?php echo $this->getUrl('grid', 'admin_attribute', ['p' => 1]) ?>').resetPrams().load();">Attribute</button></li>
                                <li class="hassubs"> <button onclick="mage.setUrl('<?php echo $this->getUrl('grid', 'admin_brand', ['p' => 1]) ?>').resetPrams().load();">Brand</button></li>
                                <li class="hassubs"> <button onclick="mage.setUrl('<?php echo $this->getUrl('grid', 'admin_cart', ['p' => 1]) ?>').resetPrams().load();">Cart</button></li>
                            </ul>
                        </div>
                        <!-- <div class="top_bar_user">
                                <div class="user_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918647/user.svg" alt=""></div>
                                <div><a href="<?php// echo $this->getUrl('form', 'admin') ?>">Register</a></div>
                                <div><a href="#">Sign in</a></div>
                            </div>Menu Trigger -->

                    </div>
                </div>
            </div>
        </nav> <!-- Menu -->
        <div class="page_menu">

        </div>
    </header>
</div>