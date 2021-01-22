<?php
namespace App\Form;

use App\Entity\TMsg;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TMsgType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
      // did not add the fields date and state as they are defaulted every time
        $builder
        ->add('Subject')
        ->add('msg', TextareaType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TMsg::class,
        ]);
    }
}