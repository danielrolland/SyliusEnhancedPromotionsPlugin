<?php

namespace DanielRolland\SyliusEnhancedPromotionsPlugin\Form\Type\Rule;
use Sylius\Bundle\ProductBundle\Form\Type\ProductAutocompleteChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductQuantityConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('product', ProductAutocompleteChoiceType::class, [
            'label' => 'sylius.form.promotion_action.add_product_configuration.product',
            'constraints' => new NotBlank(),
        ])->add('quantity', IntegerType::class, [
            'label' => 'sylius.form.promotion_rule.cart_quantity_configuration.count',
            'constraints' => new NotBlank(),
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'sylius_promotion_rule_customer_group_configuration';
    }

}
