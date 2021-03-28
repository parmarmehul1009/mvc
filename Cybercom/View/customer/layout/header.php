<!-- Start header section -->
<header id="aa-header">
    <!-- start header bottom  -->
    <div class="aa-header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <?php echo $this->getBlock('Block\Customer\Layout\Header\Left')->toHtml(); ?>
                </div>
                <div class="row col-md-2">
                    <?php echo $this->getBlock('Block\Customer\Layout\Header\Right')->toHtml(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- / header bottom  -->
</header>
<!-- / header section -->
<!-- menu -->
<section id="menu">
    <?php echo $this->getBlock('Block\Customer\Layout\Header\Footer')->toHtml(); ?>
</section>
<!-- / menu -->