<?php

namespace AppBundle\Model\Redis;

use AppBundle\Utility;

/**
 *
 */
class User
{

    public $id;
    public $cards;

    /**
     *
     * @param string $id
     * @param array  $cards
     *
     * @return
     */
    public function __construct(
        string $id,
        array  $cards
    ) {

        $this->id    = $id;
        $this->cards = $cards;
    }

    /**
     * @param string $card
     *
     * @return boolean
     */
    public function hasCard(
        string $card
    ) {

        return in_array(
            $card,
            $this->cards,
            true
        );
    }

    /**
     *
     * @param string $card
     *
     * @return boolean
     */
    public function hasAtLeastOneCardOfType(
        string $card
    ) {

        $cardType  = Utility::getCardType($card);
        $cardRange = Utility::getCardRange($card);

        foreach ($this->cards as $value) {
            if ($cardType === Utility::getCardType($value)
                && $cardRange === Utility::getCardRange($value)) {
                return true;
            }
        }

        return false;
    }

    /**
     *
     * @return array
     */
    public function toArray()
    {

        return [
            "id" => $this->id,
            "cards" => $this->cards,
        ];
    }



    //
    // Setters

    /**
     * @param string $card
     *
     * @return User
     */
    public function addCard($card)
    {
        $this->cards[] = $card;

        return $this;
    }

    /**
     * @param string $card
     *
     * @return User
     */
    public function removeCard($card)
    {
        $key = array_search($card, $this->cards);
        if ($key !== false) {
            unset($this->cards[$key]);
        }

        return $this;
    }
}
