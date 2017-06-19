<?php
/**
 * Pagar.me develop exam
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 * @copyright 2017, Pagar.me
 * @link https://pagar.me
 */

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProductType
 *
 * @package AppBundle\Form
 */
class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('manufacturer', EntityType::class, [
                'class' => 'AppBundle\Entity\Manufacturer',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er
                        ->createQueryBuilder('m')
                        ->orderBy('m.name', 'ASC')
                    ;
                },
                'choice_label' => 'name',
            ])
            ->add('Submit', SubmitType::class, [
                'attr' => ['class' => 'ui button'],
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Product',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_product';
    }


}
