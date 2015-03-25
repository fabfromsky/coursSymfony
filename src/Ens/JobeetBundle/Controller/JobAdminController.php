<?php

namespace Ens\JobeetBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery as ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class JobAdminController extends Controller {

	/**
	*@ApiDoc(
	*	resource=true,
	*	description="Extends job validity"
	*)
	*
	*/
	public function batchActionExtend(ProxyQueryInterface $selectedModelQuery) {
		if ($this->admin->isGranted ( 'EDIT' ) === false || $this->admin->isGranted ( 'DELETE' ) === false) {
			throw new AccessDeniedException ();
		}
		
		$request = $this->get ( 'request' );
		$modelManager = $this->admin->getModelManager ();
		
		$selectedModels = $selectedModelQuery->execute ();
		
		try {
			foreach ( $selectedModels as $selectedModel ) {
				$selectedModel->extend ();
				$modelManager->update ( $selectedModel );
			}
		} catch ( \Exception $e ) {
			$this->get ( 'session' )->setFlash ( 'sonata_flash_error', $e->getMessage () );
			
			return new RedirectResponse ( $this->admin->generateUrl ( 'list', $this->admin->getFilterParameters () ) );
		}
		
		$this->get ( 'session' )->setFlash ( 'sonata_flash_success', sprintf ( 'The selected jobs validity has been extended until %s.', date ( 'm/d/Y', time () + 86400 * 30 ) ) );
		
		return new RedirectResponse ( $this->admin->generateUrl ( 'list', $this->admin->getFilterParameters () ) );
	}
}