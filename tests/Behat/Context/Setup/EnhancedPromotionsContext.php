<?php

namespace Tests\DanielRolland\SyliusEnhancedPromotionsPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use DanielRolland\SyliusEnhancedPromotionsPlugin\Promotion\Checker\ProductQuantityRuleChecker;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Core\Factory\PromotionActionFactoryInterface;
use Sylius\Component\Core\Factory\PromotionRuleFactoryInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\PromotionInterface;
use Sylius\Component\Promotion\Model\PromotionActionInterface;
use Sylius\Component\Promotion\Model\PromotionRuleInterface;

class EnhancedPromotionsContext implements Context
{
    /** @var PromotionRuleFactoryInterface */
    private $ruleFactory;

    /** @var SharedStorageInterface */
    private $sharedStorage;

    /** @var PromotionActionFactoryInterface */
    private $actionFactory;

    /** @var ObjectManager */
    private $objectManager;

    /**
     * EnhancedPromotionsContext constructor.
     * @param PromotionRuleFactoryInterface $ruleFactory
     * @param SharedStorageInterface $sharedStorage
     * @param PromotionActionFactoryInterface $actionFactory
     * @param ObjectManager $objectManager
     */
    public function __construct(PromotionRuleFactoryInterface $ruleFactory, SharedStorageInterface $sharedStorage, PromotionActionFactoryInterface $actionFactory, ObjectManager $objectManager)
    {
        $this->ruleFactory = $ruleFactory;
        $this->sharedStorage = $sharedStorage;
        $this->actionFactory = $actionFactory;
        $this->objectManager = $objectManager;
    }


    /**
     * @Given /^([^"]+) gives ("(?:€|£|\$)[^"]+") off each product if order has (\d+) quantity of (product "[^"]+")$/
     * @param PromotionInterface $promotion
     * @param $discount
     * @param $quantity
     * @param $product
     */
    public function thePromotionGivesOffIfOrderHasQuantityOfProduct(PromotionInterface $promotion, $discount, $quantity, ProductInterface $product): void
    {
        /** @var PromotionRuleInterface $rule */
        $rule = $this->ruleFactory->createNew();
        $rule->setType(ProductQuantityRuleChecker::TYPE);
        $rule->setConfiguration(['product' => $product, 'quantity' => $quantity]);

        $this->createUnitFixedPromotion($promotion, $discount, $this->getProductsFilterConfiguration([$product->getCode()]), $rule);
    }

    /**
     * @param PromotionInterface $promotion
     * @param $discount
     * @param array $configuration
     * @param PromotionRuleInterface|null $rule
     */
    private function createUnitFixedPromotion(PromotionInterface $promotion, $discount, array $configuration = [], PromotionRuleInterface $rule = null): void
    {

        $channelCode = $this->sharedStorage->get('channel')->getCode();

        $this->persistPromotion(
            $promotion,
            $this->actionFactory->createUnitFixedDiscount($discount, $channelCode),
            [$channelCode => $configuration],
            $rule
        );
    }

    /**
     * @param array $productCodes
     * @return array
     */
    private function getProductsFilterConfiguration(array $productCodes): array
    {
        return ['filters' => ['products_filter' => ['products' => $productCodes]]];
    }

    private function persistPromotion(PromotionInterface $promotion, PromotionActionInterface $action, array $configuration, PromotionRuleInterface $rule = null): void
    {
        $configuration = array_merge_recursive($action->getConfiguration(), $configuration);
//        dump($configuration);
        $action->setConfiguration($configuration);

        $promotion->addAction($action);
        if (null !== $rule) {
            $promotion->addRule($rule);
        }

        $this->objectManager->flush();
    }

}
