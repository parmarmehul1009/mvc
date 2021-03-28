<?php $paymentMethods = $this->getPaymentMethods(); ?>
<?php $shippingMethods = $this->getShippingMethods(); ?>
<?php $billingAddress = $this->getBillingAddress(); ?>
<?php $shippingAddress = $this->getShippingAddress(); ?>
<?php $cart = $this->getCart(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <form action="" method="POST" enctype="multipart/form-data" novalidate>
                <table border="2" class="table" width=100%>
                    <thead class="thead-dark">
                        <tr>
                            <th colspan="2">CheckOut Page</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <table border="1" height="500px" class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th colspan="2" scope="col">Billing Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>First Name</td>
                                            <td><input name="billing1[firstName]" type="text" class="disable1" id="firstName" value="<?php echo $billingAddress->firstName ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Last Name</td>
                                            <td><input name="billing1[lastName]" class="disable1" id="lastName" value="<?php echo $billingAddress->lastName ?>" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td><input name="billing[address]" type="text" class="disable1" id="address" value="<?php echo $billingAddress->address ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td><input name="billing[city]" class="disable1" id="city" value="<?php echo $billingAddress->city ?>" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td>State</td>
                                            <td><input name="billing[state]" class="disable1" id="state" value="<?php echo $billingAddress->state ?>" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td><input name="billing[country]" class="disable1" id="country" value="<?php echo $billingAddress->country ?>" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td>ZipCode</td>
                                            <td><input name="billing[zipCode]" class="disable1" id="zipCode" value="<?php echo $billingAddress->zipCode ?>" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a onclick="mage.setForm(this).setUrl('<?php echo $this->getUrl('saveBilling', 'admin_cart_checkOut') ?>').load()" class="btn btn-warning" href="javascript:void(0)">Save</a>
                                            </td>
                                            <td>
                                                <input class="ml-auto" name="bookAddressBilling" value="1" type="checkbox">
                                                <label for="save">save to address book</label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table border="1" height="500px" class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th colspan="2" scope="col">Shipping Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Same as Billing</td>
                                            <td><input value="1" name="sameAsBilling" type="checkbox"></td>
                                        </tr>
                                        <tr>
                                            <td>First Name</td>
                                            <td><input name="shipping1[firstName]" class="disable" id="firstName" value="<?php echo $shippingAddress->firstName ?>" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td>Last Name</td>
                                            <td><input name="shipping1[lastName]" class="disable" id="lastName" value="<?php echo $shippingAddress->lastName ?>" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td><input name="shipping[address]" type="text" class="disable" id="address" value="<?php echo $shippingAddress->address ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td><input name="shipping[city]" class="disable" id="city" value="<?php echo $shippingAddress->city ?>" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td>State</td>
                                            <td><input name="shipping[state]" class="disable" id="state" value="<?php echo $shippingAddress->state ?>" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td><input name="shipping[country]" class="disable" id="country" value="<?php echo $shippingAddress->country ?>" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td>ZipCode</td>
                                            <td><input name="shipping[zipCode]" class="disable" id="zipCode" value="<?php echo $shippingAddress->zipCode ?>" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a onclick="mage.setForm(this).setUrl('<?php echo $this->getUrl('saveShipping', 'admin_cart_checkOut') ?>').load()" class="btn btn-warning" href="javascript:void(0)">Save</a>
                                            </td>
                                            <td>
                                                <input class="ml-auto" name="bookAddressShipping" value="1" type="checkbox">
                                                <label for="save">save to address book</label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table border="1" class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th colspan="2" scope="col">Payment Method</th>
                                        </tr>
                                        <tr>
                                            <td><b>Select</b></td>
                                            <td><b>Name</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!$paymentMethods) : ?>
                                            <tr>
                                                <td colspan="2">No Payment Method Available</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($paymentMethods->getData() as $paymentMethod) : ?>
                                                <tr>
                                                    <td><input name="paymentMethod" type="radio" value="<?php echo $paymentMethod->methodId ?>" <?php if ($cart->paymentMethodId == $paymentMethod->methodId) : ?> checked <?php endif; ?>></td>
                                                    <td><?php echo $paymentMethod->name ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="2">
                                                <a onclick="mage.setForm(this).setUrl('<?php echo $this->getUrl('savePaymentMethod', 'admin_cart_checkOut') ?>').load()" class="btn btn-warning" href="javascript:void(0)">Save</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table border="1" class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th colspan="3" scope="col">Shipping Method</th>
                                        </tr>
                                        <tr>
                                            <td><b>Select</b></td>
                                            <td><b>Name</b></td>
                                            <td><b>Amount</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!$shippingMethods) : ?>
                                            <tr>
                                                <td colspan="2">No Payment Method Available</td>
                                            </tr>
                                        <?php else : ?>
                                            <?php foreach ($shippingMethods->getData() as $shippingMethod) : ?>
                                                <tr>
                                                    <td><input name="shippingMethod" type="radio" value="<?php echo $shippingMethod->methodId ?>" <?php if ($cart->shippingMethodId == $shippingMethod->methodId) : ?> checked <?php endif; ?>></td>
                                                    <td><?php echo $shippingMethod->name ?></td>
                                                    <td><?php echo $shippingMethod->amount ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="3">
                                                <a onclick="mage.setForm(this).setUrl('<?php echo $this->getUrl('saveShippingMethod', 'admin_cart_checkOut') ?>').load()" class="btn btn-warning" href="javascript:void(0)">Save</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table border="1" class="table">
                                    <thead class="thead-dark">
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>Base Total</b></td>
                                            <td><?php echo $this->getBaseTotal(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Shipping Charges</b></td>
                                            <td><?php echo $this->getShippingCharges(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Grand Total</b></td>
                                            <td><?php echo $this->getGrantTotal(); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function function1() {
        var elements = document.getElementsByClassName('disable');
        $(elements).each(function(i, element) {
            if (element.disabled) {
                // element.value = document.getElementById(element.id).value;
                element.disabled = false;
            } else {
                // element.value = document.getElementById(element.id).value;
                element.disabled = true;
            }
        })
    };
</script>