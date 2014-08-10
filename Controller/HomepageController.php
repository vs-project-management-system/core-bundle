<?php
namespace PMS\Bundle\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomepageController extends \PMS\Bundle\CoreBundle\Controller\Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("PMSResourceBundle:Homepage:index.html.twig")
     */
    public function indexAction(
        $dashboard = true
    ) {
        /**
         * If user is authorized AND user isn't implicitly requesting the welcome pages
         */
        if ($dashboard && $this->get('security.context')->isGranted('ROLE_USER')) {
            $session = $this->get('security.context');
            
            if ($session->isGranted('ROLE_ADMIN')) {
                /**
                 * Admin user
                 */
                $this->forwardToDashboard(
                    ($session->isGranted(' ROLE_SUPER_ADMIN') ? 'ROLE_SUPER_ADMIN' : 'ROLE_ADMIN')
                );
            } else {
                $this->forwardToDashboard('ROLE_USER');
            }
        }
        
        /*
         * If anonymous user OR dashboard was not implicitly requested
         */
        // last username entered by the user
        $lastUsername = (!$this->securityContext->isGranted('ROLE_USER')) ?
                '' :
                $this->securityContext->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->has('form.csrf_provider')
            ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;

        return array(
            'csrf_token' => $csrfToken,
            'last_username' => $lastUsername
        );
    }

    /**
     * @Route("/about", name="pms_about")
     * @return type
     */
    public function aboutAction()
    {
        return $this->render('PMSResourceBundle:Homepage:about.html.twig');
    }

    /**
     * @Route("/help", name="pms_help")
     * @return type
     */
    public function helpAction()
    {
        return $this->render('PMSResourceBundle:Homepage:help.html.twig');
    }

    /**
     * @Route("/contact", name="pms_contact")
     * @return type
     */
    public function contactAction()
    {
        return $this->render('PMSResourceBundle:Homepage:contact.html.twig');
    }
    
    /**
     * Forward to dashboard
     * 
     * @param string $role role
     */
    private function forwardToDashboard($role)
    {
        /**
         * @todo find a cleaner way to match the role to the controller
         *
         * $roles = Yaml::parse($this->locator->locate('security.yml', null, null));
         * $roles = new ArrayCollection($roles['security']['role_hierarchy']);
         */
        $roleEntities = array(
            'ROLE_USER'                 =>  'PMSUserBundle:User:dashboard',
            'ROLE_ADMIN'                =>  'PMSUserBundle:Admin:dashboard',
            'ROLE_SUPER_ADMIN'          =>  'PMSUserBundle:Admin:dashboard'
        );
        $this->forward($roleEntities[$role]);
    }
}
