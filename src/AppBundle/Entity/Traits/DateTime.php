<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Entity\Traits;

/**
 * Trait DateTime
 *
 * @package AppBundle\Entity\Traits
 */
trait DateTime
{
    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * set createdAt datetime
     *
     * @return void
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * set updatedAt datetime
     *
     * @return void
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now');
    }
}
