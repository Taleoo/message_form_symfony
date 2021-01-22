<?php 


namespace App\Form\Type;

use App\Entity\TEmail;
use App\Form\TMsgType;
use App\Form\TPersonType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;




class EmailForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
      /*
        Custom builder for the first form, getting through TEmail entity to get to TPerson and TMsg
      */
        $builder
            ->add('Email', EmailType::class)
            ->add('tpeople', CollectionType::class, [
              'entry_type' => TPersonType::class,
              'entry_options' => ['label' => false],
              'label' => false
          ])
          ->add('tmsgs', CollectionType::class, [
            'entry_type' => TMsgType::class,
            'entry_options' => ['label' => false],
            'label' => false
        ])
            ->add('save', SubmitType::class, [
              'attr' => ['class' => 'btn-primary w-25 mx-auto d-block'],
          ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TEmail::class,
        ]);
  }
}
