<?php
namespace PMS\Bundle\CoreBundle\Menu;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\ExpressionLanguage\Expression;

class MenuBuilder extends \PMS\Bundle\CoreBundle\Menu\BaseBuilder
{
    
    public function getMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');
        
        // homepage
        $menu->addChild(
            'home',
            array('route' => 'homepage')
        );
        
        // my projects
        if ($this->securityContext->isGranted(
            new Expression(
                '"ROLE_CLIENT" in roles or "ROLE_DEVELOPER" in roles'
            )
        )) {
            $menu->addChild($this->myProjectMenu($request));
        }
        
        // projects
        $menu->addChild($this->projectsMenu($request));
        
        // auth | profile
        if (!$this->securityContext->isGranted('ROLE_USER')) {
            $menu->addChild(
                'sign up',
                array('route' => 'fos_user_register_index')
            );

            $menu->addChild(
                'sign in',
                array('route' => 'fos_user_security_login')
            );
        } else {
            $menu->addChild($this->profileMenu($request));
        }
    
        return $menu;
    }
    
    /**
     * My projects menu
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return MenuItem
     */
    public function myProjectsMenu(Request $request)
    {
        $menu = $this->factory->createItem('my projects');
        
        // list projects
        $menu->addChild(
            'list projects',
            array(
                'route' => 'pms_project_by_user_index',
                'routeParameters' => array('slug' => $this->securityContext->getSlug())
            )
        );
        
        // add a project
        if ($this->securityContext->isGranted('ROLE_DEVELOPER_ADMIN')) {
            $menu->addChild(
                'add a project',
                array(
                    'route' => 'pms_project_new'
                )
            );
        }
        
        return $menu;
    }
    
    /**
     * Projects menu
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return MenuItem
     */
    public function projectsMenu(Request $request)
    {
        $menu = $this->factory->createItem('projects');
        
        // list
        $menu->addChild(
            'list projects',
            array('route' => 'pms_project_index')
        );
        
        // search
        $menu->addChild(
            'search projects',
            array('route' => 'pms_project_search')
        );
        
        return $menu;
    }
    
    /**
     * Profile menu
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return MenuItem 
     */
    public function profileMenu(Request $request)
    {
        $menu = $this->factory->createItem('profile')
            ->setAttribute('dropdown', true)
            ->setAttribute('icon', 'icon-user');

        // view profile
        $menu->addChild(
            'view profile',
            array(
                'route' => 'fos_user_profile_show',
                'routeParameters' => array(
                    'slug' => $this->securityContext->getSlug()
                )
            )
        );

        // edit profile
        $menu->addChild(
            'edit profile',
            array(
                'route' => 'fos_user_profile_edit',
                'routeParameters' => array(
                    'slug' => $this->securityContext->getSlug()
                )
            )
        );

        // change password
        $menu->addChild(
            'change password',
            array('route' => 'fos_user_change_password')
        );
        
        // sign out
        $menu->addChild(
            'signout',
            array('route' => 'fos_user_security_logout')
        );
    }
}
