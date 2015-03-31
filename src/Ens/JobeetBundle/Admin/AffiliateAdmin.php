<?php

namespace Ens\JobeetBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Ens\JobeetBundle\Entity\Affiliate;
use Sonata\AdminBundle\Route\RouteCollection;

class AffiliateAdmin extends Admin {
	protected $datagridValues = array (
			'_sort_order' => 'ASC',
			'_sort_by' => 'isActive',
			'isActive' => array (
					'value' => 2 
			) 
	);
	protected function configureFormFields(FormMapper $formMapper) {
		$formMapper->add ( 'email' )->add ( 'url' );
	}
	protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
		$datagridMapper->add ( 'email' )->add ( 'isActive' );
	}

	public function getBatchActions() {
		$actions = parent::getBatchActions ();
		
		if ($this->hasRoute ( 'edit' ) && $this->isGranted ( 'EDIT' ) && $this->hasRoute ( 'delete' ) && $this->isGranted ( 'DELETE' )) {
			$actions ['activate'] = array (
					'label' => 'Activate',
					'ask_confirmation' => true 
			);
			
			$actions ['deactivate'] = array (
					'label' => 'Deactivate',
					'ask_confirmation' => true 
			);
		}
		
		return $actions;
	}
	protected function configureRoutes(RouteCollection $collection) {
		parent::configureRoutes ( $collection );
		
		$collection->add ( 'activate', $this->getRouterIdParameter () . '/activate' );
		
		$collection->add ( 'deactivate', $this->getRouterIdParameter () . '/deactivate' );
	}
	protected function configureListFields(ListMapper $listMapper) {
		$listMapper->add ( 'isActive' )
							 ->addIdentifier ( 'email' )
							 ->add ( 'url' )
							 ->add ( 'created_at' )
							 ->add ( 'token' )
							 ->add ( '_action', 'actions', array (
				'actions' => array (
						'activate' => array (
								'template' => 'EnsJobeetBundle:AffiliateAdmin:list__action_activate.html.twig' 
						),
						'deactivate' => array (
								'template' => 'EnsJobeetBundle:AffiliateAdmin:list__action_deactivate.html.twig' 
						) 
				) 
		) );
	}
}