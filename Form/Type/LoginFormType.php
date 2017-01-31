<?php

namespace FOS\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Christian Gripp <mail@core23.de>
 */
final class LoginFormType extends AbstractType
{
    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array(
                'label' => 'security.login.username',
                'translation_domain' => 'FOSUserBundle'
            ))
            ->add('_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), array(
                'label' => 'security.login.password',
                'translation_domain' => 'FOSUserBundle',
            ))
            ->add('_remember_me', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\CheckboxType'), array(
                'label' => 'security.login.remember_me',
                'translation_domain' => 'FOSUserBundle',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'csrf_token_id' => 'login',
            // BC for SF < 2.8
            'intention' => 'login',
        ));
    }

    // BC for SF < 3.0
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fos_user_login';
    }
}
