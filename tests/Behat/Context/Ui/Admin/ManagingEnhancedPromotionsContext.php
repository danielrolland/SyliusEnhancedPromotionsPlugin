<?php

namespace Tests\DanielRolland\SyliusEnhancedPromotionsPlugin\Behat\Context\Ui\Admin;
use Behat\Behat\Context\Context;
use Sylius\Behat\Page\Admin\Promotion\CreatePageInterface;

class ManagingEnhancedPromotionsContext implements Context
{
    /** @var CreatePageInterface */
    private $createPage;

    /**
     * ManagingEnhancedPromotionsContext constructor.
     * @param CreatePageInterface $createPage
     */
    public function __construct(CreatePageInterface $createPage)
    {
        $this->createPage = $createPage;
    }

    /**
     * @Given /^I add the "([^"]*)" rule configured with the "([^"]*)" product and "([^"]*)" amount$/
     */
    public function iAddTheRuleConfiguredWithTheProductAndAmount($rule, $product, $amount)
    {
        $this->createPage->addRule($rule);
        $this->createPage->selectAutocompleteRuleOption('Product', $product);
        $this->createPage->fillRuleOption('Count', $amount);
    }
}
