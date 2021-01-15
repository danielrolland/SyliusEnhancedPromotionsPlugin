<?php

namespace DanielRolland\SyliusEnhancedPromotionsPlugin\Promotion\Checker;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\OrderItemInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Promotion\Checker\Rule\RuleCheckerInterface;
use Sylius\Component\Promotion\Exception\UnsupportedTypeException;
use Sylius\Component\Promotion\Model\PromotionSubjectInterface;

class ProductQuantityRuleChecker implements RuleCheckerInterface
{

    public const TYPE = 'product_quantity';

    public function isEligible(PromotionSubjectInterface $subject, array $configuration): bool
    {
        if (!$subject instanceof OrderInterface) {
            throw new UnsupportedTypeException($subject, OrderInterface::class);
        }
        /** @var OrderItemInterface $item */
        foreach ($subject->getItems() as $item) {
            if (!($configuration['product'] instanceof ProductInterface)) {
                throw new UnsupportedTypeException($configuration['product'], ProductInterface::class);
            }
            if ($configuration['product']->getCode() === $item->getProduct()->getCode()
                && $configuration['quantity'] <= $item->getQuantity()) {
                return true;
            }
        }

        return false;
    }
}
