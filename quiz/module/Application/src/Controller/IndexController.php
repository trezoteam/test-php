<?php
namespace Application\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController {
    /**
     * Tela inicial e publica do sistema
     */
    public function indexAction() {
        return new ViewModel();
    }

    /**
     * Listar todos os quiz cadastrados no sistema
     */
    public function loadAction() {
        $arrRetorno = [];
        $sn_status = true;
        $ds_mensagem = null;
        try {

            $objRetorno = $this->getRepository(\Application\Entidade\Quiz::class)
                ->findAll();

            foreach ($objRetorno as $objQuiz) {
                $arrRetorno[] = $objQuiz->toArray();
            }

        } catch (\Exception $objException) {

            $sn_status = true;
            $ds_mensagem = $objException->getMessage();
        }

        $arrModel = array(
            'arrQuiz' => $arrRetorno,
            'sn_status' => $sn_status,
            'ds_mensagem' => $ds_mensagem,

        );

        return new JsonModel($arrModel);
    }
}
