<?php

class ModelShippingCourier extends Model {

    function getQuote($address) {
        $this->load->language('shipping/courier');

        if ($this->config->get('courier_status')) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int) $this->config->get('courier_geo_zone_id') . "' AND country_id = '" . (int) $address['country_id'] . "' AND (zone_id = '" . (int) $address['zone_id'] . "' OR zone_id = '0')");

            if (!$this->config->get('courier_geo_zone_id')) {
                $status = TRUE;
            } elseif ($query->num_rows) {
                $status = TRUE;
            } else {
                $status = FALSE;
            }
        } else {
            $status = FALSE;
        }

        $method_data = array();

        if ($status) {
            $quote_data = array();

            $cost = 0.00;
            if ($this->config->get('courier_min_total_for_free_delivery') > $this->cart->getSubTotal()) {
                $cost = $this->config->get('courier_delivery_price');
            }

            $quote_data['courier'] = array(
                'id' => 'courier.courier',
                'title' => $this->language->get('text_description'),
                'cost' => $cost,
                'tax_class_id' => 0,
                'text' => $this->currency->format($cost)
            );

            $method_data = array(
                'id' => 'courier',
                'title' => $this->language->get('text_title'),
                'quote' => $quote_data,
                'sort_order' => $this->config->get('courier_sort_order'),
                'error' => FALSE
            );
        }

        return $method_data;
    }

}

?>