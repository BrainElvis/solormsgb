<?php

class Cart {

    var $CI;

    function __construct() {
        $this->CI = & get_instance();
    }

    function get_cart() {
        if (!$this->CI->session->userdata('cart'))
            $this->set_cart(array());

        return $this->CI->session->userdata('cart');
    }

    function set_cart($cart_data) {
        $this->CI->session->set_userdata('cart', $cart_data);
    }

    function empty_cart() {
        $this->CI->session->unset_userdata('cart');
    }

    function add_item($item_id, $quantity = 1, $item_location, $discount = 0, $price = null, $description = null, $serialnumber = null) {
        //make sure item exists	     
        if ($this->validate_item($item_id) == false) {
            return false;
        }

        // Serialization and Description
        //Get all items in the cart so far...
        $items = $this->get_cart();

        //We need to loop through all items in the cart.
        //If the item is already there, get it's key($updatekey).
        //We also need to get the next key that we are going to use in case we need to add the
        //item to the cart. Since items can be deleted, we can't use a count. we use the highest key + 1.

        $maxkey = 0;                       //Highest key so far
        $itemalreadyinsale = FALSE;        //We did not find the item yet.
        $insertkey = 0;                    //Key to use for new entry.
        $updatekey = 0;                    //Key to use to update(quantity)
        $item_info = $this->CI->Item->get_info($item_id, $item_location);
        foreach ($items as $item) {
            //We primed the loop so maxkey is 0 the first time.
            //Also, we have stored the key in the element itself so we can compare.

            if ($maxkey <= $item['line']) {
                $maxkey = $item['line'];
            }

            if ($item['item_id'] == $item_id && $item['item_location'] == $item_location) {
                $itemalreadyinsale = TRUE;
                $updatekey = $item['line'];
                if (!$item_info->is_serialized) {
                    $quantity += $items[$updatekey]['quantity'];
                }
            }
        }

        $insertkey = $maxkey + 1;
        //array/cart records are identified by $insertkey and item_id is just another field.
        $price = $price != null ? $price : $item_info->unit_price;
        $total = $this->get_item_total($quantity, $price, $discount);
        $discounted_total = $this->get_item_total($quantity, $price, $discount, TRUE);
        //Item already exists and is not serialized, add to quantity
        if (!$itemalreadyinsale || $item_info->is_serialized) {
            $item = array(($insertkey) =>
                array(
                    'item_id' => $item_id,
                    'item_location' => $item_location,
                    'stock_name' => $this->CI->Stock_location->get_location_name($item_location),
                    'line' => $insertkey,
                    'name' => $item_info->name,
                    'item_number' => $item_info->item_number,
                    'description' => $description != null ? $description : $item_info->description,
                    'serialnumber' => $serialnumber != null ? $serialnumber : '',
                    'allow_alt_description' => $item_info->allow_alt_description,
                    'is_serialized' => $item_info->is_serialized,
                    'quantity' => $quantity,
                    'discount' => $discount,
                    'in_stock' => $this->CI->Item_quantity->get_item_quantity($item_id, $item_location)->quantity,
                    'price' => $price,
                    'total' => $total,
                    'discounted_total' => $discounted_total,
                )
            );
            //add to existing array
            $items+=$item;
        } else {
            $line = &$items[$updatekey];
            $line['quantity'] = $quantity;
            $line['total'] = $total;
            $line['discounted_total'] = $discounted_total;
        }

        $this->set_cart($items);

        return true;
    }

    function get_taxes() {
        //Do not charge sales tax if we have a customer that is not taxable
        if (!$this->is_customer_taxable()) {
            return array();
        }

        $taxes = array();
        foreach ($this->get_cart() as $line => $item) {
            $tax_info = $this->CI->Item_taxes->get_info($item['item_id']);

            foreach ($tax_info as $tax) {
                $name = to_tax_decimals($tax['percent']) . '% ' . $tax['name'];
                $tax_amount = $this->get_item_tax($item['quantity'], $item['price'], $item['discount'], $tax['percent']);

                if (!isset($taxes[$name])) {
                    $taxes[$name] = 0;
                }

                $taxes[$name] = bcadd($taxes[$name], $tax_amount, PRECISION);
            }
        }

        return $taxes;
    }

    function get_discount() {
        $discount = 0;
        foreach ($this->get_cart() as $line => $item) {
            if ($item['discount'] > 0) {
                $item_discount = $this->get_item_discount($item['quantity'], $item['price'], $item['discount']);
                $discount = bcadd($discount, $item_discount, PRECISION);
            }
        }

        return $discount;
    }

    function get_subtotal($include_discount = FALSE, $exclude_tax = FALSE) {
        $subtotal = $this->calculate_subtotal($include_discount, $exclude_tax);
        return to_currency_no_money($subtotal);
    }

    function get_item_total_tax_exclusive($item_id, $quantity, $price, $discount_percentage, $include_discount = FALSE) {
        $tax_info = $this->CI->Item_taxes->get_info($item_id);
        $item_price = $this->get_item_total($quantity, $price, $discount_percentage, $include_discount);
        // only additive tax here
        foreach ($tax_info as $tax) {
            $tax_percentage = $tax['percent'];
            $item_price = bcsub($item_price, $this->get_item_tax($quantity, $price, $discount_percentage, $tax_percentage), PRECISION);
        }

        return $item_price;
    }

    function get_item_total($quantity, $price, $discount_percentage, $include_discount = FALSE) {
        $total = bcmul($quantity, $price, PRECISION);
        if ($include_discount) {
            $discount_amount = $this->get_item_discount($quantity, $price, $discount_percentage);

            return bcsub($total, $discount_amount, PRECISION);
        }

        return $total;
    }

    function get_item_discount($quantity, $price, $discount_percentage) {
        $total = bcmul($quantity, $price, PRECISION);
        $discount_fraction = bcdiv($discount_percentage, 100, PRECISION);

        return bcmul($total, $discount_fraction, PRECISION);
    }

    function get_item_tax($quantity, $price, $discount_percentage, $tax_percentage) {
        $price = $this->get_item_total($quantity, $price, $discount_percentage, TRUE);

        if ($this->CI->config->config['tax_included']) {
            $tax_fraction = bcadd(100, $tax_percentage, PRECISION);
            $tax_fraction = bcdiv($tax_fraction, 100, PRECISION);
            $price_tax_excl = bcdiv($price, $tax_fraction, PRECISION);
            return bcsub($price, $price_tax_excl, PRECISION);
        }
        $tax_fraction = bcdiv($tax_percentage, 100, PRECISION);

        return bcmul($price, $tax_fraction, PRECISION);
    }

    function calculate_subtotal($include_discount = FALSE, $exclude_tax = FALSE) {
        $subtotal = 0;
        foreach ($this->get_cart() as $item) {
            if ($exclude_tax && $this->CI->config->config['tax_included']) {
                $subtotal = bcadd($subtotal, $this->get_item_total_tax_exclusive($item['item_id'], $item['quantity'], $item['price'], $item['discount'], $include_discount), PRECISION);
            } else {
                $subtotal = bcadd($subtotal, $this->get_item_total($item['quantity'], $item['price'], $item['discount'], $include_discount), PRECISION);
            }
        }

        return $subtotal;
    }

    function get_total() {
        $total = $this->calculate_subtotal(TRUE);
        if (!$this->CI->config->config['tax_included']) {
            foreach ($this->get_taxes() as $tax) {
                $total = bcadd($total, $tax, PRECISION);
            }
        }

        return to_currency_no_money($total);
    }

}
