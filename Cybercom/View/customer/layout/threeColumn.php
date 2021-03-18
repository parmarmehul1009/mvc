<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script type="text/javascript" src="<?php echo $this->baseUrl('skin/admin/admin/js/jquery-3.6.0.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $this->baseUrl('skin/admin/admin/js/mage.js') ?>"></script>
    <link rel="stylesheet" href="./skin/admin/mage/css/style.css">


    <title></title>
</head>

<body>
    <div id="gridHtml">

    </div>
    <div>
        <div class="header">
            <?php echo ($this->getChild('header')->toHtml()); ?>
        </div>
        <div class="mt-2" style="height:700px">
            <div class="d-flex justify-content-around row mb-3">
                <div class="col-md-2">
                    <?php echo ($this->getChild('left')->toHtml()); ?>
                </div>
                <div class="col-md-8">
                    <?php echo ($this->createBlock('Block\Core\Layout\Message')->toHtml()); ?>
                    <?php echo ($this->getChild('content')->toHtml()); ?>
                </div>
                <div class="col-md-2">
                    <?php echo ($this->getChild('right')->toHtml()); ?>
                </div>
            </div>
        </div>
        <div>
            <?php echo ($this->getChild('footer')->toHtml()); ?>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>