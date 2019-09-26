<?php

namespace Application\Repositorio;
use Application\Entidade\Question;
/**
 * QuestionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class QuestionRepository extends \Doctrine\ORM\EntityRepository {

    public function doSave($objQuestion = null, $arrDados = []) {

        try {


            $objQuiz = $this->getEntityManager()
                ->getRepository(\Application\Entidade\Quiz::class)
                ->findOneBy(
                    array(
                        'id' => $arrDados['quiz_id'],
                    )
                );

            $objType = $this->getEntityManager()
                ->getRepository(\Application\Entidade\TypeQuestion::class)
                ->findOneBy(
                    array(
                        'id' => $arrDados['type_id'],
                    )
                );


            if (empty($objQuestion)) {
                $objQuestion = new Question();
                $arrDados['create_at'] = new \DateTime();
            }



            $objQuestion->setSubject($arrDados['subject']);
            $objQuestion->setCreatedAt($arrDados['create_at']);
            $objQuestion->setUpdatedAt(new \DateTime());
            $objQuestion->setQuiz($objQuiz);
            $objQuestion->setType($objType);

            $this->getEntityManager()
                ->persist($objQuestion);

            $this->getEntityManager()
                ->flush();

        } catch (\Exception $objException) {

            throw new \Exception($objException->getMessage(), 10);

        }

    }
}
