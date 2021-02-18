<?php


namespace Andyts93\GMerchantCenter;


class Shipping
{
    use HasAttibutes;

    public function setCountry($countryCode)
    {
        $this->setAttribute('country', $countryCode);
        return $this;
    }

    public function setRegion($region)
    {
        $this->setAttribute('region', $region);
        return $this;
    }

    public function setPostalCode($postalCode)
    {
        $this->setAttribute('postal_code', $postalCode);
        return $this;
    }

    public function setLocationId($locationId)
    {
        $this->setAttribute('location_id', $locationId);
        return $this;
    }

    public function setLocationGroupName($locationGroupName)
    {
        $this->setAttribute('location_group_name', $locationGroupName);
        return $this;
    }

    public function setService($service)
    {
        $this->setAttribute('service', $service);
        return $this;
    }

    public function setPrice($price, $currency = 'EUR')
    {
        $this->setAttribute('price', number_format($price, 2, '.', '') . ' ' . $currency);
        return $this;
    }
}
