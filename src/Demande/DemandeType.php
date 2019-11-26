<?php

namespace App\Demande;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use App\Entity\Moisrtt;
use App\Entity\Demande;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class DemandeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {



        $this->image_url = $options['image_url'];
        $this->slug      = $options['slug'];

        $builder
            # Champ TITLE
            ->add('title', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => "Titre de l'Demande"
                ]
            ])
        ;

        if ($this->slug) {

            $builder
                ->add('slug', TextType::class, [
                    'required' => true,
                    'label' => false,
                    'attr' => [
                        'placeholder' => "Slug de l'Demande"
                    ]
                ])
            ;

        }

        $builder
            # Champ CONTENT
            ->add('content', CKEditorType::class, [
                'required' => true,
                'label' => false
            ])
            
            # Champ DATE_CONGE_DEBUT
            ->add('dateCongeDebut', DateType::class, [
                'required' => true,
                'widget' => 'choice',
                'input'  => 'datetime_immutable'
            ])

            # Champ DATE_CONGE_FIN
            ->add('dateCongeFin', DateType::class, [
                'required' => true,
                'widget' => 'choice',
                'input'  => 'datetime_immutable'
            ])

            # Champ days
            ->add('days', NumberType::class, [
                'required' => false
            ])

                
            # Champ if_evenement_familial
            ->add('ifEvenementFamilial', CheckboxType::class, [
                'label'    => 'Evènement familial (mariage, naissance, décès)',
                'required' => false,
                'attr' => ['class' => 'tinymce'],
            ])
            # Champ jours_evenement_familial
            ->add('joursEvenementFamilial', NumberType::class, [
                'required' => false
            ])
            # Champ nature_evenement_familial
            ->add('natureEvenementFamilial', TextType::class, [
                'required' => false,
                'label' => 'nature de l\'événement'
            ])

            # Champ date_evenement_familial
            ->add('dateEvenementFamilial', DateType::class, [
                'widget' => 'choice'
            ])

            # Champ FEATUREDIMAGE
            ->add('featuredImage', FileType::class, [
                'required' => false,
                'label' => false
            ])

            # Champ if_conge_paye
            ->add('ifCongePaye', CheckboxType::class, [
                'label'    => 'Congés payés',
                'required' => false,
            ])
            # Champ jours_conge_paye
            ->add('joursCongePaye', NumberType::class, [
                'required' => false
            ])



            # Champ if_rtt
            ->add('ifRtt', CheckboxType::class, [
                'label'    => 'RTT',
                'required' => false,
            ])

            # Champ janvier
            ->add('janvier', CheckboxType::class, [
                'label'    => 'Janvier',
                'required' => false,
            ])

            # Champ fevrier
            ->add('fevrier', CheckboxType::class, [
                'label'    => 'Février',
                'required' => false,
            ])

            # Champ mars
            ->add('mars', CheckboxType::class, [
                'label'    => 'Mars',
                'required' => false,
            ])

            # Champ avril
            ->add('avril', CheckboxType::class, [
                'label'    => 'Avril',
                'required' => false,
            ])

            # Champ mai
            ->add('mai', CheckboxType::class, [
                'label'    => 'Mai',
                'required' => false,
            ])

            # Champ juin
            ->add('juin', CheckboxType::class, [
                'label'    => 'Juin',
                'required' => false,
            ])

            # Champ juillet
            ->add('juillet', CheckboxType::class, [
                'label'    => 'Juillet',
                'required' => false,
            ])
            # Champ aout
            ->add('aout', CheckboxType::class, [
                'label'    => 'Août',
                'required' => false,
            ])

            # Champ septembre
            ->add('septembre', CheckboxType::class, [
                'label'    => 'Septembre',
                'required' => false,
            ])

            # Champ octobre
            ->add('octobre', CheckboxType::class, [
                'label'    => 'Octobre',
                'required' => false,
            ])

            # Champ novembre
            ->add('novembre', CheckboxType::class, [
                'label'    => 'Novembre',
                'required' => false,
            ])

            # Champ decembre
            ->add('decembre', CheckboxType::class, [
                'label'    => 'Decembre',
                'required' => false,
            ])



            # Champ if_conge_sans_solde
            ->add('ifCongeSansSolde', CheckboxType::class, [
                'label'    => 'Congé sans solde pour motif personnel',
                'required' => false,
            ])

            # Champ jours_conge_sans_solde
            ->add('joursCongeSansSolde', NumberType::class, [
                'required' => false
            ])
            

            # Champ if_autre
            ->add('ifAutre', CheckboxType::class, [
                'label'    => 'Autre',
                'required' => false,
            ])
            # Champ jours_autre
            ->add('joursAutre', NumberType::class, [
                'required' => false
            ])



            # Bouton Submit
            ->add('submit', SubmitType::class, [
                'label' => 'Publier mon Demande'
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            //'data_class' => Demande::class,
            'data_class' => DemandeRequest::class,
            'image_url' => null,
            'slug' => null
        ]);
    }

}