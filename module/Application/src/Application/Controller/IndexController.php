<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
//        $this->getServiceLocator()->get('tennis-place-finder')->run();


        return new ViewModel();
    }
}
