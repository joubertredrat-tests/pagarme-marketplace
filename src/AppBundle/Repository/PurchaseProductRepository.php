<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Repository;

use AppBundle\Entity\PurchaseProduct;
use Doctrine\ORM\EntityRepository;

/**
 * PurchaseProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 *
 * @package AppBundle\Repository
 */
class PurchaseProductRepository extends EntityRepository
{
    /**
     * Add PurchaseProduct to database
     *
     * @param PurchaseProduct $purchaseProduct
     * @return void
     */
    public function add(PurchaseProduct $purchaseProduct): void
    {
        $em = $this->getEntityManager();
        $em->persist($purchaseProduct);
        $em->flush();
    }

    /**
     * Update PurchaseProduct on database
     *
     * @param PurchaseProduct $purchaseProduct
     * @return PurchaseProduct
     */
    public function update(PurchaseProduct $purchaseProduct): PurchaseProduct
    {
        $em = $this->getEntityManager();
        $em->persist($purchaseProduct);
        $em->flush($purchaseProduct);

        return $purchaseProduct;
    }

    /**
     * Delete PurchaseProduct on database
     *
     * @param PurchaseProduct $purchaseProduct
     * @return bool
     */
    public function delete(PurchaseProduct $purchaseProduct): bool
    {
        $em = $this->getEntityManager();
        $em->remove($purchaseProduct);
        $em->flush($purchaseProduct);

        return true;
    }
}
